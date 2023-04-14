<?php
//get the username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

echo $username;
//connect to the database
$conn  = new mysqli('127.0.0.1:9999', 'root', 'root', 'mybd');

if( $conn->connect_errno){
    die('Could not connect to db: ' . $conn->connect_error);
}

else{

    //retrieve the username and password from the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

}
//
