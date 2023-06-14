<?php
session_start(); //Session connexion
$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '123456789'); //Database connexion

if(isset($_SESSION["id"]))
{
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ? ");
    $req->execute(array($_SESSION["id"]));
    $userinfo = $req->fetch();

    if(isset($_POST["submit"]))
    {
        if(!empty($_POST["description"]) AND isset($_POST["description"]))
        {
            $id_utilisateur = $userinfo["id"];
            $description= htmlspecialchars($_POST["description"]);
            $date=date('Y-m-d h:i:s');

            $req = $bdd->prepare('INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (?,?,?)');
            $req->execute(array( $description, $id_utilisateur,$date));
            $error ="Vous avez bien commenté";
        }
        else
        {
            $error ="Vous n'avez pas laissez de commentaires";
        }
    }
}

?>

<!--Debut Display-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commentaires</title>
    <style>
body
{
    margin: 0;
    height: 100vh;
    background-color: #EAC100;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    font-family: serif;
    font-size: 20px;


}


.nav
{
    text-align: center;
    background-color: brown;
    padding: 10px;
}
a
{
    color: white;
    padding: 10px;
}
/*Form*/

form
{
    width: 50%;
    font-weight: bold;
    text-align: center;
    margin-right: auto;
    margin-left: auto;
}
.formflex
{
    padding: 25px;
    color: #ffffff;
}

input
{
    border: none;
    background: none;
    border-radius: 5px;
    text-align: center;
    padding: 30px;
    margin: 10px;
    width: 50%;
    font-size: 20px;
}


a , input{
    background-color: brown;
    color: gold;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    text-decoration: none;
}

h1
{
    
    color: brown;
}

textarea
{
    resize: none;
    border: none;
    border-radius: 5px;
}
span
{
    color: brown;
    text-decoration: none;
}
</style>
</head>
<body>
<header>
</header>
<main>
    <article>
        <!--Debut form -->
        <form method="post" action="">
            <h1>Laissez-nous votre Commentaire!</h1>
            <div class="formflex">
                <div>
                    <!--<label for="description">Commentaires</label>-->
                    <textarea id="description" name="description" rows="8" cols="60" placeholder="Ecris !"  minlength="3" maxlength="255" ></textarea>
                </div>

                <input type="submit" name="submit" value="Commentes !">
            </div>
            <?php
            if(isset($error))
            {
                echo $error;
            }
            ?>
        </form>
        <!--End form -->
    </article>
</main>
<footer>
    <nav class="nav">

        <!--Nav PHP-->
        <a href='livre-or.php'>Livre d'or</a>
        <?php if (isset($_SESSION['id'])) { ?>
            <a href="profil.php?id=" <?php $_SESSION['id'] ?>>Profil</a>
            <a href="commentaire.php?id=" <?php $_SESSION['id'] ?>>Commentaires</a>
            <?php
        } else { ?><a href="inscription.php">Inscription</a><?php } ?>

        <?php if (isset($_SESSION['id'])) { ?>
            <a href="deconnexion.php">Deconnexion</a>
        <?php } else { ?>
            <a href="connexion.php">Connexion</a>
        <?php } ?>
        <!--Nav PHP-->

    </nav>
</footer>
</body>
</html>