<?php

use Firebase\JWT\Key;
use Firebase\JWT\JWT;

//this api endpoint is used to retrieve the data of a specific inmate

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once '../../vendor/autoload.php';
    require_once '../Utils/DbConnection.php';
    $config = require '../../config.php';


    session_start();
    $token = $_SESSION['token'];
    $key = $config['secret_key'];

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
    //print_r($username);

    $conn = DbConnection::getInstance()->getConnection();
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GFG User Details</title>
        <!-- CSS FOR STYLING THE PAGE -->
        <style>
            table {
                margin: 0 auto;
                font-size: large;
                border: 1px solid black;
            }

            h1 {
                text-align: center;
                color: #006600;
                font-size: xx-large;
                font-family: 'Gill Sans', 'Gill Sans MT',
                ' Calibri', 'Trebuchet MS', 'sans-serif';
            }

            td {
                background-color: #E4F5D4;
                border: 1px solid black;
            }

            th,
            td {
                font-weight: bold;
                border: 1px solid black;
                padding: 10px;
                text-align: center;
            }

            td {
                font-weight: lighter;
            }
        </style>
    </head>

    <body>
    <section>
        <h1>HTML page</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Secondary Email</th>
                <th>Function</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
            // LOOP TILL END OF DATA
            //select all the data of a user
            $sql = "SELECT user_id,username,fname,lname,email,secondary_email,function FROM users where username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            //$export_data  = array();
            $stmt->execute();
            $result = $stmt->get_result();

            while($rows=$result->fetch_assoc())
            {
                $user_id = $rows['user_id'];
                ?>
                <tr>
                    <!-- FETCHING DATA FROM EACH
                        ROW OF EVERY COLUMN -->
                    <td><?php echo $rows['user_id'];?></td>
                    <td><?php echo $rows['username'];?></td>
                    <td><?php echo $rows['fname'];?></td>
                    <td><?php echo $rows['lname'];?></td>
                    <td><?php echo $rows['email'];?></td>
                    <td><?php echo $rows['secondary_email'];?></td>
                    <td><?php echo $rows['function'];?></td>
                </tr>
                <?php
            }


            ?>
        </table>
        <br><br>
        <table>
            <tr>
                <th>Prisoner first name</th>
                <th>Prisoner last name</th>
                <th>Relationship</th>
                <th>Nature of the visit</th>
                <th>Income source</th>
                <th>Visit start</th>
                <th>Visit end</th>
                <th>Prisoner sentence start date</th>
                <th>Prisoner sentence end date</th>
                <th>Prisoner sentence category</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
            // LOOP TILL END OF DATA
            $sql2 = "SELECT * FROM appointments WHERE person_id = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("i", $user_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $row2 = $result2->fetch_assoc();
            print_r($row2);


            //get the inmate for each appointment

            while ($row2 != null) {
                // $inmate_id = $row['inmate_id'];
                $inmate_first_name = $row2['firstname'];
                $inmate_last_name = $row2['lastname'];

                $stmt3 = $conn->prepare("SELECT fname,lname, sentence_start_date,sentence_duration ,sentence_category FROM inmates WHERE fname = ? AND lname = ? ");
                $stmt3->bind_param("ss", $inamte_first_name, $inmate_last_name);
                $stmt3->execute();
                $result3 = $stmt3->get_result();
                $inmate = $result3->fetch_assoc();
                //put in an array all the data of the inmates


            }


            ?>
        </table>
    </section>
    </body>

    </html>
<?php

}
?>