<?php	
class Admin{
	public static function init(){
		
	}
	public static function createClass($tableName){
		SAdmin::createClass($tableName);
	}
    public static function hola(){
        echo "Hola SPHP";
    }
}
?>