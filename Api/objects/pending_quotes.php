<?php
class pending_quotes
{
// database connection and table name
    private $conn;
    private $table_name = "pending_quotes";

    // object properties
    public $idpending;
    public $fecha;
    public $hora;
    public $tipo;
    public $idpaciente;
    public $nombre;
    public $apellido;

// constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
    // select all query
    $query = "SELECT
              idpending, fecha, hora, tipo, idpaciente, nombre, apellido
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
    // select all query
    $query = "INSERT INTO " . $this->table_name . "
            SET 
            fecha=:fecha,
            hora=:hora,
            tipo=:tipo,
            nombre=:nombre,
            apellido=:apellido,
            idpaciente=:idpaciente";
      
      // prepare query
      $stmt = $this->conn->prepare($query);

      // bind values
      $stmt->bindParam(":fecha", $this->fecha);
      $stmt->bindParam(":hora", $this->hora);
      $stmt->bindParam(":tipo", $this->tipo);
      $stmt->bindParam(":nombre", $this->nombre);
      $stmt->bindParam(":apellido", $this->apellido);
      $stmt->bindParam(":idpaciente", $this->idpaciente);
      
      if($stmt->execute())
      {
          return true;
      }else{
          return false;
      }
    }

    function customRead()
    {
    // select all query
    $query = "SELECT
                fecha, hora, tipo
            FROM
                " . $this->table_name ." WHERE idpaciente = ?";
    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->idpaciente);
    // execute query
    $stmt->execute();
    
    return $stmt;
    }

    function delete()
    {

    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idpending = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind id of record to delete
    $stmt->bindParam(1, $this->idpending);

    $stmt->execute();
    // execute query
  return $stmt;
    }
}
?>