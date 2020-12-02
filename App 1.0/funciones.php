<?PHP //MIS FUNCIONES
function findemes($fecha){
	//$fecha = "21-02-1992";
	
	//	$month = '1992-02';
	$month = date('Y-m',strtotime("$fecha"));
	$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
	$ultimodiadelmes = date('d', strtotime("{$aux} - 1 day"));
	return $ultimodiadelmes;
	//echo "fecha: ".$fecha."<br>";			
	//echo "mes: ".$month."<br>";			
	//echo "ultimo dia: ".$ultimodiadelmes."<br>";			

	}

function no_esta($n)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $n . "'");
    $esta = "";
    if ($row = mysql_fetch_array($result)) {
        $esta = "SI";
    } else {
        $esta = "NO";
    }
    return $esta;
}

function no()
{
    $fecha = date('Ymj');
    $no_sol = $fecha . mt_rand(0, 999);

    while (no_esta($no_sol) == "SI") {
        $no_sol = $fecha . mt_rand(0, 999);
    }
    return $no_sol;
}

function cliente_esta($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $esta = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $esta = "SI";
    } else {
        $esta = "NO";
    }
    return $esta;
}

function nombre($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["nombre"];
    } else {
        $msg = "";
    }
    return $msg;
}

function profesion($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["profesion"];
    } else {
        $msg = "";
    }
    return $msg;
}

function foto($curp)
{
    $link = mysql_connect('localhost', 'root', 'admin');
    mysql_select_db($basededatos, $link);

    $result = mysql_query("SELECT * FROM `fotos` WHERE curp='" . $curp . "'", $link);
    $row = mysql_fetch_array($result);

    header("Content-type:" . $row["tipo"]);
    return $row["imagen"];

}

function domicilio($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = 'CALLE ' . $row["domicilio"] . ', ' . $row["municipio"] . ', ' . $row["estado"] .
            '.<br> Referencia: ' . $row["domicilio_referencia"] . '.';
    } else {
        $msg = "";
    }
    return $msg;
}

function telefono($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["telefono"];
    } else {
        $msg = "";
    }
    return $msg;
}

function correo($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["correo"];
    } else {
        $msg = "";
    }
    return $msg;
}

function ife($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["IFE"];
    } else {
        $msg = "";
    }
    return $msg;
}

function estadocivil($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["estadocivil"];
    } else {
        $msg = "";
    }
    return $msg;
}

function nacimiento($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["fechadenacimiento"];
    } else {
        $msg = "";
    }
    return $msg;
}
function estudios($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["estudios"];
    } else {
        $msg = "";
    }
    return $msg;
}

function sexo($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["sexo"];
    } else {
        $msg = "";
    }
    return $msg;
}

function trabajo_nombre($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["trabajo_nombre"];
    } else {
        $msg = "";
    }
    return $msg;
}

function trabajo_domicilio($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["trabajo_domicilio"];
    } else {
        $msg = "";
    }
    return $msg;
}
function trabajo_telefono($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["trabajo_telefono"];
    } else {
        $msg = "";
    }
    return $msg;
}

function trabajo_puesto($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["trabajo_puesto"];
    } else {
        $msg = "";
    }
    return $msg;
}

function trabajo_giro($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["trabajo_giro"];
    } else {
        $msg = "";
    }
    return $msg;
}
function trabajo_salario($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["trabajo_salario"];
    } else {
        $msg = "";
    }
    return $msg;
}

function minegocio_nombre($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["minegocio_nombre"];
    } else {
        $msg = "";
    }
    return $msg;
}

function minegocio_giro($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["minegocio_giro"];
    } else {
        $msg = "";
    }
    return $msg;
}

function minegocio_telefono($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["minegocio_telefono"];
    } else {
        $msg = "";
    }
    return $msg;
}

function minegocio_ingresos($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["minegocio_ingresos"];
    } else {
        $msg = "";
    }
    return $msg;
}

function minegocio_empleados($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["minegocio_empleados"];
    } else {
        $msg = "";
    }
    return $msg;
}

function minegocio_propio($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["minegocio_propio"];
    } else {
        $msg = "";
    }
    return $msg;
}


function casa_propia($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["socio_casapropia"];
    } else {
        $msg = "";
    }
    return $msg;
}


