<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/paciente.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$paciente = new Paciente($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$paciente->idpaciente = $data->idpaciente;

// set product property values
$paciente->nombres = $data->nombres;
$paciente->apellidos = $data->apellidos;
$paciente->fecha_Nac = $data->fecha_Nac;
$paciente->sexo = $data->sexo;
$paciente->estado_Civil = $data->estado_Civil;
$paciente->dui = $data->dui;
$paciente->telefono = $data->telefono;
$paciente->email = $data->email;
$paciente->num_Expediente = $data->num_Expediente;
$paciente->departamento = $data->departamento;
$paciente->municipio = $data->municipio;
$paciente->direccion = $data->direccion;


// update the empleado
if($paciente->update()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Employee was updated."));
}

// if unable to update the product, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to update Employee."));
}
?>