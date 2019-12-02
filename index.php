<?php session_start(); ?>

<!DOCTYPE html>

<html>

<head>
    <title>The Witcher III - Wild Hunt</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <?php include("header.php"); ?>
    <main>
     <section class="corpsmain">
        <?php
        date_default_timezone_set('Europe/Paris');
        if(isset($_SESSION['login']))
        {
            ?>
            <?php
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            ?>
            <?php echo "&nbsp Bonjour ".$_SESSION["login"]." &nbsp" ?>
            <p>Vous êtes connecté en tant qu'utilisateur. Accédez à votre page de <a href="profil.php">PROFIL</a></p>
            <p><a href="topics.php">Voir la liste des Topics</a></p>
            <p><a href="newtopic.php">Ajouter un Topic</a></p>
            <form class="form_site" action="index.php" method="get">
            <input class="mybutton"  name="deco" value="Deconnexion" type="submit" />
            </form>
            <?php
        }
        else
        {
            ?>
            <?php
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            ?>
            <p>Bonjour Guest</p>
            <p>Pour pouvoir accéder à votre profil veuillez visiter la page : <a href="connexion.php">CONNEXION</a></p>
            <p>Pas de compte ? Inscrivez-vous en remplissant le formulaire : <a href="inscription.php">INSCRIPTION</a></p>
        <?php
        }
        
        if (isset($_GET["deco"]))
        {
         session_unset();
         session_destroy();
         header('Location:index.php');
        }
        ?>
         </section>
         <section class="gifmain"> 
            <img src="img/anim.gif">
    </section>
    </main>
    <?php include("footer.php"); ?>
</body>

</html>
