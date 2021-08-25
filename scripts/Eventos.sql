SET GLOBAL event_scheduler = ON;

CREATE EVENT CalcularSaldos
ON SCHEDULE EVERY 3 HOUR STARTS '2021-08-25 00:00:00'
DO
BEGIN
 
	delete from saldos;
	insert into saldos (select c.*, curdate() as act_fecha, curtime() as act_hora from cartera c);
	insert into historia (fecha,hora, descripcion) VALUES(curdate(), curtime(),'Actualizo Saldos');


END 


    
		
CREATE EVENT TestEvento
ON SCHEDULE EVERY 10 MINUTE STARTS '2021-08-25 00:00:00'
DO
BEGIN
 
	
	insert into historia (fecha,hora, descripcion) VALUES(curdate(), curtime(),'TestEvento');


END 

		
		