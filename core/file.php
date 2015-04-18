<?php

Class File{
	private $dbc;
	private $file;

	public function __construct($tempFile=array()){
		//$this->dbc = DB::Connect();
		$this->file = $this->checkUpload($tempFile) ? $tempFile : array();
	}

	public function checkUpload($tempFile){
	    @$archivo = (is_uploaded_file($tempFile['tmp_name'])) ? true : false;;
	    return $archivo;
	}
	
	public function getFile(){
		return $this->file;
	}

	public function getInfo(){
		return ftn::totable(array('0'=>$this->file));
	}

	public function getName(){
		return basename($this->file['tmp_name']);
	}

	public function save($path=UPLOAD){
		return move_uploaded_file($this->file['tmp_name'], $path.basename($this->file['name'])) ? "Exito" : "fallo: ".$path.basename($this->file['name']);
	}

	public function listDir($path=UPLOAD){
		$path = (UPLOAD != $path && $path!="") ? UPLOAD.basename($path)."/" : UPLOAD;
		$list = array();
		$i=0;
		if (is_dir($path)){
			if ($dh = opendir($path)) {
				while (($newFile = readdir($dh)) !== false && $i<15) {
					if ($newFile != "." && $newFile != ".." && $newFile != "index.html" && $newFile != ".htaccess")	{
	    				$fileName = basename($newFile);
	    				$fileLink = HOME."web/uploads/".(UPLOAD != $path ? basename($path)."/" : "").$fileName;
						$fileSize = round(filesize($path.$fileName)/(1024));
	            		$list[]=array(	'fileUrl' => $fileLink, 
	        							'fileName' => $fileName,
	        							'size' => $fileSize." Kb" );
	            		$i++;
					}
	    		}
			}
		}
		return $list;
	}	
}
?>