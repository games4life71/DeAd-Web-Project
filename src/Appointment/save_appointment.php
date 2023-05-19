<?php
session_start();
$username = $_SESSION['username'];
//if the use is not logged in, redirect to the login page
if(!isset($_SESSION['is_logged_in'])){
    header('Location: ../Login_Module/login.php');
}

$config = require '../../config.php';
$connection = mysqli_connect($config['hostname'], $config['username'], $config['password'], $config['database']);

$statemnt = $connection->prepare("SELECT user_id FROM users WHERE username = ?");
$statemnt->bind_param("s", $username);
$statemnt->execute();
$result = $statemnt->get_result();
$row = $result->fetch_assoc();
$person_id = $row['user_id'];
$statemnt->close();

//print the post
//print_r($_POST);
//person id din tabela users

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$relationship = $_POST['relationship'];
$visit_nature = $_POST['visit_nature'];
$source_of_income = $_POST['source_of_income'];
$profile_photo= $_POST['profile_photo'];
$date= $_POST['date'];
$estimated_time= $_POST['estimated_time'];


if (!$connection) {
    echo "Connection error: " . mysqli_connect_error();
}

//prepare sql statement
$stmt = $connection->prepare("INSERT INTO appointments
    (person_id,
     firstname,
    lastname,
    relationship,
    visit_nature,
     photo,
    source_of_income,
    date,
    estimated_time)
    VALUES (?,?,?,?,?,?,?,?,?)");

try{
    $stmt->bind_param("issssssss",
        $person_id,
        $firstname,
        $lastname,
        $relationship,
        $visit_nature,
        $profile_photo,
        $source_of_income,
        $date,
        $estimated_time);
}catch (Exception $e){
    echo $e->getMessage();
}
$stmt->execute();
$stmt->close();
$connection->close();
