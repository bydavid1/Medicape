<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';

include_once '../objects/pending_quotes.php';

$database = new Database();
$db = $database->getConnection();

$pending = new pending_quotes($db);

$data = json_decode(file_get_contents("php://input"));


    if(
    !empty($data->fecha) &&
    !empty($data->hora) &&
    !empty($data->tipo) &&
    !empty($data->idpaciente)&&
    !empty($data->nombre)&&
    !empty($data->apellido)
    )
    {

    $pending->fecha = $data->fecha;
    $pending->hora = $data->hora;
    $pending->tipo = $data->tipo;
    $pending->idpaciente = $data->idpaciente;
    $pending->nombre = $data->nombre;
    $pending->apellido = $data->apellido;

    if($pending->create())
    {
        http_response_code(201);
    
        echo json_encode(array("message" => "solicitud was created."));
    }
    else
    {
        http_response_code(503);
    
        echo json_encode(array("message" => "Unable to create quotes."));
    }
    }
    else
    {
    http_response_code(400);
    
    echo json_encode(array("message" => "Unable to create quote. Data is incomplete."));
    }