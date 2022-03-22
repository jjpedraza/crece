SELECT
	g.IdGrupo,
	g.Grupo,
	(select count(*) from clientes where IdGrupo = g.IdGrupo) as Miembros,
	(select count(*) from cuentas where IdGrupo = g.IdGrupo) as Contratos,
	g.IdSucursal
FROM
	grupos g