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
include_once '../objects/lista_espera.php';

$database = new Database();
$db = $database->getConnection();

$itemespera = new ItemEspera($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if  (
    !empty($data->nombre) &&
    !empty($data->num_Consultorio) 
    )
{

    // set product property values
    $itemespera->nombre = $data->nombre;
    $itemespera->num_Consultorio = $data->num_Consultorio;
    
    // create the product
    if($itemespera->create())
    {
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "list was created."));
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