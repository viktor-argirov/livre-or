<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '123456789'); //Database connexion`

if(isset($_POST['submit'])) {
    if(isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
        $requser->execute(array($login, $password));
        $userexist = $requser->rowCount();

        if($userexist == 1) {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['login'] = $userinfo['login'];
            $_SESSION['password'] = $userinfo['password'];
            header("Location: profil.php?id=".$_SESSION['id']);
            exit();
        } else {
            $error = "Identifiant ou mot de passe incorrect.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: serif;
            margin: 0;
            padding: 0;
            background-color: gold;
            font-size: 20px;

        }
        header {
            background-color: brown;
            color: gold;
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin: 0;
            margin-right: 85%;
        }
        h2{
            color: brown;
        }
        main {
            margin: 30px auto;
            padding: 300px;
            background-color: darkgoldenrod;
            text-align: center;
        }
        
        a , input {
            background-color: brown;
            color: gold;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
        }
</style>
</head>
<body>
<header>
        <h1>Connexion</h1>
    </header>
    <main>
        <h2>Entrez vos informations de connexion :</h2>
        <form method="POST" action="connexion.php">
            <input type="login" name="login" placeholder="login" />
            <input type="password" name="password" placeholder="Mot de passe" />
            <br /><br />
           <a href="profil.php"><input type="submit" name="submit" value="Se connecter !" /></a> 
           <a href="inscription.php">Inscription</a>
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
    </main>
</body>
</html>
