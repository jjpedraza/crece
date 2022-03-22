select  
CASE
    WHEN municipio = 'ALDAMA' THEN '1'
    WHEN municipio = 'GONZALEZ' THEN '2'
    ELSE '0'
END

from clientes limit 1000