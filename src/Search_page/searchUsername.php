<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require '../Utils/DbConnection.php';
$config = require '../../config.php';
require_once('../../vendor/autoload.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    //verify the key sent in authorization header
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


    //  $decoded = JWT::decode($token,  new Key($key, 'HS256'),null);
    //cho $decoded->username;

    //print the request
    //print_r($_GET);
    $jwt = new JWT();

    try {

        $decode = $jwt->decode($token, new Key($key, 'HS256'));
    } catch (Exception $e) {
        http_response_code(401);
        exit();
    };

  //  print_r($decode);

    //print_r(apache_request_headers());
    $conn = DbConnection::getInstance()->getConnection();

    session_start();
    header('Content-Type: plain/text');

    $username = $_GET['username'];
    $username = $username . "%";
    $stmt = $conn->prepare("SELECT * FROM users WHERE username like ?");

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        echo "No results found !";
        exit();
    }

    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        echo $row['username'];
        echo "\n";
    }


} else {
    //respond method not accepted
    http_response_code(405);
}
exit();
?>