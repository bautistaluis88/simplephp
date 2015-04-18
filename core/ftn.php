<?php

Class Ftn {

    public static function toArray($obj){
        $array = array();
        while ($fila = $obj->fetch_assoc()){
            $array[] = $fila;
        }
        return $array;
    }

    public static function toTable($array){
        if (!empty($array)){
            $table = "<table border=1><thead><tr>";
            foreach ($array[0] as $key => $value) {
                $table.= "<td><b>".$key."</b></td>";
            }
            $table .= "</tr></thead><tbody>";
            foreach ($array as $key => $value) {
                $table.= "<tr>";
                foreach ($value as $subkey => $subvalue){
                    $table.= "<td>".$subvalue."</td>";    
                }
                $table.="</tr>";
            }
            $table .= "</tbody></table>";
            return $table;
        } else {
            return false;
        }
    }

    public static function intoTable($array){
        if (!empty($array)){
            $table = "</tr>";
            foreach ($array as $key => $value) {
                $table.= "<tr>";
                foreach ($value as $subkey => $subvalue){
                    $table.= "<td>".$subvalue."</td>";    
                }
                $table.="</tr>";
            }
            return $table;
        } else {
            return false;
        }   
    }
    
    public static function difDate($since, $to){
        $since = date_create($since);
        $to = date_create($to);
        $dif = date_diff($since, $to);
        return $dif->format('%R%a');
    }

    public static function crypt($cadena, $clave = "CYGNI")
    {
        return base64_encode(mcrypt_encrypt(CIFRADO, $clave, $cadena, MODO));
    }   

    public static function decrypt($cadena, $clave = "CYGNI")
    {
        return base64_encode(mcrypt_decrypt(CIFRADO, $clave, $cadena, MODO));
    }

    public static function isLogin(){
        $login = true;
        if(!isset($_SESSION['login']) || !$_SESSION['login']){
            $login = false;
        }
        return $login;
    }

    public static function clearPost(){

        if (isset($_POST) && !isEmpty($_POST)){
            $numero2 = count($_POST);
            $tags2 = array_keys($_POST); // obtiene los nombres de las varibles
            $valores2 = array_values($_POST);// obtiene los valores de las varibles

            // crea las variables y les asigna el valor
            for($i=0;$i<$numero2;$i++){
          //      global $$tags2[$i]=$oBB->clearVar($valores2[$i]);
            }
        } else  {
            return false;
        }
    }
}
?>