function hijos($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["socio_hijos"];
    } else {
        $msg = "";
    }
    return $msg;
}


function dependen($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["socio_dependen"];
    } else {
        $msg = "";
    }
    return $msg;
}

function ref1($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["ref1_nombre"] . ', Tel. ' . $row["ref1_tel"] . ' vive en ' . $row["ref1_domicilio"];
    } else {
        $msg = "";
    }
    return $msg;
}


function ref2($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["ref2_nombre"] . ', Tel. ' . $row["ref2_tel"] . ' vive en ' . $row["ref2_domicilio"];
    } else {
        $msg = "";
    }
    return $msg;
}


//------- FUNCIONES ESPECIALES

function dia($fecha)
{
    setlocale(LC_TIME, 'Spanish');
    date_default_timezone_set("America/Mexico_City");
    $dias = array(
        'Domingo',
        'Lunes',
        'Martes',
        'Miercoles',
        'Jueves',
        'Viernes',
        'Sabado');

    $f = $dias[date('w', strtotime($fecha))];
    return $f;
}

function fechacompleta($fecha)
{
    setlocale(LC_TIME, 'Spanish');
    date_default_timezone_set("America/Mexico_City");
//    $fecha = strftime("%A %d de %B del %Y");
	$completa = dia($fecha).' '.date("d-M-Y",strtotime($fecha));
    return $completa;
}

function diasvencidos($fecha)
{
    //$fecha="2014-03-01";
    $segundos = strtotime('now') - strtotime($fecha);
    $diferencia_dias = intval($segundos / 60 / 60 / 24);
    return $diferencia_dias;


}

function forma_de_pago($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["formadepago"];
    } else {
        $msg = "";
    }
    return $msg;
}

function plazo_de_pago($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["plazo"];
    } else {
        $msg = "";
    }
    return $msg;
}
function _ivatipo($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["iva_tipo"];
    } else {
        $msg = "";
    }
    return $msg;
}
function _cuentainterna($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["cuenta_interna"];
    } else {
        $msg = "";
    }
    return $msg;
}

function _valoracion($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["valoracion"];
    } else {
        $msg = "";
    }
    return $msg;
}

function _tasainteres($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $hoy =date("Y-m-d");
        if (_fechaultimadepago($nosol)<$hoy){            
            $msg = $row["tasa_interes"] + $row["tasa_moratorio"];
        }
        else
        {
            $msg=$row["tasa_interes"];
            
        }
        
    return $msg;
    }
}
function _tasamoratorio($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["tasa_moratorio"];
    } else {
        $msg = "";
    }
    return $msg;
}

function _cantidad($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["cantidad"];
    } else {
        $msg = "";
    }
    return $msg;
}

function _nombre($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD

        $msg = nombre($row["curp"]);
    } else {
        $msg = "";
    }
    return $msg;
}
function _aval($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD

        $msg = nombre($row["curp_aval"]);
    } else {
        $msg = "";
    }
    return $msg;
}
function _avaltel($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD

        $msg = telefono($row["curp_aval"]);
    } else {
        $msg = "";
    }
    return $msg;
}
function _avaldomicilio($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD

        $msg = domicilio($row["curp_aval"]);
    } else {
        $msg = "";
    }
    return $msg;
}
function _contratos($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE curp = '" . $curp . "'");
    $msg = "";
    while ($fila = mysql_fetch_array($result)) {
        extract($fila);
        $msg = $msg + $nosol . ', ';
    }
    return $msg;
}

function _contratosaval($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD

        $msg = _contratos($row["curp_aval"]);
    } else {
        $msg = "";
    }
    return $msg;
}
function _debealguno($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol .
        "'");
    $msg = "";
    $dbe = 0;
    while ($fila = mysql_fetch_array($result)) {
        extract($fila);
        if ($estado == "X") {
        } else {
            $dbe = $dbe + 1;
        }

    }
    $msg = $dbe;
    return $msg;
}
function _siguientepago($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol .
        "' and estado<>'X' ORDER BY nosol");
    $msg = "";
    $dbe = 0;
	$fila = mysql_fetch_array($result);
   
   // while ($fila = mysql_fetch_array($result)) {
