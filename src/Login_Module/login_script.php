<?php
//get the username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

$config =  require '../../config.php';
require '../Utils/DbConnection.php';
$conn = DbConnection::getInstance()->getConnection();


if( $conn->connect_errno){
    die('Could not connect to db: ' . $conn->connect_error);
}

else{


    //retrieve the username and password from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    //verify hash password
    $row = mysqli_fetch_assoc($result); //get the row from the result


    if(password_verify($password, $row['password'])){
        echo 'You have successfully logged in !';
        //set the session variables

        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['is_logged_in'] = true;
        $_SESSION['email'] = $row['email'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        //get the user id from the database
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];

        header('Location: ../HomePage/homepage.php');
    }
    else{
        //redirect to the login page with an error message
        header("Location: login.php?error=1&username=$username");
    }


}
//