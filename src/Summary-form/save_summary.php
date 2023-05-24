<?php
//$witness = $_POST['witnesses'];
$witness  = "nimeni";
session_start();

$username = $_SESSION['username'];
$user_id = $_SESSION['id'];

$prisoner_health = 'good';
$prisoner_health = $_POST['prisoner_health'];

$visit_nature = $_POST['visit_nature'];
$visit_date = $_POST['visit_date'];
$visit_time_start = $_POST['visit_time_start'];
$visit_time_end = $_POST['visit_time_end'];
$objectsFrom = $_POST['objectsFrom'];
$objectsTo = $_POST['objectsTo'];
$summary = $_POST['summary'];
$appointment_id = $_POST['appointment_id'];

// $appointment_id;

$config = require '../../config.php';
require '../Utils/DbConnection.php';
$conn = DbConnection::getInstance()->getConnection();

//get the id of the inmate
$stmt = $conn->prepare("SELECT inmate_id FROM visits_summary WHERE appointment_refID = ?");
$appointment_id= (int)$appointment_id;
$stmt->bind_param("i", $appointment_id);
$stmt->execute();
$result = $stmt->get_result();
$inmate_id = $result->fetch_assoc()['inmate_id'];
//echo $inmate_id;

//check if the inmate has a visit in the same time interval
//prepare sql statement that checks if the inmate has a visit in the same time interval
$stmt = $conn->prepare("SELECT * FROM visits_summary WHERE inmate_id = ? and visit_date = ? and visit_start<= ? and visit_end >= ?");

//bind parameters
$stmt->bind_param("isss",
    $inmate_id,
    $visit_date,
    $visit_time_start,
    $visit_time_end);
$stmt ->execute();
$result = $stmt->get_result();
//check if the inmate has a visit in the same time interval
print_r($result);
if ($result->num_rows > 0) {
    echo "The inmate has a visit in the same time interval";
    header('Location: ../Summary-form/summary.php?error=1'); //the inmate has a visit in the same time interval
    exit();
}





//prepare sql statement that updates the visit summary table
$stmt= $conn->prepare("UPDATE visits_summary SET
    visit_nature = ?,
    health_status = ?,
    visit_date = ?,
    visit_start = ?,
    visit_end = ?,
    items_offered_by_convict = ?,
    items_provided_to_convict = ?,
    summary = ?
    WHERE visitor_id = ? and appointment_refID = ?");

//print the type og user id and appointment id

//pritn the type of user id and appointment id
//echo gettype($user_id);
//convert appointment id to int
$appointment_id = (int)$appointment_id;
//echo gettype($appointment_id);
//echo $appointment_id;

$stmt->bind_param("ssssssssii",
    $visit_nature,
    $prisoner_health,
    $visit_date,
    $visit_time_start,
    $visit_time_end,
    $objectsFrom,
    $objectsTo,
    $summary,
    $user_id,
    $appointment_id);


//$stmt = $conn->prepare("INSERT INTO visits_summary
//    (visitor_id,
//     inmate_id,
//     visit_date,
//     visit_type,
//     visit_nature,
//     items_provided_to_convict,
//     items_offered_by_convict,
//     health_status,
//     visit_start,
//     visit_end,
//     summary)
// VALUES (?,?,?,?,?,?,?,?,?,?,?)");

//astea cred ca sunt hardcodate
//$visitor_id = 1;
//$inmate_id = 2;
//try {
//    $stmt->bind_param("iisssssssss",
//        $visitor_id,
//        $inmate_id,
//        $visit_date,
//        $visit_nature,
//        $visit_nature,
//        $objectsFrom,
//        $objectsTo,
//        $prisoner_health,
//        $visit_time_start,
//        $visit_time_end,
//        $summary);
//} catch (Exception $e) {
//    echo $e->getMessage();
//}
$stmt->execute();
$error_code = $stmt->errno;
echo $error_code;
if ($error_code != 0) {
    echo $stmt->error;


} else {
    header('Location: ../HomePage/homepage.php');

}

$stmt->close();



//redirect to the summary page if everything is ok