//        extract($fila);
//        if ($estado == "X") {
//        } else {
//            $dbe = $dbe + 1;
//        }

  //  }
    $msg = $fila["no"];
    return $msg;
}

function _abono($nosol,$n)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol .
        "' and no=".$n." ORDER BY nosol");
    $msg = "";
    $dbe = 0;
	$fila = mysql_fetch_array($result);
   
   // while ($fila = mysql_fetch_array($result)) {
//        extract($fila);
//        if ($estado == "X") {
//        } else {
//            $dbe = $dbe + 1;
//        }

  //  }
    $msg = $fila["abono"];
    return $msg;
}



function _estado($nosol,$n)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol .
        "' and no=".$n." ORDER BY nosol");
    $msg = "";
    $dbe = 0;
	$fila = mysql_fetch_array($result);
   

    $msg = $fila["estado"];
    return $msg;
}

function _moratoriodia($nosol, $nopago)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol .
        "'");
    $msg = "";
    $dbe = 0;
    while ($fila = mysql_fetch_array($result)) {
        extract($fila);
        if ($no == $nopago) {
            $cuentaparamoratorio = $abono + $interes + $iva;
			if (forma_de_pago($nosol)=="15"){$cuentaparamoratorio=$cuentaparamoratorio*2;}
			if (forma_de_pago($nosol)=="7"){$cuentaparamoratorio=$cuentaparamoratorio*4;}
            $moratoriomensual = ($cuentaparamoratorio / 100) * _tasamoratorio($nosol);
            $dia = $moratoriomensual / 30;
        }
    }
    return $dia;}

    function _diasdebe($nosol, $nopago)
    {
        mysql_connect('localhost', 'root', 'admin');
        mysql_select_db('bd');
        $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol .
            "'");
        $msg = "";
        $dbe = 0;
        while ($fila = mysql_fetch_array($result)) {
            extract($fila);
            if ($no == $nopago) {
                $dias = diasvencidos($vencimiento);
            }
        }
		if ($dias>0){
        return $dias;
		}else{
			$dias=0;
			return $dias;
		}
    }

    function _moratoriodebe($nosol, $nopago)
    {
        mysql_connect('localhost', 'root', 'admin');
        mysql_select_db('bd');
        $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol .
            "'");
        $msg = "";
        $dbe = 0;
        while ($fila = mysql_fetch_array($result)) {
            extract($fila);
            if ($no == $nopago) {
                $debe = _cuantosdiasdebe($nosol, $nopago) * _moratoriodia($nosol, $nopago);
            }
        }
        if ($debe >0){
			return $debe;}
		else{
			$debe=0;
			return $debe;
		}
    }

    function numtoletras($xcifra)
    {
        $xarray = array(
            0 => "Cero",
            1 => "UN",
            "DOS",
            "TRES",
            "CUATRO",
            "CINCO",
            "SEIS",
            "SIETE",
            "OCHO",
            "NUEVE",
            "DIEZ",
            "ONCE",
            "DOCE",
            "TRECE",
            "CATORCE",
            "QUINCE",
            "DIECISEIS",
            "DIECISIETE",
            "DIECIOCHO",
            "DIECINUEVE",
            "VEINTI",
            30 => "TREINTA",
            40 => "CUARENTA",
            50 => "CINCUENTA",
            60 => "SESENTA",
            70 => "SETENTA",
            80 => "OCHENTA",
            90 => "NOVENTA",
            100 => "CIENTO",
            200 => "DOSCIENTOS",
            300 => "TRESCIENTOS",
            400 => "CUATROCIENTOS",
            500 => "QUINIENTOS",
            600 => "SEISCIENTOS",
            700 => "SETECIENTOS",
            800 => "OCHOCIENTOS",
            900 => "NOVECIENTOS");
        //
        $xcifra = trim($xcifra);
        $xlength = strlen($xcifra);
        $xpos_punto = strpos($xcifra, ".");
        $xaux_int = $xcifra;
        $xdecimales = "00";
        if (!($xpos_punto === false)) {
            if ($xpos_punto == 0) {
                $xcifra = "0" . $xcifra;
                $xpos_punto = strpos($xcifra, ".");
            }
            $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
            $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
        }

        $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
        $xcadena = "";
        for ($xz = 0; $xz < 3; $xz++) {
            $xaux = substr($XAUX, $xz * 6, 6);
            $xi = 0;
            $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
            $xexit = true; // bandera para controlar el ciclo del While
            while ($xexit) {
                if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                    break; // termina el ciclo
                }

                $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
                $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
                for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                    switch ($xy) {
                        case 1: // checa las centenas
                            if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas

                            } else {
                                $key = (int)substr($xaux, 0, 3);
                                if (true === array_key_exists($key, $xarray)) { // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                    $xseek = $xarray[$key];
                                    $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                    if (substr($xaux, 0, 3) == 100)
                                        $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                    $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                                } else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                    $key = (int)substr($xaux, 0, 1) * 100;
                                    $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                } // ENDIF ($xseek)
                            } // ENDIF (substr($xaux, 0, 3) < 100)
                            break;
                        case 2: // checa las decenas (con la misma lógica que las centenas)
                            if (substr($xaux, 1, 2) < 10) {

                            } else {
                                $key = (int)substr($xaux, 1, 2);
                                if (true === array_key_exists($key, $xarray)) {
                                    $xseek = $xarray[$key];
                                    $xsub = subfijo($xaux);
                                    if (substr($xaux, 1, 2) == 20)
                                        $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                    $xy = 3;
                                } else {
                                    $key = (int)substr($xaux, 1, 1) * 10;
                                    $xseek = $xarray[$key];
                                    if (20 == substr($xaux, 1, 1) * 10)
                                        $xcadena = " " . $xcadena . " " . $xseek;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                                } // ENDIF ($xseek)
                            } // ENDIF (substr($xaux, 1, 2) < 10)
                            break;
                        case 3: // checa las unidades
                            if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada

                            } else {
                                $key = (int)substr($xaux, 2, 1);
                                $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                                $xsub = subfijo($xaux);
                                $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                            } // ENDIF (substr($xaux, 2, 1) < 1)
                            break;
                    } // END SWITCH
                } // END FOR
                $xi = $xi + 3;
            } // ENDDO

            if (substr(trim($xcadena), -5, 5) == "ILLON")
                // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE

                $xcadena .= " DE";

            if (substr(trim($xcadena), -7, 7) == "ILLONES")
                // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE

                $xcadena .= " DE";

            // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
            if (trim($xaux) != "") {
                switch ($xz) {
                    case 0:
                        if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                            $xcadena .= "UN BILLON ";
                        else
                            $xcadena .= " BILLONES ";
                        break;
                    case 1:
                        if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                            $xcadena .= "UN MILLON ";
                        else
                            $xcadena .= " MILLONES ";
                        break;
                    case 2:
                        if ($xcifra < 1) {
                            $xcadena = "CERO PESOS $xdecimales/100 M.N.";
                        }
                        if ($xcifra >= 1 && $xcifra < 2) {
                            $xcadena = "UN PESO $xdecimales/100 M.N. ";
                        }
                        if ($xcifra >= 2) {
                            $xcadena .= " PESOS $xdecimales/100 M.N. "; //
                        }
                        break;
                } // endswitch ($xz)
            } // ENDIF (trim($xaux) != "")
            // ------------------      en este caso, para México se usa esta leyenda     ----------------
            $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
            $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
            $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
            $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
            $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
            $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
            $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
        } // ENDFOR ($xz)
        return trim($xcadena);
    }

    // END FUNCTION

    function subfijo($xx)
    { // esta función regresa un subfijo para la cifra
        $xx = trim($xx);
        $xstrlen = strlen($xx);
        if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
            $xsub = "";
        //
        if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
            $xsub = "MIL";
        //
        return $xsub;
    }




