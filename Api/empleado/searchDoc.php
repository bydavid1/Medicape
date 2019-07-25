<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/empleado.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$empleado = new Empleado($db);




$keywords=isset($_GET["query"]) ? $_GET["query"] : "";

// query products
$stmt = $empleado->searchDoc($keywords);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $empleado_arr=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $empleado_item=array(
            "idempleado" => $idempleado,
            "nombres" => $nombres,
            "apellidos" =>$apellidos,
            "email" =>$email,
            "especialidad" => $especialidad
            
        );

        array_push($empleado_arr, $empleado_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data
    echo json_encode($empleado_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No se encontraron Resultados.")
    );
}
?>