SELECT
    *,
    CASE
        WHEN USR_ID > 30 THEN 'The quantity is greater than 30'
        WHEN USR_ID = 30 THEN 'The quantity is 30'
        ELSE 'The quantity is under 30'
    END AS USR_TEXT
FROM
    USER_TB;

/*  */
SELECT
    CustomerName,
    City,
    Country
FROM
    Customers
ORDER BY
    (
        CASE
            WHEN City IS NULL THEN Country
            ELSE City
        END
    );