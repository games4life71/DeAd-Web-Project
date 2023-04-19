<?php
//get the username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];


//connect to the database
$conn  = new mysqli('127.0.0.1:9999', 'root', 'root', 'mybd');

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

        header('Location: ../HomePage/homepage.php');
    }
    else{
        echo 'Wrong username or password';
    }


}
//
