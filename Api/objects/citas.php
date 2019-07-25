<?php
class Cita
{
// database connection and table name
    private $conn;
    private $table_name = "citas";

    // object properties
    public $idcita;
    public $fecha_Cita;
    public $hora_Cita;
    public $nombre_Paciente;
    public $apellido_Paciente;
    public $num_Consultorio;
    public $nombre_Doctor;
    public $num_Expediente;
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
                idcita, fecha_Cita, hora_Cita, nombre_Paciente, apellido_Paciente, num_Consultorio, nombre_Doctor, idpaciente
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
                fecha_Cita=:fecha_Cita, 
                hora_Cita=:hora_Cita, 
                nombre_Paciente=:nombre_Paciente, 
                apellido_Paciente=:apellido_Paciente, 
                num_Consultorio=:num_Consultorio, 
                nombre_Doctor=:nombre_Doctor,
                idpaciente=:idpaciente";

    echo $query;
    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind values
    $stmt->bindParam(":fecha_Cita", $this->fecha_Cita);
    $stmt->bindParam(":hora_Cita", $this->hora_Cita);
    $stmt->bindParam(":nombre_Paciente", $this->nombre_Paciente);
    $stmt->bindParam(":apellido_Paciente", $this->apellido_Paciente);
    $stmt->bindParam(":num_Consultorio", $this->num_Consultorio);
    $stmt->bindParam(":nombre_Doctor", $this->nombre_Doctor);
    $stmt->bindParam(":idpaciente", $this->idpaciente);

    // execute query
    if($stmt->execute())
    {
        return true;
    }

    return false;
    }




    function update()
    {

    // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
            fecha_Cita=:fecha_Cita,
            hora_Cita=:hora_Cita,
            nombre_Paciente=:nombre_Paciente, 
            apellido_Paciente=:apellido_Paciente, 
            num_Consultorio=:num_Consultorio, 
            nombre_Doctor=:nombre_Doctor
            WHERE
                idcita=:idcita";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind new values
    $stmt->bindParam(":fecha_Cita", $this->fecha_Cita);
    $stmt->bindParam(":hora_Cita", $this->hora_Cita);
    $stmt->bindParam(":nombre_Paciente", $this->nombre_Paciente);
    $stmt->bindParam(":apellido_Paciente", $this->apellido_Paciente);
    $stmt->bindParam(":num_Consultorio", $this->num_Consultorio);
    $stmt->bindParam(":nombre_Doctor", $this->nombre_Doctor);
    $stmt->bindParam(":idcita", $this->idcita);    
    // execute the query
    if($stmt->execute())
    {
        return true;
    }
    return false;
    }


    function delete()
    {

    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idcita = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind id of record to delete
    $stmt->bindParam(1, $this->idcita);

    // execute query
    if($stmt->execute())
    {
        return true;
    }
    return false;

    }

//read One Quotes
    function readById()
    {

        // query to read single record
        $query = "SELECT
                    idcita, fecha_Cita, hora_Cita, nombre_Paciente, apellido_Paciente, num_Consultorio, nombre_Doctor
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

//readDate
    function readDate()
    {
    // select all query

    
    $query = "SELECT
    idcita, fecha_Cita, hora_Cita, nombre_Paciente, apellido_Paciente, num_Consultorio, nombre_Doctor, num_Expediente
            FROM    " . $this->table_name ."
            WHERE
            fecha_Cita = CURRENT_DATE ";
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    // execute query
    $stmt->execute();
    return $stmt;
    }



}