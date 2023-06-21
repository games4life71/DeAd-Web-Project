<?php
use Firebase\JWT\Key;
use Firebase\JWT\JWT;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once '../../vendor/autoload.php';
    require_once '../Utils/DbConnection.php';
    $config = require '../..//config.php';

//    if (!isset(apache_request_headers()['Authorization'])) {
//        //respond unauthorized
//        http_response_code(401);
//        exit();
//    }
//    $token = apache_request_headers()['Authorization'];
//    $token = str_replace('Bearer ', '', $token);
//    //echo $token;
    session_start();
    $token = $_SESSION['token'];

    $key = $config['secret_key'];

    //  echo $token;
    //validate the token

    //print the request
    //print_r($_GET);
    $jwt = new JWT();

    try {

        $decode = $jwt->decode($token, new Key($key, 'HS256'));
        //check if the user is an admin
        if ($decode->role != 'admin') {
            http_response_code(401);
            exit();
        }
        //check if the token is expired
        if ($decode->exp < time()) {
            http_response_code(401);
            exit();
        }


    } catch (Exception $e) {
        http_response_code(401);
        exit();
    };


    $username = $_GET['username'];
    $conn = DbConnection::getInstance()->getConnection();
    //select all the data of a user
    $sql = "SELECT user_id,username,fname,lname,email,secondary_email,function FROM users where username = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $username);
    $export_data  = array();

    $stmt->execute();
 $result = $stmt->get_result();
    $user_id = null;
//    $row = $result->fetch_assoc();

    $separator = ",";
    $filename = "export_data_".$username.'_'.date('Y-m-d') . ".csv";
    header("Content-type: text/csv");
    header('Content-Disposition: attachment; filename="'.$filename);

    $output = fopen("php://output", "w");
    $fields = array('User Id ', 'Username', 'First Name ', 'Last Name ', 'Email', 'Secondary Email ', 'Funtion/Role');
    fputcsv($output, $fields, $separator);

    while ($row = $result->fetch_assoc()) {
        $user_id = $row['user_id'];
        fputcsv($output, $row, $separator);
    }


    //add some empty lines
    fputcsv($output, array(''), $separator);
    fputcsv($output, array(''), $separator);
    $user_id=intval($user_id);
    $stmt = $conn->prepare("SELECT firstname ,lastname,relationship,visit_nature,source_of_income,visit_start,visit_end FROM appointments WHERE person_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    //get the inmate for each appointment

    $fields = array('Prisoner first name ','Prisoner last name','Relationship','Nature of the visit ','Income source ','Visit Start','Visit End','Prisoner sentence start date','Prisoner sentence duration','Prisoner sentence category');
    fputcsv($output, $fields, $separator);
    $appointments = array();
    while ($row = $result->fetch_assoc()) {

        //fputcsv($output, $row, $separator);


        $inmate_first_name = $row['firstname'];
        $inmate_last_name = $row['lastname'];

        $stmt = $conn->prepare("SELECT  sentence_start_date,sentence_duration ,sentence_category FROM inmates WHERE fname = ? AND lname = ? ");
        $stmt->bind_param("ss", $inmate_first_name, $inmate_last_name);
        $stmt->execute();
        $result_inmate = $stmt->get_result();

        //convert the array to a csv line
        $line = $row;
         //merge the inmate data with the appointment data
        $inmate_data = $result_inmate->fetch_assoc();
        if($inmate_data == null)
        {
            $inmate_data = array('sentence_start_date' => '','sentence_duration' => '','sentence_category' => '');
        }
        else
        {
            $inmate_data = array('sentence_start_date' => $inmate_data['sentence_start_date'],'sentence_duration' => $inmate_data['sentence_duration'],'sentence_category' => $inmate_data['sentence_category']);
        }

        $line_result = array_merge($line,$inmate_data);



        fputcsv($output,$line_result, $separator);

    }



    //add the appointments to the export data

   // print_r($export_data);

    fpassthru($output);
    fclose($output);
    //echo $filename;
    exit();


}


else
{
    http_response_code(405);
    exit();
}