<?php


class Mysql extends Connection
{
    private $connection;
    private $strquery;
    private $arrValues;

    public function __construct()
    {
        $this->connection = new Connection();
        $this->connection =  $this->connection->connect();
    }

    //Insertar un registro
    public function insert(string $query, array $values)
    {
        $this->strquery = $query;
        $this->arrValues = $values;
        $result = $this->connection->prepare($this->strquery);
        return  $result->execute($this->arrValues);
    }

    //Traer un registro
    public function select(string $query)
    {
        $this->strquery = $query;
        $result = $this->connection->prepare($this->strquery);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    //Traer todos los registros
    public function selectAll(string $query)
    {
        $this->strquery = $query;
        $result = $this->connection->prepare($this->strquery);
        $result->execute();
        return $result->fetchall(PDO::FETCH_ASSOC);
    }

    //Actualizar un registro
    public function update(string $query, array $values){
        $this->strquery = $query;
        $this->arrValues = $values;
        $result = $this->connection->prepare($this->strquery);
        return $result->execute($this->arrValues);
    }

    //Eliminar un registro
    public function delete(string $query){
        $this->strquery = $query;
        $result = $this->connection->prepare($this->strquery);
        return $result->execute();

    }
}