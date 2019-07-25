<?php
class Empleado{

// database connection and table name
    private $conn;
    private $table_name = "empleado";

// object properties
    public $idempleado;
    public $nombres;
    public $apellidos;
    public $fecha_Nac;
    public $sexo;
    public $estado_Civil;
    public $dui;
    public $nit;
    public $especialidad;
    public $telefono;
    public $celular;
    public $email;
    public $departamento;
    public $municipio;
    public $direccion;
    public $antecedentes;
    public $solvencia;
    public $constancia_Titulo;
    public $certificado_Salud;
    public $fecha_Contratacion;


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
                idempleado, nombres, apellidos, fecha_Nac, sexo, estado_Civil, dui, nit, especialidad, telefono, celular, email, departamento, municipio, direccion, antecedentes,  solvencia,  constancia_Titulo,  certificado_Salud, fecha_Contratacion
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
            SET  nombres=:nombres, 
                apellidos=:apellidos, 
                fecha_Nac=:fecha_Nac, 
                sexo=:sexo, 
                estado_Civil=:estado_Civil, 
                dui=:dui, 
                nit=:nit, 
                especialidad=:especialidad, 
                telefono=:telefono, 
                celular=:celular, 
                email=:email, 
                departamento=:departamento, 
                municipio=:municipio, 
                direccion=:direccion, 
                antecedentes=:antecedentes, 
                solvencia=:solvencia, 
                constancia_Titulo=:constancia_Titulo, 
                certificado_Salud=:certificado_Salud, 
                fecha_Contratacion=:fecha_Contratacion";

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
    $stmt->bindParam(":nit", $this->nit);
    $stmt->bindParam(":especialidad", $this->especialidad);
    $stmt->bindParam(":telefono", $this->telefono);
    $stmt->bindParam(":celular", $this->celular);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":departamento", $this->departamento);
    $stmt->bindParam(":municipio", $this->municipio);
    $stmt->bindParam(":direccion", $this->direccion);
    $stmt->bindParam(":antecedentes", $this->antecedentes);
    $stmt->bindParam(":solvencia", $this->solvencia);
    $stmt->bindParam(":constancia_Titulo", $this->constancia_Titulo);
    $stmt->bindParam(":certificado_Salud", $this->certificado_Salud);
    $stmt->bindParam(":fecha_Contratacion", $this->fecha_Contratacion);
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
            sexo=:sexo, 
            estado_Civil=:estado_Civil, 
            dui=:dui, 
            nit=:nit,
            especialidad=:especialidad, 
            telefono=:telefono, 
            celular=:celular, 
            email=:email, 
            departamento=:departamento, 
            municipio=:municipio, 
            direccion=:direccion, 
            antecedentes=:antecedentes, 
            solvencia=:solvencia, 
            constancia_Titulo=:constancia_Titulo, 
            certificado_Salud=:certificado_Salud, 
            fecha_Contratacion=:fecha_Contratacion
            WHERE
                idempleado=:idempleado";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind new values
    $stmt->bindParam(":nombres", $this->nombres);
    $stmt->bindParam(":apellidos", $this->apellidos);
    $stmt->bindParam(":fecha_Nac", $this->fecha_Nac);
    $stmt->bindParam(":sexo", $this->sexo);
    $stmt->bindParam(":estado_Civil", $this->estado_Civil);
    $stmt->bindParam(":dui", $this->dui);
    $stmt->bindParam(":nit", $this->nit);
    $stmt->bindParam(":especialidad", $this->especialidad);
    $stmt->bindParam(":telefono", $this->telefono);
    $stmt->bindParam(":celular", $this->celular);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":departamento", $this->departamento);
    $stmt->bindParam(":municipio", $this->municipio);
    $stmt->bindParam(":direccion", $this->direccion);
    $stmt->bindParam(":antecedentes", $this->antecedentes);
    $stmt->bindParam(":solvencia", $this->solvencia);
    $stmt->bindParam(":constancia_Titulo", $this->constancia_Titulo);
    $stmt->bindParam(":certificado_Salud", $this->certificado_Salud);
    $stmt->bindParam(":fecha_Contratacion", $this->fecha_Contratacion);
    $stmt->bindParam(":idempleado", $this->idempleado);  
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
    $query = "DELETE FROM " . $this->table_name . " WHERE idempleado = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind id of record to delete
    $stmt->bindParam(1, $this->idempleado);

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
                idempleado, nombres, apellidos, fecha_Nac, sexo, estado_Civil, dui, nit, especialidad, telefono, celular, email, departamento, municipio, direccion, antecedentes,  solvencia,  constancia_Titulo,  certificado_Salud, fecha_Contratacion
                FROM
                    " . $this->table_name ." 
                WHERE
                    idempleado = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->idempleado);
    
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
        $this->nit = $row['nit'];
        $this->especialidad = $row['especialidad'];
        $this->telefono = $row['telefono'];
        $this->celular = $row['celular'];
        $this->email = $row['email'];
        $this->departamento = $row['departamento'];
        $this->municipio = $row['municipio'];
        $this->direccion = $row['direccion'];
        $this->antecedentes = $row['antecedentes'];
        $this->solvencia = $row['solvencia'];
        $this->constancia_Titulo = $row['constancia_Titulo'];
        $this->certificado_Salud = $row['certificado_Salud'];
        $this->fecha_Contratacion = $row['fecha_Contratacion'];
        
    }

    //search
    function search($keywords)
    {

    // select all query
    $query = "SELECT
            idempleado, nombres, apellidos, especialidad, email
            FROM
                " . $this->table_name . " 
            WHERE
            nombres LIKE ? OR apellidos LIKE ? OR especialidad LIKE ? ";

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

    function searchDoc($keywords)
    {
        $doctor="doctor";
    // select all query
    $query = "SELECT
            idempleado, nombres, apellidos, especialidad, email
            FROM
                " . $this->table_name . " 
            WHERE
            especialidad ='".$doctor."' AND (nombres LIKE ? OR apellidos LIKE ?)  ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
 

    // execute query
    $stmt->execute();
    
    return $stmt;
    }
}