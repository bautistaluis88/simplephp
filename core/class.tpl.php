<?php
Class _{Tabla}
{
    private $oBB;
    {atributos}

	public function __construct($id=null)
    {
        $this->oBB = new Conexion();
        if(!is_null($id))
        {
            $this->oBB->open();
            $result = $this->oBB->consult("SELECT * FROM {tabla} WHERE {AtributoPK}=".$id.";");
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
            $this->{AtributoPK} = null;
        }
    }

    public function s_{AtributoPK}($id)
    {
        $this->{AtributoPK} = $id;
    }

        {seters}

        {geters}

    public function save()
    {
        if($this->{AtributoPK}==null)
        {
            $this->oBB->open();
            $this->{AtributoPK} = $this->oBB->insert_id("INSERT INTO {tabla} ({INSERT_ATRIB}) VALUES ({INSERT_VALUES})");
            $this->oBB->close();
        }
        else
        {
            $this->oBB->open();
            $this->oBB->run("UPDATE {tabla} SET {UPDATE} WHERE {AtributoPK}=".$this->{AtributoPK}.";");
            $this->oBB->close();
        }
    }

    public function delete()
    {
        $this->oBB->open();
        $this->oBB->run("DELETE FROM {tabla} WHERE {AtributoPK}=".$this->{AtributoPK}.";");
        $this->oBB->close();
    }

    //---{{{SimplePHP}}}---//

}

// - Coleccion

Class _Collection{Tabla}
{
    private $oBB;
    private $count;
    public ${tabla};

    public function __construct($condicion=null)
    {
        $this->oBB = new Conexion();
        $this->{tabla} = array();

        if(is_null($condicion))
        {
            $where = "";
        }
        else
        {
            $where = " WHERE ".$condicion;
        }

        $this->oBB->open();
        $result = $this->oBB->consult("SELECT * FROM {tabla} ".$where.";");
        $this->oBB->close();
        $this->count = count($result);
        if(count($result)>0)
        {
            for($i=0;$i<count($result);$i++)
            {
                $ob = new _{Tabla}(null);
                foreach ( $result[$i] as $campo => $valor )
                {
                    $MCampo = 'set'.ucwords($campo);
                    ($campo=='{AtributoPK}')?($ob->s_{AtributoPK}($valor)):($ob->$MCampo($valor));
                }
                array_push($this->{tabla},$ob);
            }

        }

    }

    public function save()
    {
        for($i=0;$i<$this->count;$i++)
        {
            $this->{tabla}[$i]->save();
        }
    }

    public function count()
    {
        return $this->count;
    }

}
?>