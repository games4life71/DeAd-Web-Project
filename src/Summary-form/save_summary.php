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
print_r($_POST);
$prisoner_health = 'good';
$visit_date = $_POST['visit_date'];
$visit_time_start = $_POST['visit_time_start'];
$visit_time_end = $_POST['visit_time_end'];
$objectsFrom = $_POST['objectsFrom'];
$objectsTo = $_POST['objectsTo'];
$summary = $_POST['summary'];

$config = require '../../config.php';

$connection = mysqli_connect($config['hostname'], $config['username'], $config['password'], $config['database']);

if (!$connection) {
    echo "Connection error: " . mysqli_connect_error();
}

//prepare sql statement
$stmt = $connection->prepare("INSERT INTO visits_summary
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


$visitor_id = 1;
$inmate_id = 2;
try {
    $stmt->bind_param("iisssssssss",
        $visitor_id,
        $inmate_id,
        $visit_date,
        $visit_nature,
        $visit_nature,
        $objectsTo,
        $objectsTo,
        $prisoner_health,
        $visit_time_start,
        $visit_time_end,
        $summary);
} catch (Exception $e) {
    echo $e->getMessage();
}
$stmt->execute();
$stmt->close();
$connection->close();


