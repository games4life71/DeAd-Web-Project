<?php

//get the username,password and email from the form
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];


$conn  = new mysqli('127.0.0.1:9999', 'root', 'root', 'mybd');

if($conn->connect_errno){
    die('Could not connect to db: ' . $conn->connect_error);
}

else{
//check if the username already exists in the database


    //insert the username and password from the database
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    $result = mysqli_query($conn, $sql);
    echo'You have successfully registered !';
}
