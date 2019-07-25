<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/citas.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$cita = new Cita($db);

// set ID property of record to read
$cita->idpaciente = isset($_GET['idpaciente']) ? $_GET['idpaciente'] : die();

// read the details of product to be edited
$stmt = $cita->readById();
$num = $stmt->rowCount();
$cita_arr=array();
if($num>0){

    $cita_arr=array();
    $cita_arr =array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $cita_item=array(
            "idcita" => $idcita,
            "fecha_Cita" => $fecha_Cita,
            "hora_Cita" => $hora_Cita,
            "nombre_Paciente" => $nombre_Paciente,
            "apellido_Paciente" => $apellido_Paciente,
            "num_Consultorio" => $num_Consultorio,
            "nombre_Doctor" => $nombre_Doctor
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
    echo json_encode(
        array("message" => "No quotes found.")
    );
}
?>