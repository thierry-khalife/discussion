<?php session_start() ?>

<!DOCTYPE html>

<html>

<head>
    <title>New Topic - The Witcher</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php include("header.php"); ?>
    <main>
        <section class="corpsmain">
            <?php
            date_default_timezone_set('Europe/Paris');
            $cnx = mysqli_connect("localhost", "root", "", "discussion");
            if (isset($_SESSION["login"])) 
            {
                    $requete2 = "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
                    $query2 = mysqli_query($cnx, $requete2);
                    $resultat2 = mysqli_fetch_all($query2, MYSQLI_ASSOC);
                    echo "Bonjour, " . $_SESSION["login"] . " vous êtes connecté vous pouvez créer un topic.<br />";
            ?>
                    <article><h1>Veuillez rentrer le nom du topic :</h1></article>
                    <form class="form_site" action="newtopic.php" method="post">
                        <label>Nom du topic</label>
                        <input type="text" name="topic" required>
                        <br />
                        <input class="mybutton"  type="submit" value="Create Topic" name="valider">
                    </form>
            <?php
                    if ( isset($_POST["valider"]) )
                    {
                          $nomtopic = $_POST['topic'];
                          $rename = addslashes($nomtopic); 
                          $requete = "INSERT INTO topics (nomtopic, id_utilisateur , datecreation) VALUES ('$rename', ".$resultat2[0]['id'].", '".date("Y-m-d H:i:s")."')";
                          $query = mysqli_query($cnx, $requete);
                          header('Location:topics.php');
                    }
            } 
            else 
            {
                 echo "Bonjour Guest, Veuillez vous connecté afin de pouvoir créer un topic.<br />";
               
            }

            mysqli_close($cnx);
            ?>
        </section>
        <section class="gifmain"> 
            <img src="img/anim.gif">
    </section>
    </main>
<?php include("footer.php"); ?>
</body>

</html>
