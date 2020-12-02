<?php

require "../Model/Functions_Mysql.php";

$login = array("correo"=>"","clave"=>"");

$validar=0;

$expReg = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";

if (count($_POST)==3) {

    foreach ($_POST as $key1 => $value1) {


        foreach ($login as $key2 => $value2) {
            

            if ($key1==$key2) {
                $login[$key2] = $value1;

                if ($validar==0) {

                    if (!preg_match($expReg,$value1)) {
                        $login[$key2] = "";
                        echo "ERROR DE SINTAXIS EN LA PALABRA ESCRITA";

                    }

                    $validar=1;

                }

                
            }

        }

    }

    if ($login["correo"]!="" and $login["clave"]!="") {

        $consulta = "SELECT correo, clave FROM ".TABLAS['user']." WHERE correo='".$login['correo']."' AND clave='".$login['clave']."'";

        $validar = new Consultar();

        $array = $validar->getDates($consulta);

        if ($array) {
            //echo "BIENVENIDO";
            header("Location: ../View/inicio.php");
            die();
        }else{
            echo "Cuenta no valida";
        }

    }

}

?>