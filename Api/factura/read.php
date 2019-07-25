<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/factura.php';

$database = new Database();
$db = $database->getConnection();


$factura = new Factura($db);

$stmt = $factura->read();
$num = $stmt->rowCount();


    if($num>0)
    {

    $factura_arr=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);

        $factura_item=array(
            "idfactura" => $idfactura,
            "fecha" => $fecha,
            "hora" => $hora,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "idpaciente" => $idpaciente,
            "total" => $total
        );

        array_push($factura_arr, $factura_item);
    }

    http_response_code(200);

    echo json_encode($factura_arr);
    }
    else
    {
    http_response_code(404);

    echo json_encode(array("message" => "No products found."));
}

