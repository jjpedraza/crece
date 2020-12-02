<?
function comprobar_email($email){
    $mail_correcto = 0;
    //Checar la longitud del mail que sea mayor a 0 y que contenga solamente 1 arroba
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1)){
        //verificar si tiene un punto
          if (substr_count($email,".")>= 1){
           //verificar que tenga algo despues del punto
             $term_dom = substr(strrchr ($email, '.'),1);
             //compruebo que la terminación del dominio sea correcta
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    
    if ($mail_correcto)
       return 1;
    else
       return 0;
} 

function no_control($no_control){
 $correcto = 0;
 if (strlen($no_control) == 8 )
       $correcto=1;
else 
      $correcto=0;

if($correcto)
    return 1;
  else
     return 0;

   }

?>