<?php
function include_all($dir){
	if (is_dir($dir)) {
	    if ($dh = opendir($dir)) {
	        while (($file = readdir($dh)) !== false) {
	            if ($file != "." && $file != ".." && $file != "index.html" && $file!=".htaccess" && $file!="class.tpl.php") {
	                include_once($dir.$file);
	            }   
	    	}
	        closedir($dh);
		}
	}
}
include_all(SERVER_ROOT."/core/");
include_all(SERVER_ROOT."/controller/");
include_all(SERVER_ROOT."/model/");

?>