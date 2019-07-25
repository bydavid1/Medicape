<?php
class PerfilPaciente{

// database connection and table name
    private $conn;
    private $table_name = "perfil_paciente";

// object properties
    public $idperfil;
    public $fecha;
    public $peso;
    public $altura;
    public $temperatura;
    public $presion;
    public $frec_Cardiaca;
    public $pulso;
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
        idperfil, peso, altura, temperatura, presion, frec_Cardiaca, pulso, idpaciente
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
    SET fecha=:fecha,
    peso=:peso,
    altura=:altura,
    temperatura=:temperatura,
    presion=:presion,
    frec_Cardiaca=:frec_Cardiaca,
    pulso=:pulso,
    idpaciente=:idpaciente";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind values
    $stmt->bindParam(":fecha", $this->fecha);
    $stmt->bindParam(":peso", $this->peso);
    $stmt->bindParam(":altura", $this->altura);
    $stmt->bindParam(":temperatura", $this->temperatura);
    $stmt->bindParam(":presion", $this->presion);
    $stmt->bindParam(":frec_Cardiaca", $this->frec_Cardiaca);
    $stmt->bindParam(":pulso", $this->pulso);
    $stmt->bindParam(":idpaciente", $this->idpaciente);
    
    
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
            peso=:peso,
            altura=:altura,
            temperatura=:temperatura,
            presion=:presion,
            frec_Cardiaca=:frec_Cardiaca,
            pulso=:pulso,
            idpaciente=:idpaciente
            WHERE
            idperfil=:idperfil";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind new values
    $stmt->bindParam(":peso", $this->peso);
    $stmt->bindParam(":altura", $this->altura);
    $stmt->bindParam(":temperatura", $this->temperatura);
    $stmt->bindParam(":presion", $this->presion);
    $stmt->bindParam(":frec_Cardiaca", $this->frec_Cardiaca);
    $stmt->bindParam(":pulso", $this->pulso);
    $stmt->bindParam(":idpaciente", $this->idpaciente);
    $stmt->bindParam(":idperfil", $this->idperfil);  
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
    $query = "DELETE FROM " . $this->table_name . " WHERE idperfil = ?";

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
        $query = "SELECT peso, altura, temperatura, presion, frec_Cardiaca, pulso, idpaciente 
        FROM perfil_paciente 
        WHERE idpaciente = ? AND fecha = 
        (SELECT MAX(fecha) 
        FROM perfil_paciente 
        WHERE idpaciente = ?)";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->idpaciente);
        $stmt->bindParam(2, $this->idpaciente);
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->peso = $row['peso'];
        $this->altura = $row['altura'];
        $this->temperatura = $row['temperatura'];
        $this->presion = $row['presion'];
        $this->frec_Cardiaca = $row['frec_Cardiaca'];
        $this->pulso = $row['pulso'];
        $this->idpaciente = $row['idpaciente'];
        
    }
}