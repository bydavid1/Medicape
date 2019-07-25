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
include_once '../objects/paciente.php';

$database = new Database();
$db = $database->getConnection();

$paciente = new Paciente($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if  (
    !empty($data->nombres) &&
    !empty($data->apellidos) &&
    !empty($data->fecha_Nac) &&
    !empty($data->sexo) &&
    !empty($data->estado_Civil) &&
    !empty($data->dui) &&
    !empty($data->email) &&
    !empty($data->departamento) &&
    !empty($data->municipio) &&
    !empty($data->direccion) &&
    !empty($data->telefono) &&
    !empty($data->num_Expediente))
{
    // set product property values
    $paciente->nombres = $data->nombres;
    $paciente->apellidos = $data->apellidos;
    $paciente->fecha_Nac = $data->fecha_Nac;
    $paciente->sexo = $data->sexo;
    $paciente->estado_Civil = $data->estado_Civil;
    $paciente->dui = $data->dui;
    $paciente->email = $data->email;
    $paciente->departamento = $data->departamento;
    $paciente->municipio = $data->municipio;
    $paciente->direccion = $data->direccion;
    $paciente->telefono = $data->telefono;
    $paciente->num_Expediente = $data->num_Expediente;
    
    // create the product
    if($paciente->create())
    {
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "Paciente Creado."));
    }
    // if unable to create the product, tell the user
    else
    {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Paciente no creado."));
    }
}

// tell the user data is incomplete
else
    {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create employee. Data is incomplete."));
    }
?>