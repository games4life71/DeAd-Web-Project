<?php
use Firebase\JWT\Key;
use Firebase\JWT\JWT;
//this api endpoint is used to retrieve the data of a specific inmate

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once '../../vendor/autoload.php';
    require_once  '../Utils/DbConnection.php';
    $config = require '../..//config.php';

    if (!isset(apache_request_headers()['Authorization'])) {
        //respond unauthorized
        http_response_code(401);
        exit();
    }
    $token = apache_request_headers()['Authorization'];
    $token = str_replace('Bearer ', '', $token);
    //echo $token;

    $key = $config['secret_key'];

    //  echo $token;
    //validate the token

    //print the request
    //print_r($_GET);
    $jwt = new JWT();

    try {

        $decode = $jwt->decode($token, new Key($key, 'HS256'));
        //check if the user is an admin
        if ($decode->role != 'admin') {
            http_response_code(401);
            exit();
        }
        //check if the token is expired
        if ($decode->exp < time()) {
            http_response_code(401);
            exit();
        }


    } catch (Exception $e) {
        http_response_code(401);
        exit();
    };


    //TODO validate the token
    //
    $username = $_GET['username'];
    $conn = DbConnection::getInstance()->getConnection();
 //select all the data of a user
    $sql = "SELECT user_id,username,fname,lname,email,secondary_email,function FROM users where username = ?";
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
    //get the inmate for each appointment
    $appointments = array();
    while ($row = $result->fetch_assoc()) {
       // $inmate_id = $row['inmate_id'];
        $inamte_first_name = $row['firstname'];
        $inmate_last_name = $row['lastname'];

        $stmt = $conn->prepare("SELECT fname,lname, sentence_start_date,sentence_duration ,sentence_category FROM inmates WHERE fname = ? AND lname = ? ");
        $stmt->bind_param("ss", $inamte_first_name, $inmate_last_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $inmate = $result->fetch_assoc();
        $appointments[] = array('appointment' => $row, 'inmate' => $inmate);
    }
    $encode = json_encode($appointments);
    //$encode = json_encode($result->fetch_assoc());
    $export_data['appointments'] = $encode;

   print_r($export_data) ;


}