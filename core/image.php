<?php

Class Image extends File{

	private $file;

	public function __construct(){
		
	}

	public function listImg($dir){
		$file = new file();
		$list = $file->listDir($dir);
		$imgList = array();
		foreach ($list as $key => $value) {
			@$ext = strtolower(explode(".",$value["fileName"])[1]);
			if (in_array($ext, ["jpg", "png", "jpeg", "png", "ico"])){
				$imgList[] = $value;
			}
		}
		return $imgList;
	}
}
?>