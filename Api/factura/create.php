<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';

include_once '../objects/factura.php';

$database = new Database();
$db = $database->getConnection();

$factura = new Factura($db);

$data = json_decode(file_get_contents("php://input"));


    if(
    !empty($data->fecha) &&
    !empty($data->hora) &&
    !empty($data->nombre) &&
    !empty($data->apellido) &&
    !empty($data->idpaciente) &&
    !empty($data->total)
    )
    {

    $factura->fecha = $data->fecha;
    $factura->hora = $data->hora;
    $factura->nombre = $data->nombre;
    $factura->apellido = $data->apellido;
    $factura->idpaciente = $data->idpaciente;
    $factura->total = $data->total;

    if($factura->create())
    {
        $id = $db->lastInsertId();

        http_response_code(201);
    
        echo json_encode($id);
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
?>