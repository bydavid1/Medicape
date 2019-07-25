<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/empleado.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$empleado = new Empleado($db);

// set ID property of record to read
$empleado->idempleado = isset($_GET['idempleado']) ? $_GET['idempleado'] : die();

// read the details of product to be edited
$empleado->readOne();

if($empleado->fecha_Nac!=null)
{
    // create array
    $empleado_arr = array(
        "idempleado" =>  $empleado->idempleado,
        "nombres" => $empleado->nombres,
        "apellidos" => $empleado->apellidos,
        "fecha_Nac" => $empleado->fecha_Nac,
        "sexo" => $empleado->sexo,
        "estado_Civil" => $empleado->estado_Civil,
        "dui" => $empleado->dui,
        "nit" => $empleado->nit,
        "especialidad" => $empleado->especialidad,
        "telefono" => $empleado->telefono,
        "celular" => $empleado->celular,
        "email" => $empleado->apellidos,
        "departamento" => $empleado->departamento,
        "municipio" => $empleado->municipio,
        "direccion" => $empleado->direccion,
        "antecedentes" => $empleado->antecedentes,
        "solvencia" => $empleado->solvencia,
        "constancia_Titulo" => $empleado->constancia_Titulo,
        "certificado_Salud" => $empleado->certificado_Salud,
        "fecha_Contratacion" => $empleado->fecha_Contratacion
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($empleado_arr);
    }
    else
    {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Employee does not exist."));
    }

?>