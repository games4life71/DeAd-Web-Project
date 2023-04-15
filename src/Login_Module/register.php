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
    //sanitize the username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    //check if the username already exists in the database

    if(mysqli_num_rows($result) > 0){
        echo 'Username or email already exists';
        exit();
    }


    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //insert the username and password from the database
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', '$email')";
    $result = mysqli_query($conn, $sql);
    echo'You have successfully registered !';
}
