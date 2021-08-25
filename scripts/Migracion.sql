-- RUTINAS DE MIGRACION


-- 1.- ACTUALIZAR CLIENTES
UPDATE clientes SET socio_casapropia=UPPER(socio_casapropia);

UPDATE clientes SET socio_casapropia = 'NO' where socio_casapropia <> 'SI';

UPDATE clientes SET minegocio_propio=UPPER(minegocio_propio);

UPDATE clientes SET minegocio_propio = 'NO' where minegocio_propio <> 'SI';


ALTER TABLE `crece`.`clientes` 
MODIFY COLUMN `socio_hogar` decimal(10, 2) NOT NULL AFTER `refc3_antiguedad`,
MODIFY COLUMN `socio_renta` decimal(10, 2) NOT NULL AFTER `socio_hogar`,
MODIFY COLUMN `socio_drenaje` decimal(10, 2) NOT NULL AFTER `socio_renta`,
MODIFY COLUMN `socio_agualuz` decimal(10, 2) NOT NULL AFTER `socio_drenaje`;


-- Desde aqui se tomaran los 20 pesos extras por semana
ALTER TABLE `crece`.`cuentas` 
ADD COLUMN `cargoporsemana` decimal(10, 2) NOT NULL AFTER `fechacontrato`;

UPDATE cuentas SET cargoporsemana=20;

ALTER TABLE `crece`.`clientes` 
MODIFY COLUMN `curp` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL FIRST;