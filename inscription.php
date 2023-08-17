<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);
 
        // Connexion à la base de données
        $conn = new mysqli("localhost", "boby", "3737", "fred3737d");
 
        // Vérifier la connexion
        if ( $conn ->connect_error) {
            die("Connexion échouée : " . $conn->connect_error);
        }
 
        // Requête d'insertion
        $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES ('$nom', '$email', '$mot_de_passe')";
 
        if ($conn->query($sql) === TRUE) {
            echo "Inscription réussie.";
        } else {
            echo "Erreur : " . $sql . "<br>" . $conn->error;
        }
 
        $conn->close();
    }
    ?>
    <form method="post" action="">
        <label for="nom">Nom :</label>
       <input type="text" id="nom" name="nom" required><br>
 
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br>
 
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>
 
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
