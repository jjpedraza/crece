select DISTINCT YEAR(s.fecha) as Año, MONTH(s.fecha) as Mes
,(select sum(abono_pactado) from saldos where YEAR(fecha) = YEAR(s.fecha) and MONTH(fecha) = MONTH(s.fecha)) AS Capital

from saldos s ORDER BY fecha

select * from saldos limit 10