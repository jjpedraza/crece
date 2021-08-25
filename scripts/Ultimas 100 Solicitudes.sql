select s.valoracion,s.nosol,s.tipo,s.Cliente,s.fechacontrato,s.cantidad,s.plazo,s.tasa_interes,s.tasa_moratorio
from solicitudes s
where nosol<>''
order by fechacontrato DESC limit 100
