<?php

if (isset($_GET['mode'])){
    if ($_GET['mode']=='GET'){
       echo  DatosViviendaGET2($_GET['IdDelegacion'],$_GET['sql']);
       
    } else {
        // echo DatosViviendaPOST($_POST['IdDelegacion'],$_POST['sql']);
        echo "POST:";
        echo DatosViviendaPOST($_POST['IdDelegacion'],$_POST['sql']);
    }

}






function DatosViviendaGET2($IdDelegacion, $ConsultaMSSQLSERVER){
    
    $URLwebserviceVivienda = "http://172.16.91.3";
    $Usuario = "1403";
    $MiToken="0000000000";
		$url = $URLwebserviceVivienda."/mst_sql.asp";
		$data = array('IdDel' => $IdDelegacion, 'user' => $Usuario, 'token' => $MiToken, 'sql'=>$ConsultaMSSQLSERVER);
		$options = array(
				'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'GET',
				'content' => http_build_query($data),
			)
		);
		
		
		$context  = stream_context_create($options);
		$DataWb = file_get_contents($url, false, $context);
		
		if ($DataWb === FALSE) {
			return FALSE;
		} else {
			return $DataWb; // <-- contenido 
		}

    
  



}

function DatosViviendaPOST($IdDelegacion, $ConsultaMSSQLSERVER){
    
    $URLwebserviceVivienda = "http://172.16.91.3";
    $Usuario = "1403";
    $MiToken="0000000000";
		$url = $URLwebserviceVivienda."/mst_sql.asp";
		$data = array('IdDel' => $IdDelegacion, 'user' => $Usuario, 'token' => $MiToken, 'sql'=>$ConsultaMSSQLSERVER);
		$options = array(
				'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data),
			)
		);
		
		
		$context  = stream_context_create($options);
		$DataWb = file_get_contents($url, false, $context);
		
		if ($DataWb === FALSE) {
			return FALSE;
		} else {
			return $DataWb; // <-- contenido 
		}

    
  



}


?>