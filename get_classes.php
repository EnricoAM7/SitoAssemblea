<?php

if(isset($_GET['plesso'])) {
    
    $selectedPlesso = $_GET['plesso'];
    //$servername="80.20.95.170";
    $servername="192.168.5.37";
    $username="5AI_AMBROSI";
    $password="qRJn1Nka47LTpQmD";
    $database="5AI_AMBROSI";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT nome FROM Classe WHERE id_luogo = (SELECT id_luogo FROM Luogo WHERE nome = '" . $selectedPlesso . "' AND blocked_flag=0) AND blocked_flag=0";
    $result = $conn->query($query);
    $classes = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $classes[] = $row['nome'];
        }
    }
    echo json_encode($classes);
} else {
    
    echo json_encode(array('error' => 'Parametro plesso non trovato'));
}
?>
