<!DOCTYPE html>
<html>
<head>
<title>Connexion</title>
</head>
<body>
<h2>Connexion</h2>
<?php
    session_start();

 

 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $mot_de_passe = $_POST["mot_de_passe"];

 

 

        // Connexion à la base de données
       include_once("conn.php");
      //  $conn = new mysqli("localhost", "boby", "3737", "fred3737d");

 

 

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Connexion échouée : " . $conn->connect_error);
        }

 

 

        // Requête de sélection
        $sql = "SELECT id, mot_de_passe FROM utilisateurs WHERE email = '$email'";
        $result = $conn->query($sql);

 

 

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($mot_de_passe, $row["mot_de_passe"])) {
                $_SESSION["user_id"] = $row["id"];
                header("Location: espace_utilisateur.php");
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Aucun utilisateur trouvé avec cet email.";
        }

 

 

        $conn->close();
    }
    ?>
<form method="post" action="">
<label for="email">Email :</label>
<input type="email" id="email" name="email" required><br>

 

 

        <label for="mot_de_passe">Mot de passe :</label>
<input type="password" id="mot_de_passe" name="mot_de_passe" required><br>

 

 

        <input type="submit" value="Se connecter">
</form>
</body>
</html>
