<?php
    session_start();

    session_unset();
    session_destroy();
    if(empty($_SESSION)) {
        echo "Sessione distrutta con successo.";
    } else {
        echo "Variabili di sessione ancora presenti.";
    }
    header("Location: index.php");

?>