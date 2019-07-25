<?php
class Examen{

// database connection and table name
    private $conn;
    private $table_name = "examenes";

// object properties
    public $idexamen;
    public $tipo_Examen;
    public $fecha_Examen;
    public $estado_examen;
    public $fecha_Limite;
    public $idpaciente;
    public $num_Expediente;

// constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

// read Exam
    function read()
    {
    // select all query
    $query = "SELECT
                idexamen, tipo_Examen, fecha_Examen, estado_examen, fecha_Limite, idpaciente, num_Expediente 
            FROM
                " . $this->table_name;
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    // execute query
    $stmt->execute();

    return $stmt;
    }

// createExam
    function create()
    {
    // query to insert record
    $query = "INSERT INTO " . $this->table_name . " SET  tipo_Examen=:tipo_Examen, fecha_Examen=:fecha_Examen, estado_examen=:estado_examen, fecha_Limite=:fecha_Limite, idpaciente=:idpaciente, num_Expediente=:num_Expediente";

    echo $query;
    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind values
    $stmt->bindParam(":tipo_Examen", $this->tipo_Examen);
    $stmt->bindParam(":fecha_Examen", $this->fecha_Examen);
    $stmt->bindParam(":estado_examen", $this->estado_examen);
    $stmt->bindParam(":fecha_Limite", $this->fecha_Limite);
    $stmt->bindParam(":idpaciente", $this->idpaciente);
    $stmt->bindParam(":num_Expediente", $this->num_Expediente);
    
    // execute query
    if($stmt->execute())
    {
        return true;
    }

    return false;
    }

//updateExam
    function update()
    {

    // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
            tipo_Examen=:tipo_Examen, 
            fecha_Examen=:fecha_Examen, 
            estado_examen=:estado_examen, 
            fecha_Limite=:fecha_Limite, 
            idpaciente=:idpaciente, 
            num_Expediente=:num_Expediente
            WHERE
                idexamen=:idexamen";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind new values
    $stmt->bindParam(":tipo_Examen", $this->tipo_Examen);
    $stmt->bindParam(":fecha_Examen", $this->fecha_Examen);
    $stmt->bindParam(":estado_examen", $this->estado_examen);
    $stmt->bindParam(":fecha_Limite", $this->fecha_Limite);
    $stmt->bindParam(":idpaciente", $this->idpaciente);
    $stmt->bindParam(":num_Expediente", $this->num_Expediente);
    $stmt->bindParam(":idexamen", $this->idexamen);   
    // execute the query
    if($stmt->execute())
    {
        return true;
    }
    return false;
    }

//deleteExam
    function delete()
    {

    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idexamen = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind id of record to delete
    $stmt->bindParam(1, $this->idexamen);

    // execute query
    if($stmt->execute())
    {
        return true;
    }
    return false;

    }

//readOneExam
    function readOne()
    {

        // query to read single record
        $query = "SELECT
                    idexamen, tipo_Examen, fecha_Examen, estado_examen, fecha_Limite, idpaciente, num_Expediente                
                    FROM
                    " . $this->table_name ." 
                WHERE
                    idexamen = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->idexamen);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->tipo_Examen = $row['tipo_Examen'];
        $this->fecha_Examen = $row['fecha_Examen'];
        $this->estado_examen = $row['estado_examen'];
        $this->fecha_Limite = $row['fecha_Limite'];
        $this->idpaciente = $row['idpaciente'];
        $this->num_Expediente = $row['num_Expediente'];
    
        
    }
}