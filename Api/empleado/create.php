<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/empleado.php';

$database = new Database();
$db = $database->getConnection();

$empleado = new Empleado($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if  (
    !empty($data->nombres) &&
    !empty($data->apellidos) &&
    !empty($data->fecha_Nac) &&
    !empty($data->sexo) &&
    !empty($data->estado_Civil) &&
    !empty($data->dui) &&
    !empty($data->nit) &&
    !empty($data->especialidad) &&
    !empty($data->telefono) &&
    !empty($data->celular) &&
    !empty($data->email) &&
    !empty($data->departamento) &&
    !empty($data->municipio) &&
    !empty($data->direccion) &&
    !empty($data->especialidad) &&
    !empty($data->antecedentes) &&
    !empty($data->solvencia) &&
    !empty($data->constancia_Titulo) &&
    !empty($data->certificado_Salud) &&
    !empty($data->fecha_Contratacion) 
    )
{
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
    
    // create the product
    if($empleado->create())
    {
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "Employee was created."));
    }
    // if unable to create the product, tell the user
    else
    {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to create employee."));
    }
}

// tell the user data is incomplete
else
    {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create employee. Data is incomplete."));
    }
?>