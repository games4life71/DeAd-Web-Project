<?php
$username = $_SESSION['username'];
$id=$_SESSION['id'];
$conn = new mysqli('127.0.0.1:3306', 'root', 'root', 'mybd');
/*$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();*/



    $name = $_POST['name'];
    $surname = $_POST['surname'];

    //verify if the name and surname contain only letters
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        header("Location: change_info.php?error=1&username=$username&em");
        exit();
    }
    else if (!preg_match("/^[a-zA-Z ]*$/", $surname)) {
        header("Location: change_info.php?error=2");
        exit();
    }
    $secondary_email = $_POST['secondary_email'];

    $stmt = $conn->prepare("UPDATE users SET name = ?, surname = ?, secondary_email = ? WHERE username = ?");
    $stmt->bind_param("ssss", $name, $surname, $secondary_email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        header("Location: profile.php");
        exit;
    } else {
        echo "Failed";
    }

    $stmt->close();
    $conn->close();




