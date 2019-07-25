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
include_once '../objects/perfil_paciente.php';

$database = new Database();
$db = $database->getConnection();

$perfilPaciente = new PerfilPaciente($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if  (
    !empty($data->fecha) &&
    !empty($data->peso) &&
    !empty($data->altura) &&
    !empty($data->temperatura) &&
    !empty($data->presion) &&
    !empty($data->frec_Cardiaca) &&
    !empty($data->pulso) &&
    !empty($data->idpaciente)
    
    )
{

    // set product property values
    $perfilPaciente->fecha = $data->fecha;
    $perfilPaciente->peso = $data->peso;
    $perfilPaciente->altura = $data->altura;
    $perfilPaciente->temperatura = $data->temperatura;
    $perfilPaciente->presion = $data->presion;
    $perfilPaciente->frec_Cardiaca = $data->frec_Cardiaca;
    $perfilPaciente->pulso = $data->pulso;
    $perfilPaciente->idpaciente = $data->idpaciente;
    // create the product
    if($perfilPaciente->create())
    {
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "profile was created."));
    }
    // if unable to create the product, tell the user
    else
    {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to create profile."));
    }
}

// tell the user data is incomplete
    else
    {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create profile. Data is incomplete."));
    }
?>