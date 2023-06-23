<?php

require '../../aws/aws/aws-autoloader.php';

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

require '../Utils/DbConnection.php';
$destination = $_POST['email'];

//verify the email address exists in the database
$conn = DbConnection::getInstance()->getConnection();


$stmt = $conn->prepare("SELECT username FROM users WHERE email = ?");
$stmt->bind_param("s", $destination);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: forgotpass.php?error=invalidemail");
    //TODO parse the errror in html
}
$username = $result->fetch_assoc()['username'];

$token = "";
//generate a random token
try {
    $token = bin2hex(random_bytes(50));
} catch (Exception $e) {
}


//insert the request in the database
$stmt2 = $conn->prepare("INSERT INTO reset_pwd_requests(username,email,token) VALUES (?, ?, ?)");
$stmt2->bind_param("sss", $username, $destination, $token);
$stmt2->execute();
$result2 = $stmt2->get_result();
//echo $result2->num_rows;


$stmt = $conn->prepare("SELECT * from reset_pwd_requests");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    echo $row['username'] . " " . $row['email'] . " " . $row['token'] . "<br>";
}


$SesClient = new SesClient(

    [
        'profile' => 'default',
        'region' => 'us-east-2',
        'version' => 'latest'
    ]

);


$sender = '7stefanadrian@gmail.com';

$subject = 'Reset your password';
$body = 'Click on the link below to reset your password: http://localhost:8080/Reset%20Password/reset_pwd.php';
//$htmlBody = '<h1>Reset your password</h1>
//<p>"Someone requested to reset the password ! This is the token to reset your password"' . $token . '>Reset_Password</a></p>';
$htmlBody=' <h1>Password Reset</h1>
    <h2>Detention Admin</h2>
    <p>Hello, ' . $username . '</p>
    <p>Please use the following token to reset your password:</p>
    <p><strong>' . $token . '</strong></p>
    <p>If you did not request a password reset, please ignore this email.</p>
    <p>Thank you!</p>';

$charSet = 'UTF-8';
try {
    $result = $SesClient->sendEmail([
        'Destination' => [
            'ToAddresses' => [
                $destination,
            ],
        ],
        'ReplyToAddresses' => [
            "noreply@localhost",
        ],
        'Source' => $sender,
        'Message' => [
            'Body' => [
                'Html' => [
                    'Charset' => $charSet,
                    'Data' => $htmlBody,
                ],
                'Text' => [
                    'Charset' => $charSet,
                    'Data' => $body,
                ],
            ],
            'Subject' => [
                'Charset' => $charSet,
                'Data' => $subject,
            ],
        ],
    ]);
    $messageId = $result['MessageId'];
    //echo("Email sent! Message ID: $messageId" . "\n");
    header("Location: forgotpass.php?success=1");
} catch (AwsException $e) {
    // output error message if fails
    echo $e->getMessage();
    //header("Location: forgotpass.php?error=1");
//    echo("The email was not sent. Error message: " . $e->getAwsErrorMessage() . "\n");
}
