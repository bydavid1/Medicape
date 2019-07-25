<?php
class Item_Espera
{
// database connection and table name
    private $conn;
    private $table_name = "item_espera";

    // object properties
    public $iditemlista;
    public $idlista;
    public $nombre;
    public $apellido;
    public $idpaciente;


// constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }



// read products
    function read()
    {
    // select all query
    $query = "SELECT
                idlista, nombre, apellido, idpaciente
            FROM
                " . $this->table_name . " WHERE idlista = ?";
    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->idlista);
    // execute query
    $stmt->execute();
    return $stmt;
    }

// create product
    function create()
    {
    // query to insert record
    $query = "INSERT INTO " . $this->table_name . "
            SET 
            idlista=:idlista,
            nombre=:nombre,
            apellido=:apellido, 
            idpaciente=:idpaciente";
            
    /*echo $query;*/

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind values
    $stmt->bindParam(":idlista", $this->idlista);
    $stmt->bindParam(":nombre", $this->nombre);
    $stmt->bindParam(":apellido", $this->apellido);
    $stmt->bindParam(":idpaciente", $this->idpaciente);


    // execute query
    if($stmt->execute())
    {
        return true;
    }

    return false;

    }


// delete the product
    function delete()
    {

    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idlista = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind id of record to delete
    $stmt->bindParam(1, $this->idlista);

    // execute query
    if($stmt->execute())
    {
        return true;
    }
    return false;

    }


}