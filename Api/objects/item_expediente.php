<?php
class Item_exp{

// database connection and table name
    private $conn;
    private $table_name = "item_expediente";
// object properties
    public $iditemexp;
    public $diagnostico;
    public $tratamiento;
    public $observaciones;
    public $receta;
    public $num_Expediente;
    public $descripcion_Exam;
    public $idpaciente;
    public $idconsulta;
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
                iditemexp, diagnostico, tratamiento, observaciones, receta, num_Expediente, descripcion_Exam, idpaciente, idconsulta
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
    $query = "INSERT INTO " . $this->table_name . " 
                SET 
                diagnostico=:diagnostico,
                tratamiento=:tratamiento,
                observaciones=:observaciones, 
                receta=:receta, 
                num_Expediente=:num_Expediente, 
                descripcion_Exam=:descripcion_Exam,
                idpaciente=:idpaciente,
                idconsulta=:idconsulta";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind values

    $stmt->bindParam(":diagnostico", $this->diagnostico);
    $stmt->bindParam(":tratamiento", $this->tratamiento);
    $stmt->bindParam(":observaciones", $this->observaciones);
    $stmt->bindParam(":receta", $this->receta);
    $stmt->bindParam(":num_Expediente", $this->num_Expediente);
    $stmt->bindParam(":descripcion_Exam", $this->descripcion_Exam);
    $stmt->bindParam(":idpaciente", $this->idpaciente);
    $stmt->bindParam(":idconsulta", $this->idconsulta);

    
    
    // execute query
    if($stmt->execute())
    {
        return true;
        

    }

    return null;
    }

//updateExam
    function update()
    {

    // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
            fecha_Consulta=:fecha_Consulta, 
            diagnostico=:diagnostico,
            tratamiento=:tratamiento,
            observaciones=:observaciones, 
            receta=:receta, 
            num_Expediente=:num_Expediente, 
            descripcion_Exam=:descripcion_Exam,
            idpaciente=:idpaciente
            WHERE
            iditemexp=:iditemexp";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind new values
    $stmt->bindParam(":fecha_Consulta", $this->fecha_Consulta);
    $stmt->bindParam(":diagnostico", $this->diagnostico);
    $stmt->bindParam(":tratamiento", $this->tratamiento);
    $stmt->bindParam(":observaciones", $this->observaciones);
    $stmt->bindParam(":receta", $this->receta);
    $stmt->bindParam(":num_Expediente", $this->num_Expediente);
    $stmt->bindParam(":descripcion_Exam", $this->descripcion_Exam);
    $stmt->bindParam(":idpaciente", $this->idpaciente);
    $stmt->bindParam(":iditemexp", $this->iditemexp);   

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
    $query = "DELETE FROM " . $this->table_name . " WHERE iditemexp = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind id of record to delete
    $stmt->bindParam(1, $this->iduser);

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
                diagnostico, tratamiento, observaciones, receta, num_Expediente, descripcion_Exam
                    FROM
                    " . $this->table_name ." 
                WHERE
                idconsulta = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->idconsulta);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->diagnostico = $row['diagnostico'];
        $this->tratamiento = $row['tratamiento'];
        $this->observaciones = $row['observaciones'];
        $this->receta = $row['receta'];
        $this->num_Expediente = $row['num_Expediente'];
        $this->descripcion_Exam = $row['descripcion_Exam'];
        
    }
}