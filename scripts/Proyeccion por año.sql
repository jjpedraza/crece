select DISTINCT a.Anio as Label,
	
	(select sum(PagoCorriente) from proyeccion where Anio = a.Anio) as Data

from proyeccion a
order by Anio