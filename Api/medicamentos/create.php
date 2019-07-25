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
include_once '../objects/medicamentos.php';

$database = new Database();
$db = $database->getConnection();

$medicamento = new Medicamentos($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if  (
    !empty($data->nom_Medicamento) &&
    !empty($data->cantidad) &&
    !empty($data->cod_Medicamento) &&
    !empty($data->precio_U) &&
    !empty($data->fecha_V)  
    )
{
    // set product property values
    $medicamento->nom_Medicamento = $data->nom_Medicamento;
    $medicamento->cod_Medicamento = $data->cod_Medicamento;
    $medicamento->cantidad = $data->cantidad;
    $medicamento->precio_U = $data->precio_U;
    $medicamento->fecha_V = $data->fecha_V;


    
    // create the product
    if($medicamento->create())
    {
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "Medicamento Agregado."));
    }
    // if unable to create the product, tell the user
    else
    {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Medicamento no creado."));
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