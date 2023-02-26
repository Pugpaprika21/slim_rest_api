SELECT
    TO_JSON_STRING(
        (
            SELECT
                *
            FROM
                USER_TB
        ) AS NEW_JSON
    );