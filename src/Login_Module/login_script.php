<?php
//get the username and password from the form

use Firebase\JWT\JWT;
require_once  '../../vendor/autoload.php';


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
    //check if the username has admin function

    if(password_verify($password, $row['password'])){
        //echo 'You have successfully logged in !';
        //set the session variables

        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['is_logged_in'] = true;
        $_SESSION['email'] = $row['email'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['function'] = $row['function'];
        $_SESSION['id'] = $row['user_id'];

        $_SESSION['function'] = $row['function'];
        if($row['secondary_email']!=null)
        $_SESSION['secondary_email'] = $row['secondary_email'];


        //create a new auth token
        $key = $config['secret_key'];
        $issuedAt = new DateTimeImmutable();
        $role = "user";
        if($row['function'] == 'admin')
        {
            $role = "admin";
        }

        $expire = $issuedAt->modify('+6 hours')->getTimestamp();
        $serverName = $config['hostname'];
        $username = $_SESSION['username'];
        $data  = [
            'iat' => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
            'iss' => $serverName,                       // Issuer
            'nbf' => $issuedAt->getTimestamp(),         // Not before
            'exp' => $expire,                           // Expire
            'userName' => $username,                    // User name
            'role' => $role                             // User role
        ];
        $token  =  JWT::encode(
            $data,
            $key,
            'HS256'

        );

        //set the token in the session
        $_SESSION['token'] = $token;
        //echo $token;

        header("Location:../HomePage/homepage.php");






    }

    else{
        //redirect to the login page with an error message
        header("Location: login.php?error=1&username=$username");
    }


}
//