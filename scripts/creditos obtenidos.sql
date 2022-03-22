select
c.curp, c.nosol, 

if(c.IdEstatus=1,'Cancelado-',
	if(c.valoracion='','SOLICITUD',
		c.valoracion
	 )
) as valoracion,
c.cantidad,c.fechacontrato,
IdSucursal,
ifnull((select sum(TOTAL) from cartera where nosol= c.nosol and EstadoPago<>'PAGADO'),0) as Debe,

if(c.tipo='GRUPAL',CONCAT(c.tipo,' (',c.IdGrupo,') ',ifnull((select Grupo from grupos where IdGrupo = c.IdGrupo),'')),c.tipo) as tipo,


c.IdEstatus
from cuentas c  where tipo='INDIVIDUAL'



UNION
select
c.curp, c.nosol, 

if(c.IdEstatus=1,'Cancelado-',
	if(c.valoracion='','SOLICITUD',
		c.valoracion
	 )
) as valoracion,
c.cantidad,c.fechacontrato,
IdSucursal,
ifnull((select sum(TOTAL) from cartera where nosol= c.nosol and EstadoPago<>'PAGADO'),0) as Debe,

if(c.tipo='GRUPAL',CONCAT(c.tipo,' (',c.IdGrupo,') ',ifnull((select Grupo from grupos where IdGrupo = c.IdGrupo),'')),c.tipo) as tipo,


c.IdEstatus
from cuentas c  where tipo='GRUPAL'
