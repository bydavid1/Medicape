<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/empleado.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$empleado = new Empleado($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$empleado->idempleado = $data->idempleado;

// set product property values
$empleado->nombres = $data->nombres;
$empleado->apellidos = $data->apellidos;
$empleado->fecha_Nac = $data->fecha_Nac;
$empleado->sexo = $data->sexo;
$empleado->estado_Civil = $data->estado_Civil;
$empleado->dui = $data->dui;
$empleado->nit = $data->nit;
$empleado->especialidad = $data->especialidad;
$empleado->telefono = $data->telefono;
$empleado->celular = $data->celular;
$empleado->email = $data->email;
$empleado->departamento = $data->departamento;
$empleado->municipio = $data->municipio;
$empleado->direccion = $data->direccion;
$empleado->antecedentes = $data->antecedentes;
$empleado->solvencia = $data->solvencia;
$empleado->constancia_Titulo = $data->constancia_Titulo;
$empleado->certificado_Salud = $data->certificado_Salud;
$empleado->fecha_Contratacion = $data->fecha_Contratacion;


// update the empleado
if($empleado->update()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Employee was updated."));
}

// if unable to update the product, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to update Employee."));
}
?>