<?php
// Verificați dacă a fost trimisă variabila `appointment_id`
if (isset($_POST['appointment_id'])) {
    $appointmentId = $_POST['appointment_id'];

    // Efectuați conexiunea la baza de date și executați interogarea de ștergere
    require '../Utils/DbConnection.php';
    $conn = DbConnection::getInstance()->getConnection();
    $sql = "DELETE FROM appointments WHERE appointment_id = '$appointmentId'";
    $result = mysqli_query($conn, $sql);

    // Verificați rezultatul ștergerii și returnați un răspuns corespunzător
    if ($result) {
        http_response_code(200); // OK
    } else {
        http_response_code(500); // Internal Server Error
    }

    // Închideți conexiunea la baza de date
    mysqli_close($conn);
} else {
    http_response_code(400); // Bad Request
}
