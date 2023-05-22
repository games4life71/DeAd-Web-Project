<?php


//for the current user make a query to get all the appointments and send them to the frontend
if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    require '../Utils/DbConnection.php';
    $conn = DbConnection::getInstance()->getConnection();

    session_start();
    //get the user id from params
    $user_id = $_GET['id'];

    $user_id = strval($user_id);
    $stmt = $conn->prepare("SELECT a.appointment_id,a.firstname,a.lastname,a.date,u.fname,u.lname FROM appointments a JOIN users u  WHERE u.user_id = ?");

    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

//dont display the warning
    error_reporting(E_ERROR | E_PARSE);

//get all the lines
    $respone = array();
    while ($row = mysqli_fetch_assoc($result)) {

        $line = array(
            "inmate_name" => $row['firstname'] . " " . $row['lastname'],

            "date" => $row['date'],
            "visitor_name" => $row['fname'] . " " . $row['lname'],
            "appointment_id" => $row['appointment_id']
        );

        $respone[] = $line;

    }
//go back to user visit page
    header('Content-Type: application/json');
    echo json_encode($respone);
    exit();

}




