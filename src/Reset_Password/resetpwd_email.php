<?php
$config =  require '../../config.php';
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
print_r($_POST);

$newpwd = $_POST['newPass'];
$confirmpwd = $_POST['confirmNewPass'];

session_start();
$user = $_SESSION['username_to_reset'];

//search for the user in the database

$conn = DbConnection::getInstance()->getConnection();


$passwordStrength = checkpwd($newpwd);

if($passwordStrength <3)
{
    header("Location:resetpwd_email.php?error=2");
    exit();
}

if($newpwd != $confirmpwd)
{
   header("Location:resetpwd_email.php?error=5");
}

else
{
    $hashed_password = password_hash($newpwd, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $hashed_password, $user);
    $stmt->execute();
    $stmt->close();
    echo "Pass change succeesfullt";
    //header("Location:  ../Login_Module/login.php");
}
exit();




