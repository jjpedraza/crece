-- Convertir todas las tablas a InnoDB

SET @DATABASE_NAME = 'crece';
SELECT CONCAT('ALTER TABLE `', table_name, '` ENGINE=InnoDB;') AS sql_statements
FROM information_schema.tables AS tb
WHERE table_schema = @DATABASE_NAME
AND `TABLE_TYPE` = 'BASE TABLE'



SELECT CONCAT('ALTER TABLE ',TABLE_SCHEMA,'.',TABLE_NAME,' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;  ')
AS alter_sql
FROM information_schema.TABLES
WHERE TABLE_SCHEMA = 'crece' AND information_schema.`TABLES`.TABLE_TYPE ='BASE TABLE'
