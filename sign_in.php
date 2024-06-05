<html>

<head>
    <link rel="stylesheet" href="css/sign_in_styles.css">
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
            <div class="user">
                <button class="button-18" role="button" onclick="location.href = 'login.php'">Login</button>
            </div>

        </nav>
    </header>
    <div class="separator">
    </div>
    <main class="main">
        <div class="sign_in_div">
            <div class="sign_in_content">
                <br>
                <form method="post" action="Registrazione.php">
                    <label class="input_label">nome</label>
                    <input class="mail_input" type="text" name="nome" placeholder="Inserisci il tuo nome">
                    <label class="input_label">cognome</label>
                    <input class="password_input" type="text" name="cognome" placeholder="Inserisci il tuo cognome">
                    <label class="input_label">mail</label>
                    <input class="mail_input" type="mail" name="mail" placeholder="Inserisci la tua mail">
                    <label class="input_label">password</label>
                    <input class="password_input" type="password" name="password" placeholder="Inserisci la password">
                    <label class="input_label">plesso</label>
                    <select id="selettore_plesso" name="plesso" class="plesso_input">
                        <?php
                        //$servername = "80.20.95.170";
                        $servername = "192.168.5.37";
                        $username = "5AI_AMBROSI";
                        $password = "qRJn1Nka47LTpQmD";
                        $database = "5AI_AMBROSI";
                        $conn = new mysqli($servername, $username, $password, $database);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $query = "SELECT nome
                                                FROM Luogo
                                                WHERE blocked_flag=0";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <label class="input_label">classe</label>
                    <select id="selettore_classe" name="classe" class="classe_input">
                        <?php
                        $query = "SELECT nome FROM Classe WHERE id_luogo = (SELECT id_luogo FROM Luogo WHERE nome = (SELECT nome FROM Luogo WHERE blocked_flag=0 LIMIT 1) AND blocked_flag=0) AND blocked_flag=0";
                        $result = $conn->query($query);
                        $classes = array();
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
                            }
                        }
                        $conn->close();
                        ?>
                    </select>
                    <input class="submit_input" type="submit" value="Registrati">
                </form>
            </div>
        </div>
    </main>
</body>
<script>
    document.getElementById('selettore_plesso').addEventListener('change', function() {
        var selectedPlesso = this.value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_classes.php?plesso=' + encodeURIComponent(selectedPlesso), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var classes = JSON.parse(xhr.responseText);
                    var selectClasses = document.getElementById('selettore_classe');
                    selectClasses.innerHTML = '';
                    classes.forEach(function(classe) {
                        var option = document.createElement('option');
                        option.value = classe;
                        option.text = classe;
                        selectClasses.appendChild(option);
                    });
                } else {
                    console.error('Errore nella richiesta AJAX');
                }
            }
        };
        xhr.send();
    });
</script>
</html>