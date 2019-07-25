<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/item_expediente.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$itemExp = new Item_exp($db);

// set ID property of record to read
$itemExp->idconsulta = isset($_GET['idconsulta']) ? $_GET['idconsulta'] : die();

// read the details of product to be edited
$itemExp->readOne();

if($itemExp->diagnostico!=null)
{
    // create array
    $itemExp_arr = array(
        "diagnostico" => $itemExp->diagnostico,
        "tratamiento" =>  $itemExp->tratamiento,
        "observaciones" => $itemExp->observaciones,
        "receta" => $itemExp->receta,
        "num_Expediente" => $itemExp->num_Expediente,
        "descripcion_Exam" =>  $itemExp->descripcion_Exam  
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($itemExp_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Expedient does not exist."));
}
?>