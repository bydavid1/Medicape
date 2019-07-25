<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/usuario.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$usuario = new Usuario($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

//set ID property of product to be edited
$usuario->iduser = $data->iduser;

//set product property values
    $usuario->user_Password = $data->user_Password;

//update the product
if($usuario->UpdatePassword()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Password was updated."));
}

//if unable to update the product, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to update user."));
}

?>