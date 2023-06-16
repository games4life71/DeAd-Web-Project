<?php


$token = $_POST['code'];


require '../Utils/DbConnection.php';
$config = require '../../config.php';


$conn = DbConnection::getInstance()->getConnection();

$stmt  = $conn->prepare("SELECT * FROM reset_pwd_requests WHERE token = ?");

$stmt->bind_param("s", $token);
$stmt->execute();


$result = $stmt->get_result();
if($result ->num_rows == 0){
    header("Location: code_verification.html?error=invalidtoken");
    exit();
}

//get the username and email from the reset_pwd_requests table
$username = $result->fetch_assoc()['username'];
$email = $result->fetch_assoc()['email'];
//refirect to the reset password page


//delete the entry from the database
$stmt = $conn->prepare("DELETE FROM reset_pwd_requests WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();



header("Location: ../Reset_Password/reset_password_email.php?username=$username&email=$email");
