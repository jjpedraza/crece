
<?php
/* si no es la sesion de el USUARIO regresar a login.*/
session_start();

if(!isset($_SESSION['usuario'])) 
{  
  header('Location: login.php'); 
  exit();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MANTENIMIENTO: cambiar password</title>
<link href="css/mantenimiento.css" rel="stylesheet" type="text/css" />

</head>

<body >
<center>
<P class="titulo">
MANTENIMIENTO: <br/> modificacion de mi password
</P>
  <form action=mantenimiento_pass_procesa.php method='post' name='mantenimient_pass'>
    <P align="center" class="texto">Password nuevo:<br /><input required="required" name='passnuevo1' type='text' id='passnuevo1' value='' size="40" /><br />
    <br /><br />


        <input type='submit' name='ok' id='ok' value='CAMBIAR PASSWORD' />
    </p>
    </form>
</center>
</body>
</html>