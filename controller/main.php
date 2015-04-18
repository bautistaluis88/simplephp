<?php 
class Main{
	public static function init()
    {

        $user1 = new _User(1);

        echo $user1->getNombre();
    }
}

 ?>