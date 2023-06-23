<?php

use Firebase\JWT\JWT;


require_once '../../vendor/autoload.php';

use Firebase\JWT\Key;

require '../Utils/DbConnection.php';
$config = require '../..//config.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once '../../vendor/autoload.php';



    $config = require '../..//config.php';
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


        //  print_r($decode);

        //  print_r($decode);


        //print_r(apache_request_headers());
        $conn = DbConnection::getInstance()->getConnection();

        session_start();
        header('Content-Type: plain/text');

        $username = $_GET['username'];
        $username = $username . "%";



        $stmt = $conn->prepare("SELECT * FROM users WHERE username like ? and `function` = 'user'");

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo '<p style="color:red; font-size: 30px;" >No results found ! </p>';

        } else {
            echo '<select name="search-results" onchange="location = this.value;">';
            echo '<option value="" disabled selected>Choose an user</option>';
            while ($row = $result->fetch_assoc()) {
                $link = "../Admin_Visit/adminvisit.php?username=" . $row['username'];

                echo '<option value='.$link.'> ' . $row['username'] . ' </option>';

            }
        }



    } else {
        //respond method not accepted
        http_response_code(405);
    }
}
?>



