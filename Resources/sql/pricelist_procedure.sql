DROP FUNCTION IF EXISTS pricelist_product_price(integer, date, varchar(20), integer);
DROP TYPE IF EXISTS price;

CREATE TYPE price AS
(
    productID    integer,
    netPrice     numeric,
    grossPrice   numeric,
    vat          numeric,
    currencyCode varchar(20)
);


-- USAGE: SELECT * FROM pricelist_product_price(_product_id, _date, _currency_code, _contractor_id)
CREATE OR REPLACE FUNCTION pricelist_product_price(_product_id integer,
                                                   _date date,
                                                   _currency_code varchar(20),
                                                   _contractor_id integer)
    RETURNS price AS
$BODY$

DECLARE
    rec price;
BEGIN


    RETURN rec;
END;


$BODY$
    LANGUAGE plpgsql
    VOLATILE
    COST 100;
