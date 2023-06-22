<?php

require_once '../../vendor/autoload.php';

session_start();
$username = $_SESSION['username'];

if (!isset($_SESSION['is_logged_in'])) {
    header('Location: ../Login_Module/login.php');
}

// Verificăm dacă utilizatorul este admin
if (!isset($_SESSION['token'])) {
    header('Location: ../Login_Module/login.php');
}

$config = require '../../config.php';
require '../Utils/DbConnection.php';

$token = $_SESSION['token'];
$key = $config['secret_key'];

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$jwt = new JWT();

try {
    $decode = $jwt->decode($token, new Key($key, 'HS256'));

    // Verificăm dacă utilizatorul este admin
    if ($decode->role !== 'admin') {
        http_response_code(401);
        exit();
    }
} catch (Exception $e) {
    http_response_code(401);
    exit();
}

$conn = DbConnection::getInstance()->getConnection();

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$sentencedate = $_POST['sentencedate'];
$sentenceduration = $_POST['sentenceduration'];
$sentencecategory = $_POST['sentencecategory'];

if (!$conn) {
    echo "Connection error: " . mysqli_connect_error();
}

$stmt = $conn->prepare("INSERT INTO inmates (fname, lname, sentence_start_date, sentence_duration, sentence_category) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $firstname, $lastname, $sentencedate, $sentenceduration, $sentencecategory);
$stmt->execute();
$stmt->close();

header('Location: ../HomePage/homepage.php');
header('Location: ../Add_Inmate/addinmate.php?success=1');
?>
