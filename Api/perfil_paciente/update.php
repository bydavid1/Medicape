<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/perfil_paciente.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$perfilpaciente = new PerfilPaciente($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$perfilpaciente->idpaciente = $data->idpaciente;

// set product property values
$perfilPaciente->peso = $data->peso;
$perfilPaciente->altura = $data->altura;
$perfilPaciente->temperatura = $data->temperatura;
$perfilPaciente->presion = $data->presion;
$perfilPaciente->frec_Cardiaca = $data->frec_Cardiaca;
$perfilPaciente->pulso = $data->pulso;



// update the empleado
if($perfilPaciente->update()){

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