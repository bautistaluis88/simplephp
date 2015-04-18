<?php
class Controller{

    public static function load(){
        session_start();
        $uri = explode("/", $_SERVER['REQUEST_URI']);
        
        $controller = (isset($uri[CONT]) && !empty($uri[CONT]) ? ucfirst($uri[CONT]) : "main");
        $method = (isset($uri[CONT+1]) && !empty($uri[CONT+1])) ? ($uri[CONT+1]) : "";
        $params =  (isset($uri[CONT+2]) && !empty($uri[CONT+2])) ? ($uri[CONT+2]) : "";
        if ($controller !== "web"){
            if (class_exists($controller)){
                if (method_exists($controller, $method))
                {
                    $controller::$method($params);
                }
                else
                {
                    $controller::init();
                }
            }
            else{
                echo "<p>Error: Compruebe la URL. 
                Si piensa que es correcta, pongase en contacto con el administrador</p>
                <a href=".HOME.">Volver a Inicio</a>";
            }
        }
    }
}