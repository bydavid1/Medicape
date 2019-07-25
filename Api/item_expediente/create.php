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
include_once '../objects/item_expediente.php';

$database = new Database();
$db = $database->getConnection();

$item_expediente = new Item_exp($db);


// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if  (
    !empty($data->diagnostico) &&
    !empty($data->tratamiento) &&
    !empty($data->observaciones) &&
    !empty($data->receta) &&
    !empty($data->num_Expediente) &&
    !empty($data->idpaciente) &&
    !empty($data->idconsulta)
    )
{
    // set product property values

    $item_expediente->diagnostico = $data->diagnostico;
    $item_expediente->tratamiento = $data->tratamiento;
    $item_expediente->observaciones = $data->observaciones;
    $item_expediente->receta = $data->receta;
    $item_expediente->num_Expediente = $data->num_Expediente;
    $item_expediente->descripcion_Exam = $data->descripcion_Exam;
    $item_expediente->idpaciente = $data->idpaciente;
    $item_expediente->idconsulta = $data->idconsulta;
    $execute =$item_expediente->create();
    // create the product
    if($execute == true)
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