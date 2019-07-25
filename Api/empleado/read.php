<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/empleado.php';

// instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();

// initialize object
    $empleado = new Empleado($db);
// read products will be here
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
// query products
    $stmt = $empleado->read();
    $num = $stmt->rowCount();

// check if more than 0 record found
    if($num>0)
    {
    // products array
    $empleado_arr=array();
    $empleado_arr =array();
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $empleado_item=array(
            "idempleado" => $idempleado,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "fecha_Nac" => $fecha_Nac,
            "sexo" => $sexo,
            "estado_Civil" => $estado_Civil,
            "dui" => $dui,
            "nit" => $nit,
            "especialidad" => $especialidad,
            "telefono" => $telefono,
            "celular" => $celular,
            "email" => $email,
            "departamento" => $departamento,
            "municipio" => $municipio,
            "direccion" => $direccion,
            "antecedentes" => $antecedentes,
            "solvencia" => $solvencia,
            "constancia_Titulo" => $constancia_Titulo,
            "certificado_Salud" => $certificado_Salud,
            "fecha_Contratacion" => $fecha_Contratacion
        );

        array_push($empleado_arr, $empleado_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($empleado_arr);
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No employee found.")
    );
}

// no products found will be here