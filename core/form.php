<?php 

class Form{

	public static function validateEmail($email){
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
		}
		else{
			Session::setValue("errorEmail", "<span>Email inválido</span>");
			return false;
		} 
	}

	public static function validatePass($pwd1, $pwd2){	
		if (($pwd1 == "") or ($pwd1 !== $pwd2)){
			Session::setValue("errorPass", "<span>Las contraseñas no coinciden</span>");
			return false;
		}else{
			return true;
		}
	}

	public static function validateInt($num, $min="0", $max="9999999999999999"){
		$options = array(
		    'options' => array(
		        'max_range' => $max, 
		        'min_range' => $min
		    )
		);
		if (filter_var($num, FILTER_VALIDATE_INT, $options)){
			return true;
		}
		else return false;
	}

	public static function Required($data, $fields){
		$error = 0;
		$msj = "<p>Los siguientes campos son obligatorios: </p><ul>";
		$field = explode(",", $fields);
		$field = array_map("trim", $field);
		for ($i=0; $i<count($field);$i++){
			if (!isset($data[$field[$i]])||empty($data[$field[$i]])){
				$error = 1;
				$msj .= "<li>".ucfirst($field[$i])."</li>";
			}
		}
		$msj.="</ul>";
		if ($error==0){
			return true;
		}else{
			Session::setValue("errorReq",$msj);
			return false;
		}

	}



}


 ?>