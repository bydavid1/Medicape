<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/citas.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$cita = new Cita($db);

// read products will be here
// read products

// query products
$stmt = $cita->readDate();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $cita_arr=array();


    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $cita_item=array(
            "idcita" => $idcita,
            "fecha_Cita" => $fecha_Cita,
            "hora_Cita" => $hora_Cita,
            "nombre_Paciente" => $nombre_Paciente,
            "apellido_Paciente" => $apellido_Paciente,
            "num_Consultorio" => $num_Consultorio,
            "nombre_Doctor" => $nombre_Doctor,
            "num_Expediente" => $num_Expediente
        );

        array_push($cita_arr, $cita_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($cita_arr);
}
else{

    // set response code - 404 Not found
    
    http_response_code(404);
    // tell the user no products found
    
}