<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/item_factura.php';

$database = new Database();
$db = $database->getConnection();


$factura = new item_Factura($db);

// set ID property of record to read
$factura->idfactura = isset($_GET['idfactura']) ? $_GET['idfactura'] : die();

// read the details of product to be edited
$stmt = $factura->read();
$num = $stmt->rowCount();
$cita_arr=array();
if($num>0){

    $factura_arr=array();
    $factura_arr =array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $factura_item=array(
            "idfactura" => $idfactura,
            "concepto" => $concepto,
            "cantidad" => $cantidad,
            "precio" => $precio,
            "total" => $total
        );

        array_push($factura_arr, $factura_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($factura_arr);
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No invoices found.")
    );
}
?>