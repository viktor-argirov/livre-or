<?php

$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '123456789'); //Database connexion`

if(isset($_POST['submit'])){
    if( isset($_POST['login']) && isset($_POST['password']) ){
        $login = $_POST['login'];
        $password = $_POST['password'];

        $sql = "INSERT INTO utilisateurs (login, password) VALUES (?, ?);";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$login, $password]);
        header("Location: connexion.php");
        exit();

    } else {
        echo "Tous les champs ne sont pas remplis.";
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
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
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
        <h1>Inscription</h1>
    </header>
    <main>
        <h2>Remplissez le formulaire d'inscription :</h2>
        <form method="POST" action="inscription.php">
      <p>
      <label for="login">Login </label>
      <input type="text" name="login" id="login">
      </p>
      <p>
      <label for="password">Password</label>
      <input type="text" name="password" id="password">
      </p>
      <p>
      <label for="password">Confirm password</label>
      <input type="text" name="password" id="password">
      </p>
      <p>
      <input type="submit" name="submit" id="submit" value="Submit">
      <a href="index.php">Accueil</a>
      </p>
    </form>
    </main>
</body>
</html>