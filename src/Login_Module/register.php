<?php

//check if the user is already logged in


//get the username,password and email from the form
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];

//check if the passwords match
if ($password != $password2) {
    echo 'Passwords do not match';
    header("Location: sign-up.php?error=2&username=$username&email=$email&fname=$fname&lname=$lname");
    exit();
}

$conn = new mysqli('127.0.0.1:9999', 'root', 'root', 'mybd');

if ($conn->connect_errno) {
    die('Could not connect to db: ' . $conn->connect_error);
} else {
    //sanitize the username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    //check if the username already exists in the database

    if (mysqli_num_rows($result) > 0) {
        //set the error and redirect to the register page with the credentials
        header("Location: sign-up.php?error=1&username=$username&email=$email&fname=$fname&lname=$lname");
        exit();
    }


    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //insert the username and password from the database
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, fname, lname) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $passwordHash, $email, $fname, $lname);
    $result = $stmt->execute();


    if ($result) {
        echo 'You have successfully registered !';
        //add a delay of 3 seconds
        sleep(3);

        //set the session variables
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['is_logged_in'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        header('Location: ../HomePage/homepage.php');
    } else {
        echo 'Something went wrong';
        //redirect to the register page
        header('Location: sign-up.php');
    }
}