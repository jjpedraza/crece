SELECT	
	tblPagos.curp as CURP,	
	(select clientes.grupo from clientes where clientes.curp = tblPagos.curp) as grupo,
	tblPagos.nosol as NCuenta,
	tblPagos.fin as fecha,
	tblPagos.no as NPago,	
	tblPagos.abono,
	tblPagos.interes,
	tblPagos.iva,
	(SELECT DATEDIFF(CURDATE(),tblPagos.fin)) as mora_dias,
	(SELECT cuentas.formadepago from cuentas where nosol=tblPagos.nosol) as formadepago,
	(SELECT cuentas.tasa_moratorio from cuentas where nosol=tblPagos.nosol) as mora_tasa,
	(SELECT rel_a.y from rel_a where x=formadepago) as mora_multiplo,
	(SELECT ((((abono+interes+iva) * mora_multiplo)/100)*mora_tasa)/30)  as mora_dia,
	
	(SELECT mora_dia *  mora_dias) as mora_debe,
	
	(SELECT round(mora_dias / 7) ) as Semanas,
	(SELECT cuentas.cargoporsemana from cuentas where nosol = tblPagos.nosol) as CargoSemana,
	(SELECT Semanas * CargoSemana) as Cargos, -- Cargo por semana retrasada
	(SELECT abono + interes + iva + mora_debe + Cargos) as TOTAL,
	(SELECT FORMAT(TOTAL,2)) as TotalFormat,
	IF(tblPagos.estado <> 'X','SIN PAGAR','PAGADO') as EstadoPago,
	tblPagos.comentario

FROM
	tabladepagos tblPagos
WHERE 	
	estado<>'X' 
	and fin<CURDATE() 