function corte($comentario, $usuario, $valor, $nosol, $no, $ahorro)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$hoy=date("Y-m-d");
	$sql = "INSERT INTO corte (comentario,usuario, valor,fecha, nosol,no,ahorro) 

VALUES(
'$comentario',
'$usuario',
'$valor',
'$hoy',
'$nosol',
'$no',
'$ahorro'
)";



if(!mysql_query($sql))//checamos si hay curp
{
	//echo '<img src="img\mal.jpg"> NO SE HA creado';
}else{//si esta, preraramos la actualizacion
	//echo '<img src="img\bien.jpg">Cliente creado satisfactoriamente<br>';	
	$msg="OK";
             
}

mysql_close();
    
	
	
    return $msg;
}


function cargos($comentario, $curp, $valor)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$hoy=date("Y-m-d");
	$sql = "INSERT INTO cargos (concepto, cantidad, fecha, curp) 

VALUES(
'$concepto',
'$cantidad',
'$hoy',
'$curp'
)";



if(!mysql_query($sql))//checamos si hay curp
{
	//echo '<img src="img\mal.jpg"> NO SE HA creado';
}else{//si esta, preraramos la actualizacion
	//echo '<img src="img\bien.jpg">Cliente creado satisfactoriamente<br>';	
	$msg="OK";
             
}

