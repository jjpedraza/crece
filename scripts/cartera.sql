SELECT	
	tblPagos.curp as CURP,	
	(select clientes.nombre from clientes where curp = tblPagos.curp) as Cliente,
	
	(select clientes.IdGrupo from clientes where clientes.curp = tblPagos.curp limit 1) as IdGrupo,
	(select Grupos.Grupo from grupos where IdGrupo = (select clientes.IdGrupo from clientes where clientes.curp = tblPagos.curp limit 1)) as grupo,
	
	tblPagos.abono as abono_pactado,
	tblPagos.interes as interes_pactado,
	tblPagos.iva as iva_pactado,	
	tblPagos.nosol as nosol,
	tblPagos.fin as fecha,
	tblPagos.no as NPago,	
	
	
	 
(tblPagos.abono - (IF(tblPagos.estado <> 'X',ifnull((select sum(capital) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0'),tblPagos.abono) + ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=5),'0'))	 ) as abono,
	
	IF(tblPagos.estado <> 'X',ifnull((select sum(capital) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0'),tblPagos.abono) 	
	 as CajaCapital,
	
	 
	 
	(tblPagos.interes - 
	(IF(tblPagos.estado <> 'X',ifnull((select sum(interes) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0'),tblPagos.interes) 	+ ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=2),'0') )
		
	) as interes,
	

	IF(tblPagos.estado <> 'X',ifnull((select sum(interes) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0'),tblPagos.interes) 	
	as CajaInteres,


	(tblPagos.iva - 
		IF(tblPagos.estado <> 'X',ifnull((select sum(impuesto) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0'),tblPagos.iva) 	
	) as iva,

	 IF(tblPagos.estado <> 'X',ifnull((select sum(impuesto) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0'),tblPagos.iva) 	
	 as CajaImpuesto,
	
	IF(curdate() < tblPagos.fin, 	
		'0',		
		(SELECT DATEDIFF(CURDATE(),tblPagos.fin))
	) 	
	as mora_dias,
	
	(SELECT cuentas.formadepago from cuentas where nosol=tblPagos.nosol limit 1) as formadepago,
	
	(SELECT nombre from cat_formadepago where dias = (SELECT cuentas.formadepago from cuentas where nosol=tblPagos.nosol limit 1)) as formadepago_tipo,
	
	(SELECT cuentas.tasa_moratorio from cuentas where nosol=tblPagos.nosol limit 1) as mora_tasa,
	
	(SELECT rel_a.y from rel_a where x=formadepago limit 1) as mora_multiplo,
	
	IF(tblPagos.estado <> 'X',
		(FORMAT((SELECT ((((abono+interes+iva) * mora_multiplo)/100)*mora_tasa)/30),2)), 
	CONCAT(0))  as mora_dia,

	IF(curdate() < tblPagos.fin, 	
	'0',
		(IF(UPPER(tblPagos.estado) = 'X',
			'0', 
			
				(
					(SELECT mora_dia *  mora_dias) - 
					(
						(ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=1),'0')) + 
						(ifnull((select sum(moratorio) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),0) )
					)
				
				) 
			
		)
	)) as mora_debe,
	
	(SELECT round(mora_dias / 7) ) as Semanas,
	
	IF(tblPagos.estado <> 'X',(SELECT cuentas.cargoporsemana from cuentas where nosol = tblPagos.nosol limit 1),'0')  as CargoSemana,
	
	IF(curdate() < tblPagos.fin, 	
	'0',
		(IF(UPPER(tblPagos.estado) = 'X',
			'0', 
			((SELECT Semanas * CargoSemana) - (ifnull((select sum(cargosemanal) from corte where nosol=tblPagos.nosol and no=tblPagos.no),'0') + ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=4),'0') ) )	
			))
	) 		
	as CargoSemanal, -- Cargo por semana retrasada
	
	ifnull((select concepto from extraordinarios where nosol=tblPagos.nosol and no=tblPagos.no limit 1),'') as CargoExtraOrdinario_concepto,
	
	(ifnull((select sum(cantidad) from extraordinarios where nosol=tblPagos.nosol and no=tblPagos.no ),'0')
- (ifnull((select sum(extras) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0') + ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=3),'0') ))	as CargoExtraOrdinario_cantidad,
	
	
	(SELECT 
	(tblPagos.abono - IF(tblPagos.estado <> 'X',ifnull((select sum(capital) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0'),tblPagos.abono))
	
	+ 
(tblPagos.interes - 
		IF(tblPagos.estado <> 'X',ifnull((select sum(interes) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0'),tblPagos.interes) 	
	)
	
+ 

(tblPagos.iva - 
		IF(tblPagos.estado <> 'X',ifnull((select sum(impuesto) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0'),tblPagos.iva) 	
	)
+ mora_debe + CargoSemanal + CargoExtraOrdinario_cantidad) as subTOTAL,
	
	ifnull(
	(select GROUP_CONCAT(concepto, ' por ',act_user,' el ',act_fecha,' ') from descuetos where nosol=tblPagos.nosol and no=tblPagos.no )
	,'') as Descuento_concepto,
	
	ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=0),'0') as Descuento_cantidad,
	
	ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=1),'0') as Descuento_Moratorio,

ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=4),'0') as Descuento_CargoSemanal,

ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=3),'0') as Descuento_CargosExtras,

ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=2),'0') as Descuento_Financiamiento,

ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=5),'0') as Descuento_Capital,

  
	(
		IF(UPPER(tblPagos.estado) = 'X',0,
			(SELECT (tblPagos.abono - (IF(tblPagos.estado <> 'X',ifnull((select sum(capital) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0'),tblPagos.abono) + ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=5),'0'))	 )  + (tblPagos.interes - 
	(IF(tblPagos.estado <> 'X',ifnull((select sum(interes) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0'),tblPagos.interes) 	+ ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no and IdTipoDescuento=2),'0') )
		
	) + iva + mora_debe + CargoSemanal + CargoExtraOrdinario_cantidad) - (SELECT Descuento_cantidad)
		)
	) as TOTAL,
	
	(SELECT FORMAT(TOTAL,2)) as TotalFormat,
	
	IF((select TOTAL )=  0,'PAGADO',
		(IF( UPPER(tblPagos.estado) = 'X','PAGADO','SIN PAGAR'))
	) AS EstadoPago,
	
	tblPagos.comentario,
	
	
	
	if (ifnull((select valor from corte where nosol=tblPagos.nosol and no=tblPagos.no limit 1),'') = '',
		IF(UPPER(tblPagos.estado) = 'X',
			
			( (SELECT abono + interes + iva + mora_debe + CargoSemanal + CargoExtraOrdinario_cantidad) - ifnull((select sum(cantidad) from descuetos where nosol=tblPagos.nosol and no=tblPagos.no ),'0'))
			
			,'0')	
		,(select sum(valor) from corte where nosol=tblPagos.nosol and no=tblPagos.no )
	) as CajaCantidad,
	
	
	
	ifnull((select sum(ahorro) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'') as CajaAhorro,
	
	
	
	
	
	if (ifnull((select valor from corte where nosol=tblPagos.nosol and no=tblPagos.no limit 1),'') = '',
		IF(UPPER(tblPagos.estado) = 'X',
			tblPagos.fin,
		  ''
		)	
	
	,ifnull((select fecha from corte where nosol=tblPagos.nosol and no=tblPagos.no limit 1),'') 	
	) as CajaFecha
	
	
	
	
	
	,ifnull((select sum(moratorio) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0') 	
	 as CajaMoratorio
	
	,ifnull((select sum(extras) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0') 	
	 as CajaExtras
	
	,ifnull((select sum(cargosemanal) from corte where nosol=tblPagos.nosol and no=tblPagos.no ),'0') 	
	 as CajaCargoSemanal,
	
	
	
	
	
	
	
	
		
if (ifnull((select valor from corte where nosol=tblPagos.nosol and no=tblPagos.no limit 1),'') = '',		
		IF(UPPER(tblPagos.estado) = 'X',
			CONCAT('PAGADO'),
			''),
		ifnull((select comentario from corte where nosol=tblPagos.nosol and no=tblPagos.no limit 1),'')

) as CajaComentario,	
	
	
	ifnull((select corte.usuario from corte where nosol=tblPagos.nosol and no=tblPagos.no limit 1),'') as Caja_Usuario,
	ifnull((select id from corte where nosol=tblPagos.nosol and no=tblPagos.no limit 1),'') as IdRecibo,
	
	IF(curdate() < tblPagos.fin, 	
	'AL CORRIENTE',
		
		IF((select TOTAL )=  0,'PAGADO',
			(IF( UPPER(tblPagos.estado) = 'X','PAGADO','VENCIDO'))
		) 
	
	) as CarteraEstatus,
	
	(select cuentas.IdEstatus from cuentas where nosol = tblPagos.nosol) as IdEstatus

FROM
	tabladepagos tblPagos 