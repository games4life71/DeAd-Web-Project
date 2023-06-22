<?php

//function to check if the password is strong

function checkpwd($password)
{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);

    if (!$uppercase || !$number || strlen($password) < 8 || !$lowercase) {
        return 0; //password is not strong
    } else if (!$number || strlen($password) < 8) {
        return 1; //password is a little strong
    } else if (!$number) {
        return 2; //password is a little stronger
    } else return 3;
}


//get the username,password and email from the form
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];

//check if the email contains some domains
$domains_for_admin = array('dead.com', 'mapn.com', 'mai.com', 'gov.com');
if (in_array(substr($email, strpos($email, '@') + 1), $domains_for_admin)) {
    $function = 'admin';
} else {
    $function = 'user';
}


$passwordStrength = checkpwd($password);

//check if the passwords match
if ($password != $password2) {

    header("Location: sign-up.php?error=2&username=$username&email=$email&fname=$fname&lname=$lname");
    exit();
} //
else if ($passwordStrength < 3) {
    header("Location: sign-up.php?strength=$passwordStrength&username=$username&email=$email&fname=$fname&lname=$lname");
    exit();
}


require '../Utils/DbConnection.php';
$conn = DbConnection::getInstance()->getConnection();


if ($conn->connect_errno) {
    die('Could not connect to db: ' . $conn->connect_error);
} else {
    //sanitize the username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? or email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    //check if the username already exists in the database

    if (mysqli_num_rows($result) > 0) {
        //set the error and redirect to the register page with the credentials
        header("Location: sign-up.php?error=1&username=$username&email=$email&fname=$fname&lname=$lname");
        exit();
    }


    //$user_id = $result->fetch_assoc()['user_id'];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, fname, lname,function) VALUES (?, ?, ?, ?, ?,?)");
        $stmt->bind_param("ssssss", $username, $passwordHash, $email, $fname, $lname, $function);
        $result = $stmt->execute();

    }
    catch (Exception $e){
        echo $e->getMessage();
    }
    //insert the username and password from the database


    if ($result) {

        //add a delay of 3 seconds
//

        //set the session variables
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['is_logged_in'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['function'] = $function;
        $_SESSION['is_logged_in'] = true;
        //$_SESSION['id'] = $user_id;

        header('Location: ../HomePage/homepage.php');
    } else {

        //redirect to the register page
        echo "error";
//        header('Location: sign-up.php');
    }
}