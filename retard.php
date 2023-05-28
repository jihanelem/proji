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
$prenom= $_POST["prenom"];
$annee = $_POST["annee"];
$campus = $_POST["campus"];
$datee = $_POST["datee"];
$matiere = $_POST["matiere"];
$departement = $_POST["departement"];
$retard= $_POST["retard"];

$sql = "INSERT INTO retard (nom, prenom , annee, campus, datee, matiere, departement, retard) 
        VALUES ('$nom', '$prenom', '$annee', '$campus', '$datee', '$matiere', '$departement',  '$retard')";
if (mysqli_query($connexion, $sql)) {
    echo "Inscription réussie !";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($connexion);
}

mysqli_close($connexion);
?>