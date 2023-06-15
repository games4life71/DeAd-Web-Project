<?php


function compress($image)
{
    $info = getimagesize($image);
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($image);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($image);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($image);
    imagejpeg($image, $image, 50);

    return $image;
}


session_start();
$username = $_SESSION['username'];
//if the use is not logged in, redirect to the login page
if (!isset($_SESSION['is_logged_in'])) {
    header('Location: ../Login_Module/login.php');
}

$config = require '../../config.php';
require '../Utils/DbConnection.php';
$conn = DbConnection::getInstance()->getConnection();

$statemnt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
$statemnt->bind_param("s", $username);
$statemnt->execute();
$result = $statemnt->get_result();
$row = $result->fetch_assoc();
$person_id = $row['user_id'];
$statemnt->close();

//print the post
//print_r($_POST);
//person id din tabela users

$firstname = $_POST['firstname']; //first name of the inmate
$lastname = $_POST['lastname'];  //last name of the inmate
$relationship = $_POST['relationship'];
$visit_nature = $_POST['visit_nature'];
$source_of_income = $_POST['source_of_income'];
$date = $_POST['date'];
$visit_start = $_POST['visit_time_start'];
$visit_end = $_POST['visit_time_end'];


if (!empty($_FILES['profile_photo']['name'])) {
    $profile_photo = $_FILES['profile_photo']['tmp_name'];
    // compress($profile_photo); //compress the image first
    $photo_contents = file_get_contents($profile_photo);
    $photo_contents = addslashes($photo_contents);
} else {
    $profile_photo = null;
}


$valid_extensions = array('jpeg', 'jpg', 'png');

//get the extension of the uploaded file
$ext = strtolower(pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION));

//check if the extension is valid
if (!in_array($ext, $valid_extensions)) {
    header('Location: appointment.php?error=2'); //invalid extension
    exit();
}


if (!$conn) {
    echo "Connection error: " . mysqli_connect_error();
}

//check if the inmate exists in the database
$stmt = $conn->prepare("SELECT * FROM inmates WHERE fname = ? AND lname = ?");
$stmt->bind_param("ss", $firstname, $lastname);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if ($row == null) {
    header('Location: appointment.php?error=1'); //inmate does not exist
    exit();
}

//check if the inmate has a visit in the same time interval
$stmt3 = $conn->prepare("SELECT * FROM appointments WHERE date = ? AND visit_start<= ? and visit_end >= ?");
$stmt3->bind_param("sss", $date, $visit_start, $visit_end);
$stmt3->execute();
$result = $stmt3->get_result();
$stmt3->close();
//check if the inmate has a visit in the same time interval
if ($result->num_rows > 0) {
    echo "The inmate has a visit in the same time interval";
    header('Location: ../Summary-form/summary.php?error=1'); //the inmate has a visit in the same time interval
    exit();
}


//prepare sql statement
$stmt = $conn->prepare("INSERT INTO appointments
    (person_id,
     firstname,
    lastname,
    relationship,
    visit_nature,
     photo,
    source_of_income,
    date,
    visit_start,
     visit_end)
    VALUES (?,?,?,?,?,?,?,?,?,?)");


try {
    $stmt->bind_param("isssssssss",
        $person_id,
        $firstname,
        $lastname,
        $relationship,
        $visit_nature,
        $profile_photo,
        $source_of_income,
        $date,
        $visit_start,
        $visit_end);
    $stmt->execute();
} catch (Exception $e) {
    echo $e->getMessage();
}
//insert the appointment into the visits_summary table
$stmt = $conn->prepare("INSERT INTO visits_summary (
                            visitor_id,
                            inmate_id,
                            visit_date,
                            visit_nature,
                            visit_hours,
                            appointment_refID) 
VALUES (?,?,?,?,?,?)");

//get the appointment id
$stmt2 = $conn->prepare("SELECT appointment_id FROM appointments WHERE person_id = ? AND date = ?");
$stmt2->bind_param("is", $person_id, $date);
$stmt2->execute();
$result = $stmt2->get_result();
$row_appoint = $result->fetch_assoc();
//print_r($row);
$stmt2->close();


$visit_hours = intval($visit_end) - intval($visit_start);

$stmt->bind_param("iisssi",
    $person_id,
    $row['inmate_id'],
    $date,
    $visit_nature,
    $visit_hours,
    $row_appoint['appointment_id']);
$stmt->execute();
$result = $stmt->get_result();
print("Result: ");
print($result);
echo $stmt->error;
$stmt->close();

header('Location: ../HomePage/homepage.php');
