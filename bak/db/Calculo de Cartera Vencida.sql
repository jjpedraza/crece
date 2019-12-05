SELECT
	*,
	tabladepagos.nosol as Qsol,
	tabladepagos.curp as Qcurp,	
	(select clientes.grupo from clientes where curp=Qcurp) as grupo,
	tabladepagos.fin as fecha,
	(SELECT DATEDIFF(CURDATE(),fecha)) as mora_dias,
	(SELECT cuentas.formadepago from cuentas where nosol=Qsol) as formadepago,
	(SELECT cuentas.tasa_moratorio from cuentas where nosol=Qsol) as mora_tasa,
	(SELECT rel_a.y from rel_a where x=formadepago) as mora_multiplo,
	(SELECT ((((abono+interes+iva) * mora_multiplo)/100)*mora_tasa)/30)  as mora_dia,
	(SELECT mora_dia *  mora_dias) as mora_debe,
	(SELECT round(mora_dias / 7) ) as Semanas,
	(SELECT Semanas * 20) as Cargos, -- Cargo por semana retrasada
	(SELECT abono + interes + iva + mora_debe + Cargos) as TOTAL
	

FROM
	tabladepagos
WHERE	
	estado<>'X' 
	and fin<CURDATE() 

limit 10