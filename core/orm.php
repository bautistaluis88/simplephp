<?php 
class ORM{
	private $db;

	public function __construct($db){
		$this->db = $db;
		$this->create();
	}

	private function create(){
		$tableList = $this->db->query("SHOW TABLES FROM ".DB_NAME);
		if ($row = mysqli_fetch_assoc($tableList)){ 
		    //Vaciar la Carpeta
		   	foreach(glob(SERVER_ROOT."/model/*") as $archivos_carpeta){
		   		if ($archivos_carpeta!=".htaccess")
		   			unlink($archivos_carpeta);
		   	}

		   do {
			//Escoger una tabla
			$camposTabla = $this->db->query("DESCRIBE ".$row["Tables_in_".DB_NAME]); 
			$titulo = $row["Tables_in_".DB_NAME];
			$nuevoarchivo = fopen(SERVER_ROOT."\\model\\_".ucfirst($titulo).".php", "w+"); 
			echo "<script>alert(".$nuevoarchivo.");</script>";

			//Recorrer la Tabla
			while ($row = mysqli_fetch_assoc($camposTabla)){
					
				//Iniciar Valores+
				$fields = "";
				$fvalues = "";
				$fkey = "";
				$array_field=array();

				//Crear tabla para mostrar los datos por pantalla
				$string ="<p><table border=1>
							<thead><tr>				
							<td>Field</td>
							<td>Type</td>
							<td>Null</td>
							<td>Key</td>
							<td>Default</td>
							<td>Extra</td>
							</tr></thead>
							<tbody><tr>";

				//Iniciar la CLase
				$class = "<?php\n\nClass _".ucfirst($titulo)."{\n\tprivate \$dbc;\n";
				

				//Recorrer los elementos de la tabla
				do{
					$class.= "\tprivate $".$row["Field"].";\n";
					$fields.= "\n\t\t".$row["Field"].", ";
					$fvalues.= "\n\t\t\$this->".$row["Field"].", ";
					$array_field[]=$row["Field"];

					if ($row["Key"]=="PRI"){
						$fkey = $row["Field"];
					}

					foreach ($row as $key => $value) {
						$string .= "<td>".$value."</td>\n";
					}
					$string.="</tr>";
				}while ($row = mysqli_fetch_assoc($camposTabla));




				$string.="</tbody></table>";
				
				//Constructor
				$class.="\n\n\tpublic function __construct(){\n\t\t\$this->dbc = DB::Connect();\n\t}\n";
				
				//Funccion Save
				$class.="\n\n\tpublic function save(){
		\$query = 'INSERT INTO ".$titulo."(".substr($fields, 0, -2).") values (".substr($fvalues, 0, -2).")';}";

				//Funcion Listar
				$class.="\n\n\tpublic function listar(\$param='*'){
		\t\$query = 'SELECT '.\$param.' FROM ".$titulo." \n\t\t\tORDER BY ".$fkey." DESC';
			if (\$result = \$this->dbc->query(\$query)){
				\$this->dbc->close();
				return Ftn::toArray(\$result);
			}else{
				die('Error de Conexion con la DB: '.\$query);
			}

		}";

			//Funcion Ver
			$class.="\n\n\tpublic function ver(\$".$fkey.", \$param='*'){
		\t\$query = \"SELECT \$param FROM ".$titulo." \n\t\t\tWHERE ".$fkey." = \$".$fkey."\";
		if (\$result = \$this->dbc->query(\$query)){
			\$this->dbc->close();
			return Ftn::toArray(\$result);
		}else{
			die('Error de Conexion con la DB: '.\$query);
		}
	}";

				//Mostrar valores en pantalla
				echo "<h3>".ucfirst($titulo)."</h3><p>".$string."</p>";
				echo "<p>Primaria: ".$fkey."</p>	Indices: ";
			}


			//setters y getters
			foreach ($array_field as $value){
				$class.="\n\n\tpublic function set".ucfirst($value)."(\$".$value."){
					\$this->".$value." = \$".$value.";
				}";

						$class.="\n\n\tpublic function get".ucfirst($value)."(){
					return \$this->".$value.";
				}";

			}

			//Cerrar la Clase
			$class.="\n}\n?>";





			fwrite($nuevoarchivo, $class);
			fclose($nuevoarchivo);
			
		   } while ($row = mysqli_fetch_assoc($tableList)); 
		} else { 
		echo "¡ No se ha encontrado ningún registro !"; 
		} 

	}
}


?>