<?php
if (isset($_POST['submit'])) {
    require '../Utils/DbConnection.php';
    $conn = DbConnection::getInstance()->getConnection();

    // Preluarea datelor din formular
    $appointmentId = $_GET['appointment_id'];
    $personId = $_GET['person_id'];
    $username = $_GET['username'];
    $visitNature = $_POST['visit_nature'];
    $date = $_POST['date'];
    $visitTimeStart = $_POST['visit_time_start'];
    $visitTimeEnd = $_POST['visit_time_end'];

    // Actualizarea înregistrării în baza de date
    $sql = "UPDATE appointments 
            SET visit_nature = '$visitNature', date = '$date', visit_start = '$visitTimeStart', visit_end = '$visitTimeEnd'
            WHERE appointment_id = $appointmentId";
    $result = mysqli_query($conn, $sql);

    // Verificarea rezultatului actualizării
    if ($result) {
        // Redirecționare către pagina anterioară cu parametrul username
        header("Location: ../Admin_Visit/adminvisit.php?username=$username");
        exit();
    } else {
        // Tratarea erorilor în cazul în care actualizarea a eșuat
        echo "Error updating appointment: " . mysqli_error($conn);
    }

    // Închiderea conexiunii cu baza de date
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../NavBar/navstyle.css">
    <link rel="stylesheet" href="appstyle.css">
    <title>Edit appointment</title>
</head>
<body>
<header class="header">
    <a href="../HomePage/homepage.php"><img src="../../assets/Logo/Asset%201.svg" class="logo" alt="logo"></a>
    <input class="menu-btn" type="checkbox" id="menu-btn"/>
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="../HomePage/homepage.php">Home</a></li>
        <li><a href="../Login_Module/login.php">Login</a></li>
        <li><a href="../About/about.html">About Us</a></li>
        <li><a href="../Contact/contact.html">Contact</a></li>
        <li><a href="../FAQ/faq.html">FAQ</a></li>
    </ul>
</header>

<form class="visit" action="" method="post" enctype="multipart/form-data">
    <div class="form-header">
        <h1>Make an appointment</h1>
    </div>

    <div class="form-body">
        <div class="form-group left">
            <label class="label-title">The nature of the visit:</label>
            <div class="input-group">
                <label>
                    <input type="radio" name="visit_nature" value="parental">Parental</label>
                <label>
                    <input type="radio" name="visit_nature" value="friendship">Friendship</label>
                <label>
                    <input type="radio" name="visit_nature" value="lawyership">Lawyership</label>
            </div>
        </div>

        <div class="form-group left">
            <label for="date" class="label-title">Date:</label>
            <input type="date" name="date" id="date" class="form-input" required="required">
        </div>

        <div class="form-group right">
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 1) {
                    //the inmate already has a visit at that time
                    echo "<div class='form-group'><p class='error'>The inmate already has a visit at that time</p></div>";
                }
            }
            ?>
            <label for="time-start" class="label-title">Visit time start-end (max 5h)</label>
            <label for="time-end" class="label-title"></label>
            <input type="time" id="time-start" name="visit_time_start" min="09:00" max="18:00"
                   class="form-input"
                   style="height:28px;width:30%;padding:0;" required>
            <input type="time" id="time-end" name="visit_time_end" min="09:00" max="18:00" class="form-input"
                   style="height:28px;width:30%;padding:0;" required>
        </div>

        <div class="button-center">
            <button type="submit" name="submit" class="btn">Submit</button>
        </div>
    </div>
</form>

</body>
</html>
