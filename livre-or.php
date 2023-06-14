<?php

session_start(); //Session connexion
$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '123456789'); //Database connexion
?>

<!--Debut Display-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livre-or</title>
    <style>
body
{
    font-size: 20px;
    margin: 0;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    font-family: serif;
    background-color: gold;
}
nav
{
    margin: 30px auto;
    padding: 100px;
    background-color: darkgoldenrod;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    text-align: center;
}
a
{
    background-color: brown;
    color: gold;
    padding: 10px 30px;
    border: none;
    cursor: pointer;
    text-decoration: none; 
}
.a p
{
    font-size: 25px;
    background-color: brown;
    display: block;
    margin-right: auto;
    margin-left: auto;
    width: 30%;
    padding: 10px;
    border-radius: 5px;
}
article
{
    text-align: center;
}
    </style>
</head>
<body>
<header>
    <nav class="nav">
        <a href='livre-or.php'>Livre d'or</a>

        <?php if (isset($_SESSION['id'])) { ?>
            <a href="profil.php?id=" <?php $_SESSION['id'] ?>>Profil</a>
            <a href="commentaires.php?id=" <?php $_SESSION['id'] ?>>Commentaires</a>
            <?php
        } else { ?>
            <a href="../index.php">Accueil</a>
            <a href="inscription.php">Inscription</a>
        <?php } ?>

        <?php if (isset($_SESSION['id'])) { ?>
            <a href="deconnexion.php">Deconnexion</a>
        <?php } else { ?>
            <a href="connexion.php">Connexion</a>
        <?php } ?>

    </nav>
</header>
<main>
    <article>
        <?php //Request for the information from the two tables
        $req = $bdd->prepare("SELECT commentaires.commentaire, commentaires.date, utilisateurs.login FROM commentaires INNER JOIN utilisateurs WHERE commentaires.id_utilisateur = utilisateurs.id ORDER BY commentaires.id DESC");
        $req-> execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>
    </article>

    <article>
        <?php //Loop for display
        foreach  ($resultat as $row)
        {
            $date=date('d/m/Y', strtotime($row["date"]));
            echo '<div class="commentaire"><p class="date">Posté le :  '.$date.'</p>'.' <p>par : '.$row['login']  . '</p>'    . '<p class="com">'. $row['commentaire']  .'</p></div>';
        }
        ?>
    </article>

    <article class="a">
        <?php //Display for the button if someone is connected or not
        if (isset($_SESSION['id'])) {

            echo "<a href=commentaires.php><p> Commenter votre Coiffure !</p> </a>";
            echo "<a href=deconnexion.php><p> Deconnexion</p> </a>";
        } else {
            echo "<a href=connexion.php><p>Connection </p></a>";
        }
        ?>
    </article>

</main>
<footer></footer>
</body>
</html>