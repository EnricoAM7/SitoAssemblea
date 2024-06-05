<?php


//$servername="80.20.95.170";
$servername = "192.168.5.37";
$username = "5AI_AMBROSI";
$password = "qRJn1Nka47LTpQmD";
$database = "5AI_AMBROSI";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$password = $_POST["password"];
$mail = $_POST["mail"];


$query = "SELECT id_utente FROM Utente WHERE blocked_flag=0 AND email='" . $mail . "' AND pw='" . $password . "' ";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $logged = true;
} else {
    $logged = false;
};

if ($logged == true) {


    session_start();
    $mioToken = bin2hex(random_bytes(16));
    $durata = 600;
    $now = time();
    $_SESSION["token"] = $mioToken;
    $_SESSION["discard_after"] = $durata + $now;

    $query = "SELECT id_utente FROM Utente WHERE blocked_flag=0 AND  pw='" . $password . "' AND email='" . $mail . "'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id_utente = $row['id_utente'];
        }
    }

    $query = "INSERT INTO Session_Token(token, id_utente, discard_after, time_gen)
        VALUES ('" . $mioToken . "', '" . $id_utente . "', '" . $_SESSION["discard_after"] . "', '" . $now . "');";
    $result = $conn->query($query);


    header("Location: index.php");
}
