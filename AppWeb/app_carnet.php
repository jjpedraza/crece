<?php
include("head.php");
include("header.php");

if (isset($_GET['id'])){
    $Curp = VarClean($_GET['id']);

    $sql = "select * from clientes where curp='".$Curp."'";
    // echo $sql;
    $rc = $db1->query($sql);    
    
    if ($db1->query($sql) == TRUE){
        if($f = $rc -> fetch_array())
        {
            echo "<div id='ClienteForm'>";
            
            echo "<div class='row'>";
                echo '
                <div class="form-group col-sm btn btn-info">
                    <label for="exampleFormControlInput1">CURP:</label>
                    <b>'.$Curp.'</b>
                </div>';

                echo '
                <div class="form-group col-md">
                    <label for="exampleFormControlInput1">Nombre del Cliente:</label>
                    <input style="
                        background-color: orange;
                        color: white;
                    " type="text" class="form-control" name="nombre" id="nombre" placeholder="" value="'.$f['nombre'].'">
                </div>';


               
            echo "</div>";




            echo "<div class='row'>";
                echo '
                <div class="form-group col-sm">
                    <label for="exampleFormControlInput1">Domicilio:</label>
                    <textarea class="form-control" name="domicilio" id="domicilio" placeholder="" style="font-size:8pt;">'.$f['domicilio'].'</textarea>
                </div>';


                echo '
                <div class="form-group col-sm">
                    <label for="exampleFormControlInput1">Municipio:</label>
                    <input type="text" class="form-control" name="municipio" id="municipio" placeholder="" value="'.$f['municipio'].'">
                </div>';


                echo '
                <div class="form-group col-sm">
                    <label for="exampleFormControlInput1">Estado:</label>
                    <input type="text" class="form-control" name="estado" id="estado" placeholder="" value="'.$f['estado'].'">
                </div>';
            echo "</div>";

         




            echo "<div class='row'>";
                echo '
                        <div class="form-group col-sm">
                            <label for="exampleFormControlInput1">IFE:</label>
                            <input type="text" class="form-control" name="ife" id="ife" placeholder="" value="'.$f['IFE'].'">
                        </div>';


                echo '
                <div class="form-group col-sm">
                    <label for="exampleFormControlInput1">Correo electronico:</label>
                    <input type="text" class="form-control" name="correo" id="correo" placeholder="" value="'.$f['correo'].'">
                </div>';


                echo '
                <div class="form-group col-sm">
                    <label for="exampleFormControlInput1">Estado Civil:</label>
                    <input type="text" class="form-control" name="estadocivil" id="estadocivil" placeholder="" value="'.$f['estadocivil'].'">
                </div>';
            echo "</div>";


            echo "<hr><div class='row'>";
                echo '
                        <div class="form-group col-sm">
                            <label for="exampleFormControlInput1">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" name="fechadenacimiento" id="fechadenacimiento" placeholder="" value="'.$f['fechadenacimiento'].'">
                        </div>';


                echo '
                <div class="form-group col-sm">
                    <label for="exampleFormControlInput1">Profesion:</label>
                    <input type="text" class="form-control" name="profesion" id="profesion" placeholder="" value="'.$f['profesion'].'">
                </div>';



                echo '
                <div class="form-group col-sm">
                    <label for="exampleFormControlInput1">Sexo: '.$f['sexo'].'</label>';
                    echo '
                    <select class="form-control" id="exampleFormControlSelect1">';

                    if ($f['sexo']=='mujer'){
                        echo '<option value="mujer" selected>mujer</option>';
                        echo '<option value="hombre" >hombre</option>';
                    } else {
                        echo '<option value="mujer" >mujer</option>';
                        echo '<option value="hombre" selected >hombre</option>';

                    }

                  echo '</select>';

                echo '                    
                </div>';
            echo "</div>";       
            
            
            //estudio socioeconomico

            echo '
            <div id="accordion">
                <div class="card">';

                 echo '
                    <div class="card-header" id="headingOne" style="
                    background-color:#cecece;
                    color:black;
                    ">
                    <h5 class="mb-0">
                    <button class="btn " data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="display:block;width:100%;">
                       Estudio Socio-economico
                    </button>
                    </h5>
                </div>
            
                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion"
                style="
                background-color: #e3e2e3;"
                >
                    <div class="card-body">
                   ';

                   echo "<div class='row'>";
                   echo '
                   <div class="form-group col-sm">
                       <label for="exampleFormControlInput1">Domicilio:</label>
                       <textarea class="form-control" name="domicilio" id="domicilio" placeholder="" style="font-size:8pt;">'.$f['domicilio'].'</textarea>
                   </div>';
   
   
                   echo '
                   <div class="form-group col-sm">
                       <label for="exampleFormControlInput1">Municipio:</label>
                       <input type="text" class="form-control" name="municipio" id="municipio" placeholder="" value="'.$f['municipio'].'">
                   </div>';
   
   
                   echo '
                   <div class="form-group col-sm">
                       <label for="exampleFormControlInput1">Estado:</label>
                       <input type="text" class="form-control" name="estado" id="estado" placeholder="" value="'.$f['estado'].'">
                   </div>';
               echo "</div>";

                   echo '
                    </div>
                </div>';
        echo '</div>
        
        </div>';



         

            echo '                    
            </div>';
        echo "</div>";          
            echo "</div>";

        } else {
            Error("No existe ningun usuario con esta curp ".$Curp);
        }
        

    } else {
        Error("Error al consultar al usuario ".$Curp);
    }





} else {
    Error("Parametros incorrectos");
}





include("footer.php");
?>