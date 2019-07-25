<?php
class Paciente{

// database connection and table name
    private $conn;
    private $table_name = "paciente";

// object properties
    public $idpaciente;
    public $nombres;
    public $apellidos;
    public $fecha_Nac;
    public $sexo;
    public $estado_Civil;
    public $dui;
    public $email;
    public $departamento;
    public $municipio;
    public $direccion;
    public $telefono;
    public $num_Expediente;


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
                idpaciente, nombres, apellidos, fecha_Nac, sexo, estado_Civil, dui, email, departamento, municipio, direccion, telefono, num_Expediente
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
    $query = "INSERT INTO " . $this->table_name . " SET  nombres=:nombres, apellidos=:apellidos, fecha_Nac=:fecha_Nac, sexo=:sexo, estado_Civil=:estado_Civil, dui=:dui, email=:email,  departamento=:departamento, municipio=:municipio, direccion=:direccion, telefono=:telefono, num_Expediente=:num_Expediente";

    echo $query;
    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind values
    $stmt->bindParam(":nombres", $this->nombres);
    $stmt->bindParam(":apellidos", $this->apellidos);
    $stmt->bindParam(":fecha_Nac", $this->fecha_Nac);
    $stmt->bindParam(":sexo", $this->sexo);
    $stmt->bindParam(":estado_Civil", $this->estado_Civil);
    $stmt->bindParam(":dui", $this->dui);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":departamento", $this->departamento);
    $stmt->bindParam(":municipio", $this->municipio);
    $stmt->bindParam(":direccion", $this->direccion);
    $stmt->bindParam(":telefono", $this->telefono);
    $stmt->bindParam(":num_Expediente", $this->num_Expediente);

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
            nombres=:nombres, 
            apellidos=:apellidos, 
            fecha_Nac=:fecha_Nac, 
            sexo=:sexo, estado_Civil=:estado_Civil, 
            dui=:dui,
            telefono=:telefono, 
            email=:email, 
            departamento=:departamento, 
            municipio=:municipio, 
            direccion=:direccion,
            telefono=:telefono
            WHERE
                idpaciente=:idpaciente";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind new values
    $stmt->bindParam(":nombres", $this->nombres);
    $stmt->bindParam(":apellidos", $this->apellidos);
    $stmt->bindParam(":fecha_Nac", $this->fecha_Nac);
    $stmt->bindParam(":sexo", $this->sexo);
    $stmt->bindParam(":estado_Civil", $this->estado_Civil);
    $stmt->bindParam(":dui", $this->dui);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":departamento", $this->departamento);
    $stmt->bindParam(":municipio", $this->municipio);
    $stmt->bindParam(":direccion", $this->direccion);
    $stmt->bindParam(":telefono", $this->telefono);
    $stmt->bindParam(":idpaciente", $this->idpaciente);  
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
                idpaciente, nombres, apellidos, fecha_Nac, sexo, estado_Civil, dui, email, departamento, municipio, direccion, telefono
                FROM
                    " . $this->table_name ." 
                WHERE
                    idpaciente = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->idpaciente);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->nombres = $row['nombres'];
        $this->apellidos = $row['apellidos'];
        $this->fecha_Nac = $row['fecha_Nac'];
        $this->sexo = $row['sexo'];
        $this->estado_Civil = $row['estado_Civil'];
        $this->dui = $row['dui'];
        $this->email = $row['email'];
        $this->departamento = $row['departamento'];
        $this->municipio = $row['municipio'];
        $this->direccion = $row['direccion'];
        $this->telefono = $row['telefono'];
        
    }

//search
    function search($keywords)
    {

    // select all query
    $query = "SELECT
            idpaciente, nombres, apellidos, num_Expediente
            FROM
                " . $this->table_name . " 
            WHERE
            nombres LIKE ? OR apellidos LIKE ? OR num_Expediente LIKE ? ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);

    // execute query
    $stmt->execute();

    return $stmt;
}

}