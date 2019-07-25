<?php
class item_Factura
{
// database connection and table name
    private $conn;
    private $table_name = "item_factura";

    // object properties
    public $iditemfactura;
    public $idfactura;
    public $concepto;
    public $cantidad;
    public $precio;
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
                idfactura, concepto, cantidad, precio, total
            FROM
                " . $this->table_name." 
            WHERE
                idfactura = ?";
    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->idfactura);

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
            idfactura=:idfactura, 
            concepto=:concepto, 
            cantidad=:cantidad, 
            precio=:precio, 
            total=:total";
            
    /*echo $query;*/

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind values
    $stmt->bindParam(":idfactura", $this->idfactura);
    $stmt->bindParam(":concepto", $this->concepto);
    $stmt->bindParam(":cantidad", $this->cantidad);
    $stmt->bindParam(":precio", $this->precio);
    $stmt->bindParam(":total", $this->total);
    // execute query
    if($stmt->execute())
    {
        return true;
    }

    return false;

    }

}