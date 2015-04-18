<?php 
class __Admin{
	public static function createClass($tableName){
		$dir = SERVER_ROOT."/model/";
		$maquetaClass = file_get_contents(SERVER_ROOT."/core/class.tpl.php");
		$clase = $tableName;

		//********************************************************************

		$oBB = new Conexion();
		$oBB->open();
		$atrib = $oBB->consult("DESCRIBE ".$clase);
		$oBB->close();

		//Clases
		$defAtrib = "";
		$PK_AutoIncremental = "";
		$seters = "";
		$geters = "";
		$insertAtrib = "";
		$insertValues = "";
		$updateValues = "";


		for($i=0;$i<count($atrib);$i++)
		{
		    //------- Definicion de Atributos
		    $defAtrib = $defAtrib."private $".$atrib[$i]['Field'].";
		        ";
		    //------- Atributo PK AutoIncremental
		    if($atrib[$i]['Extra']=='auto_increment')
		    {
		        $PK_AutoIncremental = $atrib[$i]['Field'];
		    }
		    // -------- Seters
		    if($atrib[$i]['Extra']!='auto_increment')
		    {
		        $seters = $seters."public function set".ucwords($atrib[$i]['Field'])."($".$atrib[$i]['Field'].")
		        {
		            \$this->".$atrib[$i]['Field']." = $".$atrib[$i]['Field'].";
		        }
		        ";
		    }
		    // ------- Geters
		    $geters = $geters."public function get".ucwords($atrib[$i]['Field'])."()
		        {
		        return \$this->".$atrib[$i]['Field'].";
		        }
		        ";
		    //------- Atributo para Insert
		    if($atrib[$i]['Extra']!='auto_increment')
		    {
		        ($insertAtrib=="")?($insertAtrib = $atrib[$i]['Field']):($insertAtrib = $insertAtrib.",".$atrib[$i]['Field']);
		    }

		    //------- Valores para Insert
		    if($atrib[$i]['Extra']!='auto_increment')
		    {
		        if(strpos($atrib[$i]['Type'],'int') || strpos($atrib[$i]['Type'],'tinyint') || strpos($atrib[$i]['Type'],'smallint') || strpos($atrib[$i]['Type'],'mediumint') || strpos($atrib[$i]['Type'],'bigint') || strpos($atrib[$i]['Type'],'float') || strpos($atrib[$i]['Type'],'decimal'))
		        {
		            ($insertValues=="")?($insertValues = "\$this->".$atrib[$i]['Field']):($insertValues = $insertValues.",\$this->".$atrib[$i]['Field']);
		        }
		        else
		        {
		            ($insertValues=="")?($insertValues = "'\$this->".$atrib[$i]['Field']."'"):($insertValues = $insertValues.",'\$this->".$atrib[$i]['Field']."'");
		        }

		    }

		    //-------------- valores para UPDATE
		    if($atrib[$i]['Extra']!='auto_increment')
		    {
		        if(strpos($atrib[$i]['Type'],'int') || strpos($atrib[$i]['Type'],'tinyint') || strpos($atrib[$i]['Type'],'smallint') || strpos($atrib[$i]['Type'],'mediumint') || strpos($atrib[$i]['Type'],'bigint') || strpos($atrib[$i]['Type'],'float') || strpos($atrib[$i]['Type'],'decimal'))
		        {
		            ($updateValues=="")?($updateValues = $atrib[$i]['Field']."=\$this->".$atrib[$i]['Field']):($updateValues = $updateValues.",".$atrib[$i]['Field']."=\$this->".$atrib[$i]['Field']);
		        }
		        else
		        {
		            ($updateValues=="")?($updateValues = $atrib[$i]['Field']."='\$this->".$atrib[$i]['Field']."'"):($updateValues = $updateValues.",".$atrib[$i]['Field']."='\$this->".$atrib[$i]['Field']."'");
		        }

		    }

		}

		$contenido = view::parse($maquetaClass, array(
			"Tabla" => ucwords($clase),
			"tabla" => $clase,
			"atributos" => $defAtrib,
			"AtributoPK" => $PK_AutoIncremental,
			"seters" => $seters,
			"geters" => $geters,
			"INSERT_ATRIB" => $insertAtrib,
			"INSERT_VALUES" => $insertValues,
			"UPDATE" => $updateValues
			)
		);
		$file=fopen($dir."\\_".$clase.".php","w");
		fwrite($file,$contenido);
		fclose($file);
	}
}

 ?>