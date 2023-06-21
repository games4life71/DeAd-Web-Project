<?php

use Firebase\JWT\Key;
use Firebase\JWT\JWT;

//this api endpoint is used to retrieve the data of a specific inmate

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once '../../vendor/autoload.php';
    require_once '../Utils/DbConnection.php';
    $config = require '../../config.php';


    session_start();
    $token = $_SESSION['token'];
    $key = $config['secret_key'];

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

    $username = $_GET['username'];
    //print_r($username);

    $conn = DbConnection::getInstance()->getConnection();

    //select all the data of a user
    $sql = "SELECT user_id,username,fname,lname,email,secondary_email,function FROM users where username = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $username);
    $export_data = array();

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $export_data = array();
    $export_data['user_id'] = $row['user_id'];
    $export_data['username'] = $row['username'];
    $export_data['fname'] = $row['fname'];
    $export_data['lname'] = $row['lname'];
    $export_data['email'] = $row['email'];
    $export_data['secondary_email'] = $row['secondary_email'];
    $export_data['function'] = $row['function'];

    $user_id = $row['user_id'];

    $stmt = $conn->prepare("SELECT firstname ,lastname,relationship,visit_nature,source_of_income,visit_start,visit_end FROM appointments WHERE person_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $appointments = array();
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
    //print_r($appointments);



}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HTML Export</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        :root {
            --darkblue: #32435f;
            --lightblue: #85abef;
            --offpink: #a67f78;
            --capuccino: #8f8681;
            --offwhite: #e1dcd9;
            --lightcapuccino: #cccbc9;
            --brown: #5c4b4b;
        }

        body {
            background-color: var(--offwhite);
            font-family: 'Roboto', sans-serif;
        }


        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid var(--brown);
        }

        h1 {
            text-align: center;
            color: var(--darkblue);
            font-size: xx-large;

        }

        td {
            background-color: var(--offwhite);
            border: 1px solid var(--brown);
        }

        th,
        td {
            font-weight: bold;
            border: 1px solid var(--brown);
            padding: 10px;
            text-align: center;
            color: var(--darkblue);
        }

        td {
            font-weight: lighter;
        }
    </style>
</head>

<body>
<section>
    <h1>Detention Admin</h1>
    <!-- TABLE CONSTRUCTION -->
    <table>
        <tr>
            <th>User Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Secondary Email</th>
            <th>Function</th>
        </tr>
        <tr>
            <td><?php echo $export_data['user_id']; ?></td>
            <td><?php echo $export_data['username']; ?></td>
            <td><?php echo $export_data['fname']; ?></td>
            <td><?php echo $export_data['lname']; ?></td>
            <td><?php echo $export_data['email']; ?></td>
            <td><?php echo $export_data['secondary_email']; ?></td>
            <td><?php echo $export_data['function']; ?></td>
        </tr>

    </table>
    <br>
    <table>
        <tr>
            <th>Prisoner first name</th>
            <th>Prisoner last name</th>
            <th>Relationship</th>
            <th>Nature of the visit</th>
            <th>Income source</th>
            <th>Visit start</th>
            <th>Visit end</th>
            <th>Prisoner sentence start date</th>
            <th>Prisoner sentence duration</th>
            <th>Prisoner sentence category</th>
        </tr>

            <?php
            $i = 0;
            $n = count($appointments);
                while( $i < $n){
                    ?>
        <tr>
                    <td><?php echo $appointments[$i]['firstname']; ?></td>
                    <td><?php echo $appointments[$i]['lastname']; ?></td>
                    <td><?php echo $appointments[$i]['relationship']; ?></td>
                    <td><?php echo $appointments[$i]['visit_nature']; ?></td>
                    <td><?php echo $appointments[$i]['source_of_income']; ?></td>
                    <td><?php echo $appointments[$i]['visit_start']; ?></td>
                    <td><?php echo $appointments[$i]['visit_end']; ?></td>
            <?php
            $stmt = $conn->prepare("SELECT sentence_start_date, sentence_duration, sentence_category FROM inmates WHERE fname = ? AND lname = ?");
            $stmt->bind_param("ss", $appointments[$i]['firstname'], $appointments[$i]['lastname']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            ?>
                    <td><?php echo $row['sentence_start_date']; ?></td>
                    <td><?php echo $row['sentence_duration']; ?></td>
                    <td><?php echo $row['sentence_category']; ?></td>
        </tr>
                    <?php
                    $i = $i + 1;
                }
            ?>

    </table>
</section>
</body>

</html>
