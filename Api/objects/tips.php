<?php
class Tips
{
// database connection and table name
    private $conn;
    private $table_name = "tips";

    // object properties
    public $idtip;
    public $titulo;
    public $descripcion;

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
                titulo, descripcion
            FROM
                " . $this->table_name;
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    // execute query
    $stmt->execute();
    return $stmt;
    }

    function create()
{
// query to insert record
$query = "INSERT INTO " . $this->table_name . "
        SET 
        titulo=:titulo,
        descripcion=:descripcion";
        
/*echo $query;*/

// prepare query
$stmt = $this->conn->prepare($query);

// bind values
$stmt->bindParam(":titulo", $this->titulo);
$stmt->bindParam(":descripcion", $this->descripcion);

// execute query
if($stmt->execute())
{
    return true;
}

return false;

}
}
?>