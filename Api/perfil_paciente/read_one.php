<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/perfil_paciente.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$perfilpaciente = new PerfilPaciente($db);

// set ID property of record to read
$perfilpaciente->idpaciente = isset($_GET['idpaciente']) ? $_GET['idpaciente'] : die();

// read the details of product to be edited
$perfilpaciente->readOne();

if($perfilpaciente->peso!=null)
{
    // create array
    $perfilpaciente_arr = array(
        "peso" => $perfilpaciente->peso,
        "altura" => $perfilpaciente->altura,
        "temperatura" => $perfilpaciente->temperatura,
        "presion" => $perfilpaciente->presion,
        "frec_Cardiaca" => $perfilpaciente->frec_Cardiaca,
        "pulso" => $perfilpaciente->pulso,
        "idpaciente" => $perfilpaciente->idpaciente
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($perfilpaciente_arr);
    }
    else
    {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Employee does not exist."));
    }

?>