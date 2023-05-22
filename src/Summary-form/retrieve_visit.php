<?php


//retrive the visit from appointment table and send it back

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require '../Utils/DbConnection.php';
    $conn = DbConnection::getInstance()->getConnection();

    session_start();
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
