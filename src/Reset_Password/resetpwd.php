<?php
session_start();
require '../Utils/DbConnection.php';
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


$currentpwd = $_POST['currentPass'];
$newpwd = $_POST['newPass'];
$confirmpwd = $_POST['confirmNewPass'];


$user = $_SESSION['username'];
echo $user;

//search for the user in the database
$config =  require '../../config.php';

$conn = DbConnection::getInstance()->getConnection();


$passwordStrength = checkpwd($newpwd);

if($passwordStrength <3)
{
    header("Location: resetpass.php?error=4&strength=$passwordStrength");
    exit();
}


if ($conn->connect_errno) {
    die('Could not connect to db: ' . $conn->connect_error);
} else {


    //retrieve the username and password from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);

    $stmt->execute();
    $result = $stmt->get_result();


    $row = mysqli_fetch_assoc($result); //get the row from the result


    if (password_verify($currentpwd, $row['password'])) {
        //check if the new password and confirm password are the same

        if ($newpwd == $confirmpwd) {
            if ($newpwd == $currentpwd) {
                //redirect to the reset password page with an error message
                header("Location: resetpass.php?error=3"); //error code 3 means the new password and current password are the same
                exit();
            }
            //update the password in the database
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
            //hash the password
            $newpwd = password_hash($newpwd, PASSWORD_DEFAULT);

            $stmt->bind_param("ss", $newpwd, $user);

            $stmt->execute();
            $result = $stmt->get_result();
            //redirect to the login page
            header("Location: ../HomePage/homepage.php");
            exit();
        } else {
            //redirect to the reset password page with an error message
            header("Location: resetpass.php?error=1"); //error code 1 means the new password and confirm password are not the same
            exit();
        }
    } else {
        //redirect to the reset password page with an error message
        header("Location: resetpass.php?error=2"); //error code 2 means the current password is incorrect
        exit();
    }


}




