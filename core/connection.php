<?php
class Conexion
{
    private $db;

    public function __construct(){}
    public function __destruct(){}

    public function open(){
        $_host = DB_HOST; 
        $_user = DB_USER;
        $_pass = DB_PASS;
        $_dbase = DB_NAME;
        $_port = 3306;

        $this->db = new mysqli($_host,$_user,$_pass,$_dbase,$_port);
        if($this->db->connect_errno)
        {
            echo "Fallo de Conexion: ".$this->db->connet_error;
            exit();
        }

    }

    public function close()
    {
        $this->db->close();
    }

    public function consult($_sql)
    {

        $result = $this->db->query($_sql);

        $Tabla= array();
        if(!empty($result)){
            while($Fila=$result->fetch_assoc()){
                $Tabla[] = $Fila;
            }
            $result->close();
        }
        return $Tabla;

    }
    public function run($_sql)
    {
        if(!$this->db->query(utf8_decode($_sql)))
        {
            $err = "Fallo en Ejecucion: ".$this->db->error." SQL: ".$_sql;
            echo $err;
            exit();
        }
    }

    public function insert_id($_sql)
    {
        $idGenerado = 0;
        if(!$this->db->query(utf8_decode($_sql)))
        {
            $err = "Fallo en Insert: ".$this->db->error." Sql:".$_sql;
            echo $err;
            exit();
        }
        else
        {
            $idGenerado = $this->db->insert_id;
        }
        return $idGenerado;
    }

}
?>