<?php

require '../../aws/aws/aws-autoloader.php';
use Aws\Ses\SesClient;
use Aws\Exception\AwsException;
$destination = $_POST['email'];

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
$htmlBody = '<h1>Reset your password</h1>
<p>Click on the link below to reset your password: <a href="http://localhost:8080/Reset%20Password/reset_pwd.php">Reset Password</a></p>';

$charSet = 'UTF-8';
try {
    $result = $SesClient->sendEmail([
        'Destination' => [
            'ToAddresses' => [
                $destination,
            ],
        ],
        'ReplyToAddresses' => [
            $sender,
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
    echo("Email sent! Message ID: $messageId"."\n");
} catch (AwsException $e) {
    // output error message if fails
    echo $e->getMessage();
    echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
}
