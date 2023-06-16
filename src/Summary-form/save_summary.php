<?php
session_start();

$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
$witnesses = $_POST['witnesses'];
//$prisoner_health = 'good';
$prisoner_health = $_POST['prisoner_health'];
$visit_nature = $_POST['visit_nature'];
$visit_date = $_POST['visit_date'];
$visit_hours = $_POST['visit_hours'];
$objectsFrom = $_POST['objectsFrom'];
$objectsTo = $_POST['objectsTo'];
$summary = $_POST['summary'];
$appointment_id = $_POST['appointment_id'];

$config = require '../../config.php';
require '../Utils/DbConnection.php';
$conn = DbConnection::getInstance()->getConnection();



print_r($_POST);

$stmt= $conn->prepare("UPDATE visits_summary SET
    visit_date = ?,
    witnesses = ?,
    visit_nature = ?,
    items_provided_to_convict = ?,
    items_offered_by_convict = ?,
    health_status = ?,
    visit_hours = ?,
    summary = ?
    WHERE visitor_id = ? and appointment_refID = ?");


$stmt->bind_param("ssssssssii",
    $visit_date,
    $witnesses,
    $visit_nature,
    $objectsTo,
    $objectsFrom,
    $prisoner_health,
    $visit_hours,
    $summary,
    $user_id,
    $appointment_id);

$stmt->execute();
$result = $stmt->get_result();
$error_code = $stmt->errno;
echo $error_code;
if ($error_code != 0) {
    echo $stmt->error;


} else {
    //make the submit button disabled

    header('Location: ../HomePage/homepage.php');
    //print_r($result);

}

$stmt->close();

//redirect to the summary page if everything is ok


