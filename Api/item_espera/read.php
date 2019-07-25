<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/item_espera.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$itemespera = new Item_Espera($db);

// read products will be here
// read products
$itemespera->idlista = isset($_GET['idlista']) ? $_GET['idlista'] : die();
// query products
$stmt = $itemespera->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $itemespera_arr=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $itemespera_item=array(
            "idlista" => $idlista,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "idpaciente" => $idpaciente
        
        );

        array_push($itemespera_arr, $itemespera_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($itemespera_arr);
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No items found.")
    );
}