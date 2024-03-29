<?php
session_start();
ob_start();
$cnx = mysqli_connect("localhost", "root", "", "discussion");

if ( isset($_GET["idtopic"]) ) {
    $idtopic = $_GET["idtopic"];
    $intidtopic = intval($idtopic);
    $requete1 = "SELECT * FROM messages WHERE id_topic=$intidtopic ORDER BY date DESC";
    $query1 = mysqli_query($cnx, $requete1);
    $resultat = mysqli_fetch_all($query1, MYSQLI_ASSOC);
    $taille = sizeof($resultat) - 1;
    $requetetopic = "SELECT * FROM topics WHERE id=$intidtopic";
    $querytopic = mysqli_query($cnx, $requetetopic);
    $resultattopic = mysqli_fetch_all($querytopic, MYSQLI_ASSOC);
}

if ( isset($_SESSION['login']) ) {
    $requete2 = "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
    $query2 = mysqli_query($cnx, $requete2);
    $resultat2 = mysqli_fetch_all($query2, MYSQLI_ASSOC);
}
else {
    header("Location: connexion.php");
}

date_default_timezone_set('Europe/Paris');
$is2car = false;

if ( isset($_POST['envoyer']) == true && isset($_POST['message']) && strlen($_POST['message']) >= 2 ) {
    $connexion = mysqli_connect("localhost", "root", "", "discussion");

    $msg = $_POST['message'];
    $remsg = addslashes($msg);
    $requete2 = "INSERT INTO messages (message, id_utilisateur, date, id_topic) VALUES ('$remsg', ".$resultat2[0]['id'].", '".date("Y-m-d H:i:s")."', $intidtopic)";
    $query2 = mysqli_query($connexion, $requete2);
    header("Location: discussion.php?idtopic=$intidtopic");
    }
    elseif ( isset($_POST['envoyer']) == true && isset($_POST['message']) && strlen($_POST['message']) < 2 ) {
        $is2car = true;
    }
?>

<!DOCTYPE html>

<html>

<head>
    <title>Discussion - The Witcher</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php include("header.php"); ?>
    <main>
         <section class="corpsmain">
            <h1 class="h1topic">Discussion</h1>
            <?php
            $a = 0;
            if( !empty($resultat) && isset($_GET["idtopic"]) ) {
            while ($a <= $taille) {
                $datesql = $resultat[$a]['date'];
                $newdate = date('d-m-Y à H:i:s', strtotime($datesql));
                $iduser = $resultat[$a]['id_utilisateur'];
                $idcom = $resultat[$a]['id'];
                $intidcom = intval($idcom);
                $requetelogin = "SELECT login FROM utilisateurs WHERE id=$iduser";
                $querylogin = mysqli_query($cnx, $requetelogin);
                $resultatlogin = mysqli_fetch_all($querylogin, MYSQLI_ASSOC);
                include("like.php"); // SYSTEME DE LIKE/DISLIKE
                ?>
                <section class="cmessages">
                    <article>
                    <?php
                    echo "<b>".$resultatlogin[0]["login"].",</b> le <i><u>".$newdate."</u></i><br /><br />";
                    echo $resultat[$a]['message']."<br />";
                    ?>
                    </article>
                    <article>
                        <form method="post" action="discussion.php?idtopic=<?php echo $intidtopic; ?>">
                            <div id="formvote">
                            <?php
                            if ( isset($_SESSION['login']) && $resultat3[0]['COUNT(*)'] != "0" ) {
                                echo "<input type=\"submit\" name=\"likebutton".$a."\" id=\"likev\" value=\"like\"><div class=\"resultatvotes\">".$resultat5[0]['COUNT(*)']."</div>";
                                echo "<input type=\"submit\" name=\"dislikebutton".$a."\" id=\"dislike\" value=\"dislike\"><div class=\"resultatvotes\">".$resultat6[0]['COUNT(*)']."</div>";
                            }
                            elseif ( isset($_SESSION['login']) && $resultat4[0]['COUNT(*)'] != "0" ) {
                                echo "<input type=\"submit\" name=\"likebutton".$a."\" id=\"like\" value=\"like\"><div class=\"resultatvotes\">".$resultat5[0]['COUNT(*)']."</div>";
                                echo "<input type=\"submit\" name=\"dislikebutton".$a."\" id=\"dislikev\" value=\"dislike\"><div class=\"resultatvotes\">".$resultat6[0]['COUNT(*)']."</div>";
                            }
                            else {
                                echo "<input type=\"submit\" name=\"likebutton".$a."\" id=\"like\" value=\"like\"><div class=\"resultatvotes\">".$resultat5[0]['COUNT(*)']."</div>";
                                echo "<input type=\"submit\" name=\"dislikebutton".$a."\" id=\"dislike\" value=\"dislike\"><div class=\"resultatvotes\">".$resultat6[0]['COUNT(*)']."</div>";
                            }
                            ?>
                            </div>
                        </form>
                    </article>
                    <article>
                        <?php
                        if(isset($_SESSION['login']) && $_SESSION['login'] == "admin")
                        {
                            echo "<form method=\"post\" action=\"discussion.php?idtopic=$intidtopic\">
                            <br><input type=\"submit\" class=\"submit2\"  name=\"delete".$a."\" value=\"$idcom\" />
                            </form>";
                        }
                        ?>
                    </article>
                </section>
                <?php // SYSTEME DELETE WHEN ADMIN
                if (isset($_POST["delete".$a])) {
                    $todel = $_POST["delete".$a];
                    $requetedel = "DELETE FROM messages WHERE id=$todel";
                    $querydel = mysqli_query($cnx, $requetedel);
                    $requetedellike = "DELETE FROM votes WHERE id_message=$todel";
                    $querydellike = mysqli_query($cnx, $requetedellike);
                    header("Location: discussion.php?idtopic=$intidtopic");
                }
                $a++;
            }
        }
        elseif ( isset($_GET["idtopic"]) && empty($resultattopic) || isset($_SESSION['login']) && !isset($_GET["idtopic"]) ) {
            echo "Ce topic n'existe pas !";
        }
        elseif ( isset($_GET["idtopic"]) && !empty($resultattopic) && empty($resultat) ) {
            echo "Ce topic est vide, envoyez votre premier message !";
        }
            ?>
            <?php
           
            if ( isset($_SESSION['login']) && isset($_GET["idtopic"]) && !empty($resultattopic) ) {
            ?>
                <form class="form_site" method="post" action="discussion.php?idtopic=<?php echo $intidtopic; ?>">
                    <label>VOTRE MESSAGE</label>
                    <textarea name="message" ></textarea><br />
                    <input type="submit" value="Envoyer" name="envoyer" >
                </form>
                <?php
                if ( $is2car == true ) {
                ?>
                    <p>Votre message doit comporter au moins 2 caractères.</p>
                <?php
                }
            }

            elseif ( !isset($_SESSION['login']) ) {
            ?>
                <center><p><b>ERREUR</b><br />
                Vous devez être connecté pour accéder à cette page.</p></center>
            <?php
            }
            ?>
           </section>
        <section>
     </section>
     <section class="gifmain"> 
            <img src="img/anim.gif">
    </section>
    </main>
<?php include("footer.php"); 
mysqli_close($cnx);
ob_end_flush();
?>
</body>

</html>