mysql_close();
    
	
	
    return $msg;
}


function _cargos($curp, $c)
    {
        mysql_connect('localhost', 'root', 'admin');
        mysql_select_db('bd');
        $result = mysql_query("SELECT *	FROM extraordinarios WHERE nosol = '" . $nosol ."'");
        $msg = "";
        $dbe = 0;
		$fila = mysql_fetch_array($result);
		$comentario="";
		if ($fila["estado"]<>"X"){
		$dbe =  $fila["cantidad"];
		$comentario = $fila["concepto"];}
        while ($fila = mysql_fetch_array($result)) {
            extract($fila);
			if ($fila["estado"]<>"X"){
			$dbe = $dbe + $fila["cantidad"];
			$comentario = $comentario.', '. $fila["concepto"];};

        }
		if ($c=="SI"){
		return '$ '.$dbe.' por '.$comentario;
		}else{return $dbe;}
    }
	
	

function cargos_pagar($nosol,$no)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$hoy=date("Y-m-d");
	$sql = "UPDATE extraordinario SET
estado='X'
WHERE nosol='$nosol' and no='$no'";

$msg=0;

if(!mysql_query($sql))//checamos si hay curp
{
	//echo '<img src="img\mal.jpg"> NO SE HA creado';
}else{//si esta, preraramos la actualizacion
	//echo '<img src="img\bien.jpg">Cliente creado satisfactoriamente<br>';	
	$msg="OK";
             
}

mysql_close();
    
	
	
    return $msg;
}	

function _debevencidos($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol .
        "'");
    $msg = "";
    $dbe = 0;
	$hoy=date("Y-m-d");
    while ($fila = mysql_fetch_array($result)) {
        extract($fila);
        if ($estado == "X") {
        } else {
			
			if ($fin<$hoy){
            $dbe = $dbe + 1;}
        }

    }
    $msg = $dbe;
    return $msg;
}

function _enquesemana($fecha){
    //$fecha="2009-01-14" ; // fecha.
    
    #separas la fecha en subcadenas y asignarlas a variables
    #relacionadas en contenido, por ejemplo dia, mes y anio.
    
    $dia   = substr($fecha,8,2);
    $mes = substr($fecha,5,2);
    $anio = substr($fecha,0,4);  
    $semana = date('W',  mktime(0,0,0,$mes,$dia,$anio));  

    //donde:
            
    #W (may�scula) te devuelve el n�mero de semana
    #w (min�scula) te devuelve el n�mero de d�a dentro de la semana (0=domingo, #6=sabado)

    $msg = $semana-1 ;
    return $msg;
    
    
    
}

function _tipodecredito($nosol){
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol .
        "'");
    $msg = "";
    $dbe = 0;
	$hoy=date("Y-m-d");
    while ($fila = mysql_fetch_array($result)) {
        extract($fila);
        $msg = $fila["tipo"];

    }

    return $msg;
    
    
}

