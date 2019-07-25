<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/paciente.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$paciente = new Paciente($db);

// set ID property of record to read
$paciente->idpaciente = isset($_GET['idpaciente']) ? $_GET['idpaciente'] : die();

// read the details of product to be edited
$paciente->readOne();

if($paciente->fecha_Nac!=null)
{
    // create array
    $paciente_arr = array(
        "idpaciente" =>  $paciente->idpaciente,
        "nombres" => $paciente->nombres,
        "apellidos" => $paciente->apellidos,
        "fecha_Nac" => $paciente->fecha_Nac,
        "sexo" => $paciente->sexo,
        "estado_Civil" => $paciente->estado_Civil,
        "dui" => $paciente->dui,
        "email" => $paciente->apellidos,
        "departamento" => $paciente->departamento,
        "municipio" => $paciente->municipio,
        "direccion" => $paciente->direccion,
        "telefono" => $paciente->telefono
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($paciente_arr);
    }
    else
    {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Patients does not exist."));
    }

?>