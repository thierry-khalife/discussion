<header>
        <nav class="nav">
            <section id="logo">
                <a href="index.php"><img src="img/logo.png"></a>
            </section>
            <section class="undernav">
                <a href="topics.php"><img src="img/icon.png"></a>
                <a href="topics.php"><span>T</span>opics</a>
            </section>
            <?php if( !isset($_SESSION['login']) ){ ?>
            <section class="undernav">
                <a href="inscription.php"><img src="img/icon.png"></a>
                <a href="inscription.php"><span>I</span>nscription</a>
            </section>
            <section class="undernav">
                <a href="connexion.php"><img src="img/icon.png"></a>
                <a href="connexion.php"><span>C</span>onnexion</a>
            </section>
            <?php } if( isset($_SESSION['login']) ){ ?>
             <section class="undernav">
                <a href="profil.php"><img src="img/icon.png"></a>
                <a href="profil.php"><span>P</span>rofil</a>
            </section>
            <section class="undernav">
                <form action="index.php" method="get">
                    <input type="submit" class="submit1"  name="deco" value="Déconnexion" />
                </form>
                <a href="index.php?deco"><span>D</span>éconnexion</a>
            </section>
            <?php } ?>
        </nav>
    </header>
