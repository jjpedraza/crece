UPDATE proyeccion p	
	set p.Actualizacion = now(),
	set p.PagoCorriente = sum(pr.abono) + sum(pr.interes) + sum(pr.iva) 
	
	from proyeccion p INNER JOIN tabladepagos pr	
	ON     
     p.Anio = YEAR(pr.fin) and p.M = MONTH(pr.fin)  and pr.estado <> 'X'
		 
		 
		 
-- ===================================
SELECT		
	CURDATE() as FechaActual,
	DATE_ADD(CURDATE(),INTERVAL 5 DAY) as  FechaCalculo,
	tblPagos.curp as CURP,	
	(select clientes.grupo from clientes where clientes.curp = tblPagos.curp) as grupo,
	tblPagos.nosol as NCuenta,
	tblPagos.fin as fecha,
	tblPagos.no as NPago,	
	tblPagos.abono,
	tblPagos.interes,
	tblPagos.iva,
	(SELECT DATEDIFF(FechaCalculo,tblPagos.fin)) as mora_dias,
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
	
	limit 10
