<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "projet";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$nom_prof = $_POST["nom_prof"];
$prenom_prof = $_POST["prenom_prof"];
$annee = $_POST["annee"];
$campus = $_POST["campus"];
$matiere = $_POST["matiere"];
$departement = $_POST["departement"];


$sql = "INSERT INTO matiere (matiere, nom_prof,prenom_prof, annee, campus,  departement ) 
        VALUES ('$matiere','$nom_prof', '$prenom_prof', '$annee', '$campus',  '$departement' )";

if (mysqli_query($connexion, $sql)) {
    echo "Inscription réussie !";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($connexion);
}

mysqli_close($connexion);
?>