<?php


$serveur = "localhost"; 
$utilisateur = "root"; 
$motdepasse = ""; 
$nom_base_de_donnees = "projet"; 

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $nom_base_de_donnees);


if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}


$sql = "SELECT nom_etudiant, prenom_etudiant, SUM(nombre_heures) AS total_absences FROM absence GROUP BY nom_etudiant, prenom_etudiant";
$resultat = $connexion->query($sql);


while ($row = $resultat->fetch_assoc()) {
    $nom = $row["nom_etudiant"];
    $prenom = $row["prenom_etudiant"];
    $total_absences = $row["total_absences"];

    if ($total_absences >= 72) {
        echo "L'étudiant $nom $prenom est déclaré redoublant.";
    } else if ($total_absences >= 40) {
        echo "L'étudiant $nom $prenom perd les deux possibilités de rachat ainsi que la mention.";
    } else if ($total_absences >= 20) {
        echo "L'étudiant $nom $prenom perd une des deux possibilités de rachat à la fin de l'année.";
    } else if ($total_absences >= 6) {
        echo "La note moyenne de l'étudiant $nom $prenom dans ce cours est de 00/20.";
    } else if ($total_absences >= 3) {
        echo "La note de participation de l'étudiant $nom $prenom dans ce cours est de 10/20.";
    } else {
        echo "L'étudiant $nom $prenom a un nombre d'absences acceptable.";
    }
}

$connexion->close();

?>
