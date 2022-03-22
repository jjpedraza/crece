select 
DISTINCT
s.Cliente as nombre,
s.nosol,
s.grupo,

(select sum(TOTAL) from saldos where nosol = s.nosol) as Debe,
(select max(mora_dias) from saldos where nosol = s.nosol) as AtrasoDias

from saldos s
WHERE EstadoPago <> 'PAGADO'
order by nombre