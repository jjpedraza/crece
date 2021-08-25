SELECT 
	(select count(*) from cuentas) as Total,
	(select count(*) from cuentas WHERE valoracion='APROBADO') as Aprobadas,
	(select count(*) from cuentas WHERE valoracion<>'APROBADO') as NoAprobadas,
	(select count(*) from cuentas WHERE grupo<>'') as Grupales,
	(select count(*) from cuentas WHERE grupo='') as Individuales
	
	
	
	
	 
        
   select CONCAT('Grupales') as Label,count(*) as Data from cuentas WHERE  grupo<>'' UNION
	 select CONCAT('Individuales') as Label,count(*) as Data from cuentas WHERE grupo=''
   
	 
	 SET lc_time_names = 'es_MX';
	 select DISTINCT CONCAT(MONTHNAME(a.fechacontrato), YEAR(a.fechacontrato)) as MES,	 
	 (select count(*) from cuentas where MONTHNAME(fechacontrato) = MONTHNAME(a.fechacontrato) and YEAR(fechacontrato) = YEAR(a.fechacontrato) )as contratos
	 
	 
	 from cuentas a WHERE fechacontrato<>'0000-00-00' order by fechacontrato