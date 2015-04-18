<?php
class model{

	public static function listar($class, $param='*'){
		$list = new $class();
		return Ftn::toTable($list->listar($param));	
	}

	public static function ver($class, $id='0', $param='*'){
		$object = new $class();
		return Ftn::toTable($object->ver($id, $param));	
	}
}

?>