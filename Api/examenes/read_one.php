<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/examenes.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$examen = new Examen($db);

// set ID property of record to read
$examen->idexamen = isset($_GET['idexamen']) ? $_GET['idexamen'] : die();

// read the details of product to be edited
$examen->readOne();

if($examen->tipo_Examen!=null)
{
    // create array
    $examen_arr = array(
        "idexamen" =>  $examen->idexamen,
        "tipo_Examen" => $examen->tipo_Examen,
        "fecha_Examen" => $examen->fecha_Examen,
        "estado_examen" => $examen->estado_examen,
        "fecha_Limite" => $examen->fecha_Limite,
        "idpaciente" => $examen->idpaciente,
        "num_Expediente" => $examen->num_Expediente
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($examen_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "exam does not exist."));
}
?>