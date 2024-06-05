<html>

<head>
    <link rel="stylesheet" href="css/index_styles.css">

</head>

<body>
    <header>
        <nav class="nav_bar">
            <div class="logo">
                <a href="index.php" class="logo_a">
                    <img src="images/image-removebg-preview2.png">
                </a>
            </div>
            <div class="title">
                <h1>ASSEMBLEA D'ISTITUTO </h1>
                <h2>IIS EUGANEO </h2>
            </div>

            <?php
            //$servername = "80.20.95.170";
            //prova commit
            $servername = "192.168.5.37";
            $username = "5AI_AMBROSI";
            $password = "qRJn1Nka47LTpQmD";
            $database = "5AI_AMBROSI";
            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }


            session_start();
            if (isset($_SESSION["token"])) {

                $token = $_SESSION["token"];
                $query = "SELECT token  FROM Session_Token WHERE blocked_flag=0 AND expired=0 AND token='" . $token . "'";
                $result = $conn->query($query);
                if ($result->num_rows == 1) {
                    $logged = true;
                    $now = time();
                    if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
                        //DELETE FROM DB del token e loggo tutto

                        session_unset();
                        session_destroy();

                        //refresh ?
                        //ri mando alla login ?
                        $logged = false;
                    } else {
                        echo "<div class='user'>
                        <button class='button-18' role='button' onclick='location.href = \"logout.php\"'>Logout</button>
                    </div>";
                    }
                } else {
                    $logged = false;
                    session_unset();
                    session_destroy();
                    session_start();
                    echo "<div class='user'>
                        <button class='button-18' role='button' onclick='location.href =  \"login.php\"'>Login</button>
                    </div>";
                };
            } else {
                $logged = false;
                echo "<div class='user'>
                        <button class='button-18' role='button' onclick='location.href = \"login.php\"'>Login</button>
                    </div>";
            }


            ?>


        </nav>
    </header>
    <div class="separator">
    </div>
    <main class="main">
        <div class="events_div">
            <div class="login_content">
                <?php

                $query = "SELECT Assemblea.nome AS 'nome_assemblea', Assemblea.ora_inizio, Assemblea.ora_termine, Luogo.nome AS 'nome_luogo' FROM Assemblea, Luogo WHERE Assemblea.blocked_flag=0 AND Luogo.blocked_flag=0 AND Assemblea.id_luogo=Luogo.id_luogo;";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<br>
                                <form method='post' action='activity.php'> 
                                    <div class='riquadro_assemblea'>
                                        <div class='left_div'>
                                            <p style='font-size: larger; font-weight: bold;'>" . $row['nome_assemblea'] . "</p>
                                            <p>Ora d'inzio: " . $row["ora_inizio"] . "</p>
                                            <p>Ora di fine: " . $row["ora_termine"] . "</p>
                                            <p>Plesso: " . $row["nome_luogo"] . "</p>
                                        </div>";
                        if($logged==true){                                   
                            echo"       <div class='right_div'>
                                        <button class='button-18xriquadro_assemblea'> Visualizza Attività</button>
                                        
                                        </div>";
                        }else{
                            echo"       <div class='right_div'>
                                        <button class='button-18xriquadro_assemblea' disabled> Visualizza Attività</button>
                                        
                                        </div>";
                        }                
                                        
                        echo            "</div>
                                </form>
                            <br>";
                    }
                }

                ?>




            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-content">
            <img class="footer-logo" src="images/image-removebg-preview2.png" alt="" data-image-width="160" data-image-height="160" data-href="Home.html">
            <p class="footer-text">© 2024 Enrico Ambrosi &amp; Andrea Zanellato &amp; Manuel Bortolato &amp; Riccardo Padoan&nbsp;</p>
        </div>
    </footer>
</body>

</html>