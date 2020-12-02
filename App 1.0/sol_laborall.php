<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/misol1.css" rel="stylesheet" type="text/css" />
</head>

<body>
<P>INFORMACION LABORAL Y ECONOMICA<BR />
</P>
<P>Llene a continuacion correctamente la siguiente informacion:</P>
<form id="empresa" name="empresa" method="post" action="">
  <p class="pies">
  
  Profesion:<br /><input name="profesion" type="text" class="textbox"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()" value="" size="70"><br><BR />

</p><p class="normal">
  EMPRESA DONDE TRABAJO :<br />
  (llenar solamente si cuenta con trabajo)</p><p class="pies">

  Nombre de la empresa:<br /><input name="trabajo_empresa" type="text" class="textbox"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()" value="" size="70"><br>
  
   Domicilio de la empresa::<br /><input size="70" name="trabajo_domicilio" class="textbox"  type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
   
   Telefono del trabajo:<br /><input size="70" name="trabajo_telefono" class="textbox" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
  
    Giro comercial de la empresa:<br /><input size="50" name="trabajo_giro" class="textbox" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br>
    
    
    Puesto:<br /><input size="40" name="trabajo_puesto" type="text" class="textbox"  value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><BR />
    
  Salario (mensual):<br /><input size="30" required="required" class="textbox" name="trabajo_salario" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><BR />  
  </p><p class="normal">
  DATOS FISCALES:</p>
 
    <P class="pies">
    RFC:<br /><input size="30" name="fiscal_rfc" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />
    
    Domicilio:<br /><input size="70" name="fiscal_domicilio" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
  </p>
  <p class="normal">MI NEGOCIO: </p>

<p class="pies">

  Nombre del negocio:<br /><input size="50" name="negocio_nombre" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />
      
    ¿Local propio?<br />
    <select name="local">
      <option value="si"> SI </option>
      <option value="no"> NO </option>
    </select>
    <br /><br />
    
    Ingresos del negocio (ganancia mensual):<br /><input size="20" name="negocio_ingresos" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()">  <br /><br />
     Giro de mi negocio:<br /><input size="50" name="negocio_giro" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />
      Telefono del negocio:<br /><input size="50" name="negocio_telefono" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><br />
       ¿Cuantos empleados tiene?:<br /><input size="4" name="negocio_empleados" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
      
    
  </p><BR />
    <p class="normal">SOCIECONOMICO: </p>
  <p class="pies"> 
     
    ¿Cuantas personas depende de usted?:<br /><input size="3" name="dependen" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br><BR />
    
    
    ¿Cuantos hijos tiene?<br /><input size="3" name="hijos" type="text" value=""  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase()"><br>
    

    
    
  <p class="pies"><br><br>
     


  </p>
<p align="center"><input type="submit" name="ok" id="ok" value="GUARDAR,  SIGUIENTE" /></p> 
</form>
</body>
</html>