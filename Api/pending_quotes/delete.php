<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once '../objects/pending_quotes.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$quote = new pending_quotes($db);

// get product id
$quote->idpending = isset($_GET['idpending']) ? $_GET['idpending'] : die();

// set product id to be delete

// delete the product
$stmt = $quote->delete();
$num = $stmt->rowCount();
if($num > 0){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Quotes was deleted."));
}else{

    // set response code - 503 service unavailable
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to delete Quotes."));
}
?>