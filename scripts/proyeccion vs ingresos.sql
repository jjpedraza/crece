-- proyeccion vs ingresos

-- 1.- Universo
SET lc_time_names = 'es_ES';
delete from proyeccion;
insert proyeccion (
	select 
		DISTINCT 
			YEAR(Pagos.fecha) as Anio,
			MONTH(Pagos.fecha) as M,
			MONTHNAME(Pagos.fecha) as Mes,
			LAST_DAY(Pagos.fecha) as FechaCalculo,			
			0 as PagoCorriente,
			0 as PagoMoratorio,
			NOW() as Actualizacion
	from tblpagos Pagos
	
)
		
		
		