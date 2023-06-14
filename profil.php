<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', '123456789'); //Database connexion`

// echo "ma session".$_SESSION["id"];
// Récupération des informations actuelles de l'utilisateur depuis la base de données
$userID =  $_SESSION['id']; // Remplacez cette valeur par l'ID de l'utilisateur connecté


$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$req->execute(array($userID));

if ($req->rowCount() > 0) {
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $login = $row["login"];
    $password = $row["password"];


    print_r($row); // Utilisation de print_r pour afficher les détails de l'utilisateur
} else {
    echo "Utilisateur non trouvé.";
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nouveaulogin = $_POST["login"];
    $nouveaupassword = $_POST["password"];

    // Mise à jour des informations dans la base de données
    $updateSql = "UPDATE utilisateurs SET  login = '$nouveaulogin', password = '$nouveaupassword' WHERE id = $userID";
    if ($bdd->query($updateSql) === TRUE) {
        echo "Profil mis à jour avec succès.";
        // Vous pouvez rediriger l'utilisateur vers une autre page après la mise à jour du profil si nécessaire
    } else {
        echo "Erreur lors de la mise à jour du profil: "; 
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
        
        a , input{
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
        <h1>Profil</h1>
    </header>
<form class="formulaire" action="profil.php" method="post">
            <ul>
                <br />
                    <h1>Modifier votre profil</h1>
                <br />
                <li>
                    <label for="login">login</label>
                    <input type="text" id="login" name="login" value="<?php echo $login; ?>" required>
                </li>
                <br />
                <li>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" value="<?php echo $password; ?>" required>
                </li>
                <br />
                   <input type="submit" name="valider" value="Valider &#10004;" />
                    <a href="deconnexion.php">Deconnexion</a>
                    <br />
                    <br>
                    <br>
            <a href="livre-or.php">Livre d'or</a>
            </ul>
        </form>
</body>
</html>