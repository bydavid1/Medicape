<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/examenes.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$examen = new Examen($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$examen->idexamen = $data->idexamen;

// set product property values
    $examen->tipo_Examen = $data->tipo_Examen;
    $examen->fecha_Examen = $data->fecha_Examen;
    $examen->estado_examen = $data->estado_examen;
    $examen->fecha_Limite = $data->fecha_Limite;
    $examen->idpaciente = $data->idpaciente;
    $examen->num_Expediente = $data->num_Expediente;

// update the product
if($examen->update()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "exams was updated."));
}

// if unable to update the product, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to update exam."));
}
?>