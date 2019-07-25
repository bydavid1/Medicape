<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/citas.php';

$database = new Database();
$db = $database->getConnection();

$cita = new Cita($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if  (
    !empty($data->fecha_Cita) &&
    !empty($data->hora_Cita) &&
    !empty($data->nombre_Paciente) &&
    !empty($data->apellido_Paciente) &&
    !empty($data->num_Consultorio) &&
    !empty($data->nombre_Doctor) &&
    !empty($data->idpaciente)
    )
{

    // set product property values
    $cita->fecha_Cita = $data->fecha_Cita;
    $cita->hora_Cita = $data->hora_Cita;
    $cita->nombre_Paciente = $data->nombre_Paciente;
    $cita->apellido_Paciente = $data->apellido_Paciente;
    $cita->num_Consultorio = $data->num_Consultorio;
    $cita->nombre_Doctor = $data->nombre_Doctor;
    $cita->idpaciente = $data->idpaciente;

    // create the product
    if($cita->create())
    {
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "quotes was created."));
    }
    // if unable to create the product, tell the user
    else
    {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to create quotes."));
    }
}

// tell the user data is incomplete
    else
    {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create quote. Data is incomplete."));
    }
?>