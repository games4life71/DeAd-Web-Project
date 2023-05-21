<?php
$visit_nature = $_POST['visit_nature'];
$witness = $_POST['witnesses'];
session_start();
//$username = $_SESSION['username'];
$username = 'john.doe';
//if the use is not logged in, redirect to the login page
//if(!isset($_SESSION['is_logged_in'])){
//    header('Location: ../Login_Module/login.php');
//}
//print the post
//print_r($_POST);
$prisoner_health = 'good';
// !! cred ca asa e corect  !! $prisoner_health = $_POST['prisoner_health'];
$visit_date = $_POST['visit_date'];
$visit_time_start = $_POST['visit_time_start'];
$visit_time_end = $_POST['visit_time_end'];
$objectsFrom = $_POST['objectsFrom'];
$objectsTo = $_POST['objectsTo'];
$summary = $_POST['summary'];

$config = require '../../config.php';
require '../Utils/DbConnection.php';
$conn = DbConnection::getInstance()->getConnection();


//prepare sql statement
$stmt = $conn->prepare("INSERT INTO visits_summary
    (visitor_id,
     inmate_id,
     visit_date,
     visit_type,
     visit_nature,
     items_provided_to_convict,
     items_offered_by_convict,
     health_status,
     visit_start,
     visit_end,
     summary) 
 VALUES (?,?,?,?,?,?,?,?,?,?,?)");

//astea cred ca sunt hardcodate
$visitor_id = 1;
$inmate_id = 2;
try {
    $stmt->bind_param("iisssssssss",
        $visitor_id,
        $inmate_id,
        $visit_date,
        $visit_nature,
        $visit_nature,
        $objectsFrom,
        $objectsTo,
        $prisoner_health,
        $visit_time_start,
        $visit_time_end,
        $summary);
} catch (Exception $e) {
    echo $e->getMessage();
}
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


