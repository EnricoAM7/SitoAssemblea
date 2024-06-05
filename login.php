<html>

<head>
    <link rel="stylesheet" href="css/login_styles.css">
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
        <div class="login_div">
            <div class="login_content">
                <div class="img_div">
                    <img src="images/747376-e872e00f.png">
                </div>
                <form method="post" action="login_function.php">
                    <label class="input_label">mail</label>
                    <input class="mail_input" type="mail" name="mail" placeholder="Inserisci la tua mail">
                    <label class="input_label">password</label>
                    <input class="password_input" type="password" name="password" placeholder="Inserisci la password">
                    <input class="submit_input" type="submit" value="LOGIN">
                    <div class="links_container">
                        <div class="link_div_1">
                            <a href="sign_in.php">Non ho un account</a>
                        </div>
                        <div class="link_div_2">
                            <a href="work_in_progres.php">Recupero password</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </main>
</body>

</html>