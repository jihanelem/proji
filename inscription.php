<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "projet";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$departement = $_POST["departement"];
$campus = $_POST["campus"];
$etat = $_POST["etat"];

$sql = "INSERT INTO utilisateurs (nom, prenom, email, username, password, departement, campus, etat) 
        VALUES ('$nom', '$prenom', '$email', '$username', '$password', '$departement', '$campus', '$etat')";

if (mysqli_query($connexion, $sql)) {
    echo "Inscription réussie !";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($connexion);
}

mysqli_close($connexion);
?>