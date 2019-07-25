<?php
// required headers
header("Access-Control-Allow-Origin: http://localhost/Api/");
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

$usuario = new Usuario($db);
$validate = new Usuario($db);


// get posted data
$data = json_decode(file_get_contents("php://input"));



// set product property values
$usuario->user_Name = $data->user_Name;
$usuario->user_Password = $data->user_Password;


if($usuario->checkUser() == true)
{ 
    http_response_code(200);
}
else
{
    http_response_code(401);
}

// files for jwt will be here
?>