-- LA CARTERA ACTIVA
select 
	sum(TOTAL) as Total,
	sum(abono) as Abonos,
	sum(interes) as Intereses,
	sum(iva) as IVA,
	sum(mora_debe) as Moratorios,
	sum(Cargos) as Cargos
from carteravencida 