function _cargo($nosol){
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol .
        "'");
    $msg = "";
    $dbe = 0;
	$hoy=date("Y-m-d");
    while ($fila = mysql_fetch_array($result)) {
        extract($fila);
        $msg = $fila["cargo"];

    }

    return $msg;
    
    
}
function _dia_grupo($fecha)
{
    setlocale(LC_TIME, 'Spanish');
    date_default_timezone_set("America/Mexico_City");
    $dias = array(
        'Domingo',
        'Lunes',
        'Martes',
        'Miercoles',
        'Jueves',
        'Viernes',
        'Sabado');

    $elDia = $dias[date('w', strtotime($fecha))];
    $valido="NO";
        if ($elDia=="Lunes"){$valido="SI";}
        if ($elDia=="Martes"){$valido="SI";}
        if ($elDia=="Miercoles"){$valido="SI";}
    
    return $valido;
}
function _dia_individual($fecha)
{
    setlocale(LC_TIME, 'Spanish');
    date_default_timezone_set("America/Mexico_City");
    $dias = array(
        'Domingo',
        'Lunes',
        'Martes',
        'Miercoles',
        'Jueves',
        'Viernes',
        'Sabado');

    $elDia = $dias[date('w', strtotime($fecha))];
    $valido="NO";
        if ($elDia=="Lunes"){$valido="SI";}
        if ($elDia=="Martes"){$valido="SI";}
		if ($elDia=="Miercoles"){$valido="SI";}
    
    
    return $valido;
}

function _integrantes($nosol)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE nosol = '" . $nosol .  "'");
    $msg = "";
    $fila = mysql_fetch_array($result);
    return $fila["integrantes"].','.$fila["grupo"];
}

function _semanas_retraso($nosol,$n){
	mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol .  "'");
    $msg = "";
    $fila = mysql_fetch_array($result);
	$sem1=$fila["semana"];
	$semHoy=_enquesemana(date("Y-m-d"));
	$retraso=$semHoy-$sem1;
    return ;
	
	
	}
	

function actualizar_vencimiento($nosol,$nuevo_vencimiento)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$sql = "UPDATE cuentas SET
vencimiento='".$nuevo_vencimiento."'
WHERE nosol='$nosol'";
$msg="";


if(!mysql_query($sql))//checamos si hay curp
{
	//echo '<img src="img\mal.jpg"> NO SE HA creado';
}else{//si esta, preraramos la actualizacion
	//echo '<img src="img\bien.jpg">Cliente creado satisfactoriamente<br>';	
	$msg="OK";
             
}
return $msg;
}

function _grupo_esta($nombredelgrupo)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM grupos WHERE nombre = '" . $nombredelgrupo . "'");
    $esta = "";
    if ($row = mysql_fetch_array($result)) {
        $esta = "SI";
    } else {
        $esta = "NO";
    }
    return $esta;
}


function _integrantesdelgrupo($nombredelgrupo)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$hoy=date("Y-m-d");
	$sql = "SELECT * FROM clientes WHERE grupo='".$nombredelgrupo."'";
	$resultado=mysql_query($sql);
//return $sql;
	$integrantes="";
	$cuantos=0;
	
	while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		$integrantes =  $integrantes . ',' . $nombre;
		$cuantos = $cuantos + 1;
		
		}
	if ($cuantos>0){
		return $cuantos.$integrantes;
}
}

function _aquegrupopertenece($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$hoy=date("Y-m-d");
	$sql = "SELECT * FROM clientes WHERE curp='".$curp."'";
	$resultado=mysql_query($sql);
	$fila = mysql_fetch_array($resultado);
	return $fila["grupo"];
}

function _moratoriov2($nosol,$n,$detalle){
	mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	$sql = "SELECT * FROM tabladepagos WHERE nosol='".$nosol."' AND no='".$n."'";
	$resultado=mysql_query($sql);
	$fila = mysql_fetch_array($resultado);
	$semanadelpago= $fila["semana"];
	$aniodelpago = substr($fila["fin"],0,4);
	$anioaactual=date("Y");
	$semanaactual=_enquesemana(date("Y-m-d"));
	//pero si esta fuera del a�o, necesitamos la diferencia de semanas con respecto alfin del a�o
	if ($anioaactual>$aniodelpago){
		$semanashastafindeanio=52-$semanadelpago;
		$diferenciaanio=$anioaactual-$aniodelpago;
		if ($diferenciaanio==1){
			$semanaactual=_enquesemana(date("Y-m-d")) + $semanashastafindeanio;			
			}
		if($diferenciaanio>=2){
			$semanasdemasanios=(($diferenciaanio - 1)*52);
			$semanaactual=_enquesemana(date("Y-m-d")) + $semanashastafindeanio + $semanasdemasanios-1;
            }
				
	}
	$semanasquedebe=$semanaactual-$semanadelpago;
	//valorizar
	$debe=_cargo($nosol)*$semanasquedebe;
		
	if ($detalle=="SI"){
		$msg='Debe '.$debe.' ('.$semanasquedebe.' semanas )';
		return $msg;
		}
		else{
			return $debe;
		}
}

