select 
nombre, correo

from clientes where correo like '%@%'


UPDATE clientes SET socio_casapropia=LOWER(socio_casapropia)