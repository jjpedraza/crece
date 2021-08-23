-- Corrida Financiera
SELECT	
	t.nosol as nosol,	
	t.fin as fecha,
	t.no,
	t.abono as cargo,
	CONCAT(0) as abono,
	CONCAT('abono',comentario) as Descripcion,
	CONCAT('+') as Tipo

FROM
	tabladepagos t
	
-- Pagos en Caja
UNION 	

SELECT	
	c.nosol as nosol,
	c.fecha as fecha,
	c.no,
	CONCAT(0) as cargo,	
	IF(c.valor=0 and (select EstadoPago from cartera where nosol=c.nosol and no = c.no) ='PAGADO', 		
		(select abono from cartera where nosol=c.nosol and no = c.no), 
		c.valor
	) as abono,	
	
	IF(c.valor=0 and (select EstadoPago from cartera where nosol=c.nosol and no = c.no) ='PAGADO',
	
		(select CONCAT('PAGADO ',abono) from cartera where nosol=c.nosol and no = c.no),	
		CONCAT('pago ->',c.comentario)
	
	)  as Descripcion,
	
	CONCAT('-') as Tipo

FROM
	corte c

		
		

-- AHORROS
UNION 	

SELECT	
	c.nosol as nosol,
	c.fecha as fecha,
	c.no,
	CONCAT(0) as cargo,
	(c.valor) as abono,
	CONCAT('ahorro ',c.comentario,' - ',c.usuario) as Descripcion,
	CONCAT('') as Tipo

FROM
	corte c
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		