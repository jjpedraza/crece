select 
CONCAT(c.nosol,' por $',c.cantidad, ' a ', c.plazo,' meses el ',c.fechacontrato, ' con el grupo ', c.grupo, ' con el cargo en el grupo de ',grupo_cargo) as InformacionCuenta

from cuentas c
where curp='BAPA801126MTSRRN06'