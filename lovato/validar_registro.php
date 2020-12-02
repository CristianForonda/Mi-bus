<?php

require "../Model/Functions_Mysql.php";

$regs = array("nombres"=>"",
"apellidos"=>"",
"correo"=>"",
"clave"=>"",
"claveConfi"=>"");


$validar=0;


if (count($_POST)==6) {


    foreach ($_POST as $key1 => $value1) {

        //echo $key1." : ".$value1." <br><br>";


        foreach ($regs as $key2 => $value2) {
            

            if ($key1==$key2) {

                $regs[$key2] = $value1;

                if ($key1=="nombres" OR $key1=="apellidos") {

                    if (!preg_match(EXPREG['letras'],$value1)) {
                        $validar=2;
                        echo "solo letras y espacios <br><br>";
                    }

                }

                if ($key1=="correo" and preg_match(EXPREG['email'],$value1) and $validar==0) {

                    $validar=1;

                    $sentencia = "SELECT * FROM ".TABLAS['user']." WHERE nombres='".$regs['nombres']."' and apellidos='".$regs['apellidos']."' or correo='".$regs['correo']."' ";

                    $consulta = new Consultar();

                    $array = $consulta->getDates($sentencia);

                    if ($array) {
                        $regs[$key2]="";
                    }

                }elseif ($key1=="correo" and !preg_match(EXPREG['email'],$value1)) {
                    echo "el correo no corresponde a un formato valido. ";
                }
                
               /* if ($key1=='telefono' and $value1!="") {
                    if (!preg_match(EXPREG['number'],$value1)) {

                        echo "solo numeros en el campo telefono. ";
                        $validar=0;

                    }
                }*/
                
                if ($key1=="claveConfi") {


                    if ($regs['clave']!=$regs['claveConfi'] or !preg_match(EXPREG['alfanumSE'],$value1)) {
                        $validar=0;

                        echo "claves diferentes o con espacios. ";
                    }
                }

                
            }

        }

    }

    if ($regs["nombres"]!="" and $regs["apellidos"]!="" and $validar==1) {

        $codUs=0;

        $buscar = new Consultar();

        $info = $buscar->getDates("SELECT MAX(idUsuario)+1 AS Ultimo FROM ".TABLAS['user']);


        foreach ($info as $llave) {
            $codUs = $info[0]['Ultimo'];
            //echo $info[0]['Ultimo'];
        }

        //echo var_dump(array_values($info)); revisar estructura array

        $insertar = new Insertar(TABLAS['user']);

        $insertar->add('idUsuario',$codUs);

        foreach ($regs as $key => $value) {
            $insertar->add($key,$value);

            if ($key=="clave") {
            break;
            }

        }

        $insertar->add('TipoUsuario_idTipoUsuario','1');

        $insertar->ready();

        /*$consulta = "SELECT * FROM ".TABLAS['user']." WHERE correo='".$login['correo']."' AND clave='".$login['password']."'";

        $validar = new Consultar();

        $array = $validar->getDates($consulta);

        if ($array) {
            echo "BIENVENIDO";
        }else{
            echo "Cuenta no valida";
        }*/

    }

}

?>