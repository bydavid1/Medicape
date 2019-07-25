<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/item_expediente.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$item_Exp = new Item_exp($db);

// read products will be here
// read products

// query products
$stmt = $item_Exp->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $item_Exp_arr=array();
    $item_Exp_arr =array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $item_Exp_item=array(
            "iditemexp" => $iditemexp,
            "diagnostico" => $diagnostico,
            "tratamiento" => $tratamiento,
            "observaciones" => $observaciones,
            "receta" => $receta,
            "num_Expediente" => $num_Expediente,
            "descripcion_Exam" => $descripcion_Exam,
            "idpaciente" => $idpaciente,
            "idconsulta" => $idconsulta
            
        );

        array_push($item_Exp_arr, $item_Exp_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($item_Exp_arr);
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No Expedient found.")
    );
}

// no products found will be here