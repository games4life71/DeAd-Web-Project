<?php


//retrive the visit from appointment table and send it back

use Firebase\JWT\JWT;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require '../Utils/DbConnection.php';
    $conn = DbConnection::getInstance()->getConnection();



    session_start();
    //get the token from the header
    $token = apache_request_headers()['Authorization'];
    $token = str_replace('Bearer ', '', $token);

    //validate it
    $config = require_once '../../config.php';
    require_once('../../vendor/autoload.php');
    try{

        $decoded = JWT::decode($token, new \Firebase\JWT\Key($config['secret_key'], 'HS256'));

    }

    catch (Exception $e) {
        http_response_code(401);
        exit();
    };


    header('Content-Type: application/json');
    //get the user id from params
    $appointment_id = $_GET['visit_id'];

    $appointment_id = strval($appointment_id);
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE appointment_id = ?");

    $stmt->bind_param("s", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo json_encode($row);
    exit();
}
