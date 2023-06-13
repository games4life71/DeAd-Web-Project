<?php
require '../Utils/DbConnection.php';
if($_SERVER['REQUEST_METHOD'] == 'GET') {


    $conn = DbConnection::getInstance()->getConnection();

    session_start();
    header('Content-Type: plain/text');

    $username = $_GET['username'];
    $username =  $username."%";
    $stmt = $conn->prepare("SELECT * FROM users WHERE username like ?");

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows == 0)
    {
        echo "No results found !";
        exit();
    }

    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        echo $row['username'];
        echo "\n";
    }

    exit();


}
else
{
    //respond method not accepted
    http_response_code(405);
    exit();
}
?>