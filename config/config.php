<?php 
//Project Location Config
define("HOST", "simplephp");
define("SERVER_ROOT", $_SERVER['DOCUMENT_ROOT'].HOST);
define("HOME", 'http://localhost/'.HOST."/");
define("CONT", 2);

//Database Configuration
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "limpio");

//Shorcuts variables to access quickly
define("IMG", "/".HOST."/web/images/");
define("CSS", "/".HOST."/web/css/");
define("JS", "/".HOST."/web/js/");
define("LINK", "/".HOST."/");
define("UPLOAD", SERVER_ROOT."/web/uploads/");

//Crypting configuration
define("CIFRADO", MCRYPT_RIJNDAEL_256);
define("MODO", MCRYPT_MODE_ECB);

//Include all Clases
include ("includes.php");
?>