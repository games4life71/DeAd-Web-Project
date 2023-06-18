<?php


use Firebase\JWT\JWT;
//this api endpoint is used to retrieve the data of a specific inmate

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once '../../vendor/autoload.php';
    require_once  '../Utils/DbConnection.php';
    $config = require '../..//config.php';

//    if (!isset(apache_request_headers()['Authorization'])) {
//        //respond unauthorized
//        http_response_code(401);
//        exit();
//    }
//    $token = apache_request_headers()['Authorization'];
//    $token = str_replace('Bearer ', '', $token);
//    //echo $token;
//
//    $key = $config['secret_key'];


    //TODO validate the token
    //
    $username = $_GET['username'];
    $conn = DbConnection::getInstance()->getConnection();
 //select all the data of a user
    $sql = "SELECT * FROM users where username = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $username);
    $export_data  = array();

    $stmt->execute();
    $result = $stmt->get_result();
     $row = $result->fetch_assoc();
    //print_r($result->fetch_assoc());
    $encode = json_encode($row);
    //get the user id

   $user_id = $row['user_id'];

   $export_data['user_info'] = $encode;

    $stmt = $conn->prepare("SELECT * FROM appointments WHERE person_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $encode = json_encode($result->fetch_assoc());
    $export_data['appointments'] = $encode;

   print_r($export_data) ;


}