DROP FUNCTION IF EXISTS pricelist_product_price(integer, date, varchar(10), varchar(20), integer);
DROP FUNCTION IF EXISTS get_base_pricelist_position(integer, date, varchar(10), varchar(20));
DROP TYPE IF EXISTS price;
DROP TYPE IF EXISTS basePrice;
DROP TYPE IF EXISTS netGrossPrice;

CREATE TYPE price AS
(
    product_id           integer,
    price                numeric,
    discount             numeric,
    net_price            numeric,
    gross_price          numeric,
    base_price           numeric,
    base_net_price       numeric,
    base_gross_price     numeric,
    is_contractor_price  boolean,
    vat                  numeric,
    positions_price_type varchar(10),
    currency_code        varchar(20)
);

CREATE TYPE basePrice AS
(
    product_id           integer,
    base_price           numeric,
    base_net_price       numeric,
    base_gross_price     numeric,
    vat                  numeric,
    positions_price_type varchar(10),
    currency_code        varchar(20)
);

-- helper type
CREATE TYPE netGrossPrice AS
(
    net_price   numeric,
    gross_price numeric
);


-- USAGE: SELECT * FROM pricelist_product_price(_product_id, _date, _positions_price_type, _currency_code, _contractor_id)
CREATE OR REPLACE FUNCTION pricelist_product_price(_product_id integer,
                                                   _date date,
                                                   _positions_price_type varchar(10),
                                                   _currency_code varchar(20),
                                                   _contractor_id integer)
    RETURNS price AS
$BODY$

DECLARE
    rec             price;
    base            basePrice;
    netGrossPrice   netGrossPrice;
    baseFOUND       bool;
    contractorFOUND bool;
BEGIN

    -- check base pricelist
    SELECT bp.product_id,
           bp.price,
           bp.base_net_price,
           bp.base_gross_price,
           bp.vat,
           bp.positions_price_type,
           bp.currency_code
    INTO base
    FROM get_base_pricelist_position(_product_id, _date, _positions_price_type, _currency_code) as bp;

    baseFOUND := FOUND;


    -- check contractor pricelist
    contractorFOUND := false;
    if _contractor_id is not null then

        SELECT prod.id,
               plp.price,
               plp.discount,
               null,
               null,
               null,
               null,
               null,
               true,
               plp.vat,
               pl.positions_price_type,
               cr.iso_code
        INTO rec
        FROM app_pricelist_position plp
                 JOIN app_pricelist pl ON pl.id = plp.pricelist_id
                 JOIN app_product prod ON prod.id = plp.product_id
                 JOIN app_currency cr ON cr.id = pl.currency_id
        WHERE pl.is_enabled = TRUE
          AND pl.contractor_id = _contractor_id
          AND cr.iso_code = _currency_code
          AND pl.positions_price_type = _positions_price_type
          AND plp.product_id = _product_id
          AND (pl.date_to >= _date OR pl.date_to IS NULL)
          AND (pl.date_from <= _date OR pl.date_from IS NULL)
        ORDER BY pl.date_from DESC NULLS LAST, pl.date_to ASC NULLS LAST
        LIMIT 1;

        contractorFOUND := FOUND;
    end if;

    -- found pricelist (base or contractor)
    if contractorFOUND or baseFOUND then

        -- set from base
        rec.base_price := base.base_price;
        rec.base_net_price := base.base_net_price;
        rec.base_gross_price := base.base_gross_price;

        -- if contractor pricelist not found, set from base
        if contractorFOUND is false then
            rec.is_contractor_price := false;
            rec.product_id := base.product_id;
            rec.price := base.base_price;
            rec.net_price := base.base_net_price;
            rec.gross_price := base.base_gross_price;
            rec.vat := base.vat;
            rec.positions_price_type := base.positions_price_type;
            rec.currency_code := base.currency_code;
        end if;

        -- if price not present and discount is, calculate price based on basePrice and discount
        if rec.price is null and rec.discount is not null and base.base_price is not null then
            rec.price := base.base_price - (base.base_price * rec.discount / 100);
        end if;

        -- calculate net/gross price

        -- aktualizacja netto/brutto
        SELECT round((CASE WHEN rec.positions_price_type = 'net' THEN rec.price ELSE (rec.price / (((rec.vat::float / 100) + 1))) END)::numeric, 2)   net_price,
               round((CASE WHEN rec.positions_price_type = 'gross' THEN rec.price ELSE (rec.price * (((rec.vat::float / 100) + 1))) END)::numeric, 2) gross_price
        INTO netGrossPrice;
        --FROM app_product p
        --WHERE p.id = rec.productID;

        rec.net_price := netGrossPrice.net_price;
        rec.gross_price := netGrossPrice.gross_price;

    else
        return null;
    end if;


    RETURN rec;
END;


$BODY$
    LANGUAGE plpgsql
    VOLATILE
    COST 100;


-- USAGE: SELECT * FROM get_base_pricelist_position(_product_id, _date, _positions_price_type, _currency_code)
CREATE OR REPLACE FUNCTION public.get_base_pricelist_position(_product_id integer, _date date, _positions_price_type varchar(10), _currency_code varchar(20))
    RETURNS
        TABLE
        (
            product_id            integer,
            pricelist_id          integer,
            pricelist_position_id integer,
            price                 numeric,
            base_net_price        numeric,
            base_gross_price      numeric,
            vat                   numeric,
            positions_price_type  varchar(10),
            currency_code         varchar(20)
        )
AS
$BODY$
DECLARE
BEGIN
    RETURN QUERY
        SELECT prod.id,
               pl.id,
               plp.id,
               plp.price,
               round((CASE WHEN _positions_price_type = 'net' THEN plp.price ELSE (plp.price / (((plp.vat::float / 100) + 1))) END)::numeric, 2)   as net_base_price,
               round((CASE WHEN _positions_price_type = 'gross' THEN plp.price ELSE (plp.price * (((plp.vat::float / 100) + 1))) END)::numeric, 2) as gross_base_price,
               plp.vat,
               pl.positions_price_type,
               cr.iso_code
        FROM app_pricelist_position plp
                 JOIN app_pricelist pl ON pl.id = plp.pricelist_id
                 JOIN app_product prod ON prod.id = plp.product_id
                 JOIN app_currency cr ON cr.id = pl.currency_id
        WHERE pl.is_enabled = TRUE
          AND pl.contractor_id IS NULL
          AND cr.iso_code = _currency_code
          AND plp.product_id = _product_id
          AND pl.positions_price_type = _positions_price_type
          AND (pl.date_to >= _date OR pl.date_to IS NULL)
          AND (pl.date_from <= _date OR pl.date_from IS NULL)
        ORDER BY pl.date_from DESC NULLS LAST, pl.date_to ASC NULLS LAST
        LIMIT 1;
END;
$BODY$
    LANGUAGE plpgsql
    VOLATILE
    COST 100;
