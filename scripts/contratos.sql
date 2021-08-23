select s.valoracion,s.nosol,s.tipo,s.Cliente,s.fechacontrato,s.cantidad,s.plazo,s.tasa_interes,s.tasa_moratorio,
FORMAT(ifnull((select sum(TOTAL) from cartera where nosol = s.nosol),0),2) as Debe,
FORMAT(ifnull((select sum(mora_debe) from cartera where nosol = s.nosol),0),2) as DebeMora,
ifnull((select max(mora_dias) from cartera where nosol = s.nosol),0) as AtrasoDias

from solicitudes s
where nosol<>'' 