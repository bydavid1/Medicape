<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/medicamentos.php';

// instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();

// initialize object
    $medicamento = new Medicamentos($db);
// read products will be here
// read products
    function read()
    {
    // select all query
    $query = "SELECT
            idmedicamentos, nom_Medicamento, cod_Medicamento, cantidad, precio_U, fecha_V           
            FROM
                " . $this->table_name;
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    // execute query
    $stmt->execute();
    return $stmt;
    }
// query products
    $stmt = $medicamento->read();
    $num = $stmt->rowCount();

// check if more than 0 record found
    if($num>0)
    {
    // products array
    $medicamento_arr=array();
    $medicamento_arr =array();
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $medicamento_item=array(
            "idmedicamentos" => $idmedicamentos,
            "nom_Medicamento" => $nom_Medicamento,
            "cod_Medicamento" => $cod_Medicamento,
            "cantidad" => $cantidad,
            "precio_U" => $precio_U,
            "fecha_V" => $fecha_V
        );

        array_push($medicamento_arr, $medicamento_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($medicamento_arr);
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No employee found.")
    );
}