SELECT 	
	(
		(select sum(abono) from tabladepagos where YEAR(fin) = YEAR(t.fecha) and MONTH(fin) = MONTH(t.fecha))
		+
		(select sum(interes) from tabladepagos where YEAR(fin) = YEAR(t.fecha) and MONTH(fin) = MONTH(t.fecha))
		
		
		
	
	
	) as TOTAL



from tblpagos t
WHERE  
YEAR(fecha) = 2014
and MONTH(fecha) = 7
and EstadoPago='SIN PAGAR' 










	(SELECT DATEDIFF(CURDATE(),tblPagos.fin)) as mora_dias,
	(SELECT cuentas.formadepago from cuentas where nosol=tblPagos.nosol) as formadepago,
	(SELECT cuentas.tasa_moratorio from cuentas where nosol=tblPagos.nosol) as mora_tasa,
	(SELECT rel_a.y from rel_a where x=formadepago) as mora_multiplo,
	(SELECT ((((abono+interes+iva) * mora_multiplo)/100)*mora_tasa)/30)  as mora_dia,
	(SELECT mora_dia *  mora_dias) as mora_debe,
	(SELECT round(mora_dias / 7) ) as Semanas,
	(SELECT cuentas.cargoporsemana from cuentas where nosol = tblPagos.nosol) as CargoSemana,
	(SELECT Semanas * CargoSemana) as Cargos, -- Cargo por semana retrasada
	-- abono + interes + iva + mora_debe + Cargos