<?php 
class Session{

	public static function setValue($var, $value){
		$_SESSION[$var] = $value;
	}

	public static function getValue($var){
		$return = (isset($_SESSION[$var]) && !empty($_SESSION[$var]))?$_SESSION[$var]:"";
		if (stripos($var, "error")!==false)
			$_SESSION[$var] = "";
		return $return;
	}

	public static function isAdmin(){
		if ($_SESSION['usertype']=='admin')
			return true;
		else
			return false;
	}
}

 ?>