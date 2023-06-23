<?php
require_once '../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

session_start();

// Verifică dacă utilizatorul este logat
if (!isset($_SESSION['is_logged_in'])) {
    header('Location: ../Login_Module/login.php');
    exit();
}

// Verifică dacă utilizatorul este admin
if (!isset($_SESSION['token'])) {
    header('Location: ../Login_Module/login.php');
    exit();
}

$config = require '../../config.php';
$key = $config['secret_key'];
$jwt = new JWT();

try {
    $decode = $jwt->decode($_SESSION['token'], new Key($key, 'HS256'));

    // Verifică dacă utilizatorul este admin
    if ($decode->role !== 'admin') {
        header('Location: ../Login_Module/login.php');
        exit();
    }
} catch (Exception $e) {
    header('Location: ../Login_Module/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../NavBar/navstyle.css">
    <link rel="stylesheet" href="adminvisitstyle.css">
    <title>Make an appointment</title>
</head>
<body>
<header class="header">
    <a href="../HomePage/homepage.php"><img src="../../assets/Logo/Asset%201.svg" class="logo" alt="logo"></a>
    <input class="menu-btn" type="checkbox" id="menu-btn"/>
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="../HomePage/homepage.php">Home</a></li>
        <?php
        if($_SESSION['is_logged_in'])
        {
            echo '<li><a href="../UserProfile/profile.php">Profile</a></li>';
        }
        else
        {
            echo'<li><a href="../Login_Module/login.php">Login</a></li>';
        }
        ?>
        <li><a href="../About/about.php">About Us</a></li>
        <li><a href="../Contact/contact.php">Contact</a></li>
        <li><a href="../FAQ/faq.php">FAQ</a></li>
    </ul>
</header>
<body>
<header class="header">
    <a href="../HomePage/homepage.php"><img src="../../assets/Logo/Asset%201.svg" class="logo" alt="logo"></a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="../HomePage/homepage.php">Home</a></li>
        <?php
        if($_SESSION['is_logged_in'])
        {
            echo '<li><a href="../UserProfile/profile.php">Profile</a></li>';
        }
        else
        {
            echo'<li><a href="../Login_Module/login.php">Login</a></li>';
        }
        ?>
        <li><a href="../About/about.php">About Us</a></li>
        <li><a href="../Contact/contact.php">Contact</a></li>
        <li><a href="../FAQ/faq.php">FAQ</a> </li>
    </ul>
</header>

<?php
$username = $_GET['username'];
?>

<div class="visit">
    <div class="form-header">
        <h1>Edit appointments of <?php echo $username; ?></h1>
    </div>

    <?php
    if (isset($_GET['username'])) {
        $username = $_GET['username'];
        require '../Utils/DbConnection.php';
        $conn = DbConnection::getInstance()->getConnection();

        // Prepare the SQL statement to retrieve appointments for the given username
        $sql = "SELECT a.person_id, a.appointment_id, a.firstname, a.lastname, a.date, a.visit_nature, a.visit_start, u.username AS visited
                    FROM appointments AS a
                    INNER JOIN users AS u ON a.person_id = u.user_id
                    WHERE u.username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Display the table of appointments
            echo '<div class="form-body">';
            echo '<div class="visitor-list">';
            echo '<div class="visitor-info">';

            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Firstname</th>';
            echo '<th>Lastname</th>';
            echo '<th>Date</th>';
            echo '<th>Visit Start</th>';
            echo '<th>Nature</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['firstname'] . '</td>';
                echo '<td>' . $row['lastname'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['visit_start'] . '</td>';
                echo '<td>' . $row['visit_nature'] . '</td>';
                echo '<td><a class="edit-button" href="../Admin_Edit/editappointment.php?appointment_id=' . $row['appointment_id'].  '&person_id=' . $row['person_id'] . '&username=' . $username . '">Edit</a></td>';
                //echo '<td><button class="edit-button" data-id="' . $row['appointment_id'] . '" data-personid="' . $row['person_id'] . '">Edit</button></td>';
                echo '<td><button class="delete-button" data-id="' . $row['appointment_id'] . '">Delete</button></td>';
                echo '</tr>';
            }


            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="form-footer">';
            echo '<h1> Export data about the user:</h1>';
            echo '<button class="export-button"><a href="../Export_Data/retrieve_data_asJSON.php?username='.$username.'"'.'>Export JSON</a></button>';
            echo '<button class="export-button"><a href="../Export_Data/retrieve_data_asCSV.php?username='.$username.'"'.'>Export CSV</a></button>';
            echo '<button class="export-button"><a href="../Export_Data/retrieve_data_asHTML.php?username='.$username.'"'.'>Export HTML</a></button>';
            echo '</div>';
            echo '<br>';
        } else {

            // Display a message if no appointments are found
            echo '<div class="button-center">';
            echo '<p style="color:  #5c4b4b ">No appointments found for the given username.</p>';
            echo '</div>';
            echo '<br>';
            echo '<div class="form-footer">';
            echo '<h1> Export data about the user:</h1>';
            echo '<button class="export-button"><a href="../Export_Data/retrieve_data_asJSON.php?username='.$username.'"'.'>Export JSON</a></button>';
            echo '<button class="export-button"><a href="../Export_Data/retrieve_data_asCSV.php?username="'.$username.'"'.'>Export CSV</a></button>';
            echo '<button class="export-button"><a href="../Export_Data/retrieve_data_asHTML.php?username='.$username.'"'.'>Export HTML</a></button>';
            echo '</div>';
            echo '<br>';
        }


        // Close the database connection
        mysqli_close($conn);
    }
    ?>


<!--    <div class="form-footer">-->
<!--        <h1>Export data about the user:</h1>-->
<!--        <button class="export-button"><a href="../Export_Data/#">Export JSON</a></button>-->
<!--        <button class="export-button"><a href="../Export_Data/#">Export CSV</a></button>-->
<!--        <button class="export-button"><a href="../Export_Data/#">Export HTML</a></button>-->
<!--    </div>-->


</div>


<script>
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault(); // Oprire comportamentul implicit al butonului

            const appointmentId = button.getAttribute('data-id');
            const currentUrl = window.location.href; // Obține URL-ul paginii curente

            if (confirm('Are you sure you want to delete this appointment?')) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-HTTP-Method-Override', 'DELETE'); // Setăm header-ul X-HTTP-Method-Override pentru a simula cererea DELETE
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Redirecționează utilizatorul înapoi la pagina adminvisit.php cu parametrul username
                        window.location.href = currentUrl;
                    } else {
                        alert('Error deleting appointment. Please try again.');
                    }
                };
                xhr.send('appointment_id=' + encodeURIComponent(appointmentId));
            } else {
                // Dacă utilizatorul apasă "Cancel", nu se întâmplă nimic
            }
        });
    });

    const editLinks = document.querySelectorAll('.edit-link');

    editLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault(); // Opriți comportamentul implicit al link-ului

            const editUrl = link.getAttribute('href');
            window.location.replace(editUrl);
        });
    });




</script src="getJSON.js"><script



</script>

</body>

</html>