function _cuantospagos($nosol){
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$hoy=date("Y-m-d");
	$sql = "SELECT * FROM tabladepagos WHERE nosol='".$nosol."'";
	$resultado=mysql_query($sql);
	$integrantes="";
	$cuantos=0;
	
	while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		$cuantos = $cuantos + 1;
		
		}
	if ($cuantos>0){
		return $cuantos;
    
    }
 }
 
 function _fechaultimadepago($nosol){    
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	$sql = "SELECT * FROM tabladepagos WHERE nosol='".$nosol."' AND no='"._cuantospagos($nosol)."'";
	$resultado=mysql_query($sql);
    $fila = mysql_fetch_array($resultado);
    //    extract($fila);
	
    return $fila["fin"];
    
    
 }
 
  function _quecurptiene($nosol){    
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	$sql = "SELECT * FROM tabladepagos WHERE nosol='".$nosol."'";
	$resultado=mysql_query($sql);
    $fila = mysql_fetch_array($resultado);
        extract($fila);
	
    return $fila["curp"];
    
    
 }
  function _aquegrupoperteneceestecontrato($nosol){    
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	$sql = "SELECT * FROM cuentas WHERE nosol='".$nosol."'";
	$resultado=mysql_query($sql);
    $fila = mysql_fetch_array($resultado);
        extract($fila);
	
    return $fila["grupo"];
    
    
 }
 
 
 function _cuantosextras($nosol,$no,$q){
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$hoy=date("Y-m-d");
	$sql = "SELECT * FROM extraordinarios WHERE nosol='".$nosol."' AND no='".$no."'";
	$resultado=mysql_query($sql);
	$que="";
	$cuantos=0;
	
	while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		$cuantos = $cuantos + $fila["cantidad"];
		$que =  $que.$fila["cantidad"].' de '.$fila["concepto"].', ';
		
		}
	if ($q=="SI"){
		return $que;
    }else
	{
		return $cuantos;
		}
 }
 
function _descuento($nosol,$no,$q)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM descuetos WHERE nosol = '" . $nosol .
        "' AND  no='".$no."'");
    $msg = "";
    $valor = 0;
    while ($fila = mysql_fetch_array($result)) {
        extract($fila);
       $valor=$valor+$fila["cantidad"];
	   $msg=$msg.$fila["cantidad"].', ';

    }
	if ($q=="SI"){
		return  $msg;
		}else{
			return $valor;
			}
}

function _descuentos_X($nosol,$no)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$hoy=date("Y-m-d");
	$sql = "UPDATE descuetos SET
vantidad='0'
WHERE nosol='$nosol' and no='$no'";

$msg=0;

if(!mysql_query($sql))//checamos si hay curp
{
	//echo '<img src="img\mal.jpg"> NO SE HA creado';
}else{//si esta, preraramos la actualizacion
	//echo '<img src="img\bien.jpg">Cliente creado satisfactoriamente<br>';	
	$msg="OK";
             
}

mysql_close();
    
	
	
    return $msg;
}	

function localidad($curp)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE curp = '" . $curp . "'");
    $msg = "";
    if ($row = mysql_fetch_array($result)) { //si se ha encontrado, capturar SOLICITUD
        $msg = $row["municipio"] . ', ' . $row["estado"];
    } else {
        $msg = "";
    }
    return $msg;
}
function _cuantosgrupo($nombredelgrupo)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	
	$hoy=date("Y-m-d");
	$sql = "SELECT * FROM clientes WHERE grupo='".$nombredelgrupo."'";
	$resultado=mysql_query($sql);
//return $sql;
	$integrantes="";
	$cuantos=0;
	
	while ($fila = mysql_fetch_array($resultado))
		{
		extract($fila);
		$integrantes =  $integrantes . ',' . $nombre;
		$cuantos = $cuantos + 1;
		
		}
	if ($cuantos>0){
		return $cuantos;
}
}

function _ajuste($nosol, $n,$actual){
	mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol .
        "' and no=".$n." ORDER BY nosol");
    $msg = "";
    $dbe = 0;
	$fila = mysql_fetch_array($result);
   	$pago =  $fila["abono"];
	$cv=$actual*_cuantospagos($nosol);
	$d=$cv - _cantidad($nosol);
	
    $msg = $actual-$d;
    return $msg;
	
	
	
	
	
	}
	
 function _fechaprimeradepago($nosol){    
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	$sql = "SELECT * FROM tabladepagos WHERE nosol='".$nosol."' AND no='1'";
	$resultado=mysql_query($sql);
    $fila = mysql_fetch_array($resultado);
        extract($fila);
	
    return $fila["inicio"];
    
    
 }	
 
 
  function _estapagado($nosol){    
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	$sql = "SELECT * FROM tabladepagos WHERE nosol='".$nosol."'";
	$resultado=mysql_query($sql);
    $d=0;    
	while ($fila = mysql_fetch_array($resultado)) {
        extract($fila);
      if ($fila["estado"]=="X"){}else{
		  $d=$d+1;}
	}
    return $d;    
 }	
 
   function _debealgo($curp){    
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	$sql = "SELECT * FROM cuentas WHERE curp='".$curp."'";
	$resultado=mysql_query($sql);
    $d=0;    
	while ($fila = mysql_fetch_array($resultado)) {
        extract($fila);
      		$d=$d+_estapagado($fila["nosol"]);
		 
	}
    return $d;    
 }	
 

 function forma_como($nosol){	 
	$forma =forma_de_pago($nosol);
	$como="";
	if ($forma==7){$como="semanal";}
	if ($forma==15){$como="quincenal";}
	if ($forma==30){$como="mensual";}
	return  $como;
	
 }
 
 function _grupocontratoactual($grupo)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM cuentas WHERE grupo = '" . $grupo .
        "'");
    $msg = "";
    $dbe = 0;

    while ($fila = mysql_fetch_array($result)) {
        extract($fila);
        if (_debealguno($fila["nosol"])>0) {
			$msg=$fila["nosol"];
        } else {
            //$dbe = $dbe + 1;
        }

	}
//    $msg = $dbe;
    return $msg;
}

 function _grupopresidente($grupo)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM clientes WHERE grupo = '" . $grupo .
        "'");
    $msg = "";
    $dbe = 0;

    while ($fila = mysql_fetch_array($result)) {
        extract($fila);
        if ($grupo_cargo == "PRESIDENTE") {
			$msg= $fila["curp"];
        } else {
            $dbe = $dbe + 1;
        }

	}
//    $msg = $dbe;
    return $msg;
}

 function _fechacontrato($nosol){    
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	$sql = "SELECT * FROM cuentas WHERE nosol='".$nosol."'";
	$resultado=mysql_query($sql);
    $fila = mysql_fetch_array($resultado);
        extract($fila);
	
    return $fila["fechacontrato"];
    
    
 }

 function _distribu($nosol,$curp){    
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
	$sql = "SELECT * FROM distribuciones WHERE nosol='".$nosol."' AND curp='".$curp."'";
	$resultado=mysql_query($sql);
    $fila = mysql_fetch_array($resultado);
    //    extract($fila);
	
    return $fila["cantidad"];
    
    
 }
 
 function _ahorro($nosol)
 {
	mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol .
        "'");
    $msg = "";
    $c = 0;

    while ($fila = mysql_fetch_array($result)) {
        extract($fila);
		$c = $c+ $fila["ahorro"];
        
	}
	return $c;
 }
 
 

function _vencidono($nosol,$no)
{
    mysql_connect('localhost', 'root', 'admin');
    mysql_select_db('bd');
    $result = mysql_query("SELECT *	FROM tabladepagos WHERE nosol = '" . $nosol ."' AND no='".$no."'");
   
    	$debe = 0;

    $fila = mysql_fetch_array($result);
    extract($fila);
    if ($fila["estado"] == "X") {
        } else {
			
		$debe=1;
        }

    
    return $debe;
}