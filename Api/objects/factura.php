<?php
class  Factura
{
// database connection and table name
    private $conn;
    private $table_name = "factura";

    // object properties
    public $idfactura;
    public $fecha;
    public $hora;
    public $nombre;
    public $apellido;
    public $idpaciente;
    public $subtotal;
    public $total;
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
                idfactura, fecha, hora, nombre, apellido, idpaciente, total
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
            fecha=:fecha,
            hora=:hora,
            nombre=:nombre,
            apellido=:apellido,
            idpaciente=:idpaciente, 
            total=:total";
            
    /*echo $query;*/

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind values
    $stmt->bindParam(":fecha", $this->fecha);
    $stmt->bindParam(":hora", $this->hora);
    $stmt->bindParam(":nombre", $this->nombre);
    $stmt->bindParam(":apellido", $this->apellido);
    $stmt->bindParam(":idpaciente", $this->idpaciente);
    $stmt->bindParam(":total", $this->total);
    // execute query
    if($stmt->execute())
    {
        return true;
    }

    return false;

    }





function readOne()
{

    // query to read single record
    $query = "SELECT
                idfactura, fecha, hora, nombre, apellido, idpaciente, subtotal, total
            FROM
                " . $this->table_name ." 
            WHERE
            idfactura = ?
            LIMIT
                0,1";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->idfactura);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->fecha = $row['fecha'];
    $this->hora = $row['hora'];
    $this->nombre = $row['nombre'];
    $this->apellido = $row['apellido'];
    $this->idpaciente = $row['idpaciente'];
    $this->subtotal = $row['subtotal'];
    $this->total = $row['total'];

}


function readById()
{

    // query to read single record
    $query = "SELECT
            idfactura, fecha, hora, nombre, apellido, idpaciente, subtotal, total
                FROM
                " . $this->table_name ." 
            WHERE
                idpaciente = ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->idpaciente);

    // execute query
    $stmt->execute();

    return $stmt;
}

}