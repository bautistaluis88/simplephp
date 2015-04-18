<?php
Class _User
{
    private $oBB;
    private $Id;
		        private $nombre;
		        private $apellido;
		        private $idCat;
		        

	public function __construct($id=null)
    {
        $this->oBB = new Conexion();
        if(!is_null($id))
        {
            $this->oBB->open();
            $result = $this->oBB->consult("SELECT * FROM user WHERE Id=".$id.";");
            $this->oBB->close();
            if(count($result)>0)
            {
                foreach ($result["0"] as $campo => $valor )
                {
                    $this->$campo = $valor;
                }
            }
        }
        else
        {
            $this->Id = null;
        }
    }

    public function s_Id($id)
    {
        $this->Id = $id;
    }

        public function setNombre($nombre)
		        {
		            $this->nombre = $nombre;
		        }
		        public function setApellido($apellido)
		        {
		            $this->apellido = $apellido;
		        }
		        public function setIdCat($idCat)
		        {
		            $this->idCat = $idCat;
		        }
		        

        public function getId()
		        {
		        return $this->Id;
		        }
		        public function getNombre()
		        {
		        return $this->nombre;
		        }
		        public function getApellido()
		        {
		        return $this->apellido;
		        }
		        public function getIdCat()
		        {
		        return $this->idCat;
		        }
		        

    public function save()
    {
        if($this->Id==null)
        {
            $this->oBB->open();
            $this->Id = $this->oBB->insert_id("INSERT INTO user (nombre,apellido,idCat) VALUES ('$this->nombre','$this->apellido','$this->idCat')");
            $this->oBB->close();
        }
        else
        {
            $this->oBB->open();
            $this->oBB->run("UPDATE user SET nombre='$this->nombre',apellido='$this->apellido',idCat='$this->idCat' WHERE Id=".$this->Id.";");
            $this->oBB->close();
        }
    }

    public function delete()
    {
        $this->oBB->open();
        $this->oBB->run("DELETE FROM user WHERE Id=".$this->Id.";");
        $this->oBB->close();
    }

    //---{{}}---//

}

// - Coleccion

Class _CollectionUser
{
    private $oBB;
    private $count;
    public $user;

    public function __construct($condicion=null)
    {
        $this->oBB = new Conexion();
        $this->user = array();

        if(is_null($condicion))
        {
            $where = "";
        }
        else
        {
            $where = " WHERE ".$condicion;
        }

        $this->oBB->open();
        $result = $this->oBB->consult("SELECT * FROM user ".$where.";");
        $this->oBB->close();
        $this->count = count($result);
        if(count($result)>0)
        {
            for($i=0;$i<count($result);$i++)
            {
                $ob = new _User(null);
                foreach ( $result[$i] as $campo => $valor )
                {
                    $MCampo = 'set'.ucwords($campo);
                    ($campo=='Id')?($ob->s_Id($valor)):($ob->$MCampo($valor));
                }
                array_push($this->user,$ob);
            }

        }

    }

    public function save()
    {
        for($i=0;$i<$this->count;$i++)
        {
            $this->user[$i]->save();
        }
    }

    public function count()
    {
        return $this->count;
    }

}
?>