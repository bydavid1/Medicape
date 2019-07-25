<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/consultas.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$consulta = new Consultas($db);

// set ID property of record to read
$consulta->idconsulta = isset($_GET['idconsulta']) ? $_GET['idconsulta'] : die();

// read the details of product to be edited
$consulta->readOne();

if($consulta->nombres!=null)
{
    // create array
    $consulta_arr = array(
        "idconsulta" =>  $consulta->idconsulta,
        "fecha" => $consulta->fecha,
        "hora" => $consulta->hora,
        "nombres" => $consulta->nombres,
        "apellidos" => $consulta->apellidos,
        "num_Consultorio" => $consulta->num_Consultorio,
        "nom_Doctor" => $consulta->nom_Doctor

    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($consulta_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Quotes does not exist."));
}
?>