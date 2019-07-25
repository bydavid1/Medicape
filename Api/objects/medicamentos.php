<?php
class Medicamentos{

// database connection and table name
    private $conn;
    private $table_name = "medicamentos";

// object properties
    public $idmedicamentos;
    public $nom_Medicamento;
    public $cantidad;
    public $precio_U;
    public $fecha_V;


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
                idmedicamentos, nom_Medicamento, cod_Medicamento, cantidad, precio_U, fecha_V
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
    $query = "INSERT INTO " . $this->table_name . " SET  nom_Medicamento=:nom_Medicamento, cod_Medicamento=:cod_Medicamento, cantidad=:cantidad, precio_U=:precio_U, fecha_V=:fecha_V";

    echo $query;
    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind values
    $stmt->bindParam(":nom_Medicamento", $this->nom_Medicamento);
    $stmt->bindParam(":cod_Medicamento", $this->cod_Medicamento);
    $stmt->bindParam(":cantidad", $this->cantidad);
    $stmt->bindParam(":precio_U", $this->precio_U);
    $stmt->bindParam(":fecha_V", $this->fecha_V);

    // execute query
    if($stmt->execute())
    {
        return true;
    }

    return false;
    }

//updateEmployee
    function update()
    {

    // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
            nom_Medicamento=:nom_Medicamento, 
            cantidad=:cantidad, 
            precio_U=:precio_U, 
            fecha_V=:fecha_V
            WHERE
            idmedicamentos=:idmedicamentos";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind new values
    $stmt->bindParam(":nom_Medicamento", $this->nom_Medicamento);
    $stmt->bindParam(":cantidad", $this->cantidad);
    $stmt->bindParam(":precio_U", $this->precio_U);
    $stmt->bindParam(":fecha_V", $this->fecha_V);
    $stmt->bindParam(":idmedicamentos", $this->idmedicamentos);  
    // execute the query
    if($stmt->execute())
    {
        return true;
    }
    return false;
    }

//deleteEmployee
    function delete()
    {

    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idpaciente = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind id of record to delete
    $stmt->bindParam(1, $this->idpaciente);

    // execute query
    if($stmt->execute())
    {
        return true;
    }
    return false;

    }

//readOneEmployee
    function readOne()
    {

        // query to read single record
        $query = "SELECT
                idmedicamentos, nom_Medicamento, cantidad, precio_U, fecha_V
                FROM
                    " . $this->table_name ." 
                WHERE
                idmedicamentos = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->idmedicamentos);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->nom_Medicamento = $row['nom_Medicamento'];
        $this->cantidad = $row['cantidad'];
        $this->precio_U = $row['precio_U'];
        $this->fecha_V = $row['fecha_V'];
        
    }
}