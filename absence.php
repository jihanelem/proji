<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "projet";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$nom_etudiant = $_POST["nom_etudiant"];
$prenom_etudiant = $_POST["prenom_etudiant"];
$annee = $_POST["annee"];
$campus = $_POST["campus"];
$datee = $_POST["datee"];
$matiere = $_POST["matiere"];
$departement = $_POST["departement"];
$statut = $_POST["statut"];
$nombre_heures = $_POST["nombre_heures"];


$sql = "INSERT INTO absence (nom_etudiant, prenom_etudiant, annee, campus, datee, matiere, departement,  statut, nombre_heures ) 
        VALUES ('$nom_etudiant', '$prenom_etudiant', '$annee', '$campus', '$datee', '$matiere', '$departement',  '$statut', '$nombre_heures' )";

if (mysqli_query($connexion, $sql)) {
    echo "Inscription réussie !";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($connexion);
}

mysqli_close($connexion);
?>