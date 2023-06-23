<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require '../Utils/DbConnection.php';

$config = require '../../config.php';


function exportJSON($export_data, $statistic_data)
{

    $export_data = json_encode($export_data);
    $filename = "export_".date("Y-m-d").".json";
    header("Content-type: application/json");
    header("Content-Disposition: attachment; filename=$filename");
    $output = fopen("php://output", "w");
    fwrite($output, $export_data);
    fwrite($output, "\n");
    fwrite($output, json_encode($statistic_data));
    fclose($output);
}

function exportCSV($export_data, $statistic_data)
{
    $filename = "export_".date("Y-m-d").".csv";
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=$filename");
    $output = fopen("php://output", "w");
    foreach ($export_data as $row) {
        fputcsv($output, $row);
    }
    fputcsv($output, array("Total :"));
    fputcsv($output, $statistic_data);

    fclose($output);
}

function exportHTML(array $export_data , array $statistic_data)
{
    $filename = "export_".date("Y-m-d").".html";
    header("Content-type: text/html");
    header("Content-Disposition: attachment; filename=$filename");
    $output = fopen("php://output", "w");
    fwrite($output, "<html><body><table>");
    foreach ($export_data as $row) {
        fwrite($output, "<tr>");
        foreach ($row as $key => $value) {
            fwrite($output, "<td>$value</td>");
        }
        fwrite($output, "</tr>");
    }
    fwrite($output, "<tr><td>Total</td><td>" . $statistic_data['total'] . "</td></tr>");
    fwrite($output, "</table></body></html>");
    fclose($output);
}

$conn = DbConnection::getInstance()->getConnection();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once '../../vendor/autoload.php';
    session_start(); //start the session


    $username = $_SESSION['username'];
    $user_id = $_SESSION['id'];
    $persons = $_POST['export'];

    $token = $_SESSION['token'];
    //check if the token is valid
    $key = $config['secret_key'];

    //$jwt = new JWT();

    try {

        $jwt = new JWT();
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


    $export_data = array();
    $statistic = array();


    switch ($_POST['export']) {
        case 'users':
            //export all the users
            $result = $conn->query("SELECT username,fname,lname,email,secondary_email,function FROM users");
            while ($row = $result->fetch_assoc()) {
                $export_data[] = $row;
            }

            //make a short statistics
            $result = $conn->query("SELECT COUNT(*) as total FROM users");
            $row = $result->fetch_assoc();
            $statistic['total'] = $row['total'];

            if ($_POST['sorted'] == 'alphabetically') {
                usort($export_data, function ($a, $b) {
                    return $a['username'] <=> $b['username'];
                });
            }
            break;

        case 'inmates':
            //export all the inmates
            $result = $conn->query("SELECT * FROM inmates");
            while ($row = $result->fetch_assoc()) {
                $export_data[] = $row;
            }
            if ($_POST['sorted'] == 'alphabetically') {
                usort($export_data, function ($a, $b) {
                    return $a['fname'] <=> $b['fname'];
                });
            }

            //make a short statistics
            $result = $conn->query("SELECT COUNT(*)  as total FROM inmates");
            $row = $result->fetch_assoc();
            $statistic['total'] = $row['total'];

            break;

        case 'all':
            $result = $conn->query("SELECT * FROM appointments");
            while ($row = $result->fetch_assoc()) {
                $export_data[] = $row;
            }
            if ($_POST['sorted'] == 'alphabetically') {
                usort($export_data, function ($a, $b) {
                    return $a['firstname'] <=> $b['firstname'];
                });
                usort($export_data, function ($a, $b) {
                    return $a['lastname'] <=> $b['lastname'];
                });

            }
            //make a short statistics
            $result = $conn->query("SELECT COUNT(*)  as total FROM appointments");
            $row = $result->fetch_assoc();
            $statistic['total'] = $row['total'];


            break;

        default:
            http_response_code(400);
            exit();

    }


    switch ($_POST['format']) {
        case 'json':
            exportJSON($export_data, $statistic);
            break;
        case 'csv':
            exportCSV($export_data , $statistic);
            break;

        case 'html':
            exportHTML($export_data,$statistic); //TODO implement this
            break;
        default:
            http_response_code(400);
            exit();
    }

    //print_r($_POST);
    //exit();

} else {
    http_response_code(401);
    exit();
}
