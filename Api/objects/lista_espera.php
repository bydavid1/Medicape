<?php
class ItemEspera
{
// database connection and table name
    private $conn;
    private $table_name = "lista_espera";

    // object properties
    public $idlista;
    public $nombre;
    public $num_Consultorio;


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
                idlista, nombre, num_Consultorio
            FROM
                " . $this->table_name;
    // prepare query statement
    $stmt = $this->conn->prepare($query);
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
            nombre=:nombre,
            num_Consultorio=:num_Consultorio";
            
    /*echo $query;*/

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind values
    $stmt->bindParam(":nombre", $this->nombre);
    $stmt->bindParam(":num_Consultorio", $this->num_Consultorio);


    // execute query
    if($stmt->execute())
    {
        return true;
    }

    return false;

    }

  }