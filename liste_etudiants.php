<!DOCTYPE html>
<html>
<head>
<title>Résultats de la recherche</title>
<link rel="stylesheet" type="text/css" href="taux_absence.css">
</head>
<body>
<div class="container">
<h2>Résultats de la recherche</h2>
<?php

$prof = $_POST['prof'];
$matiere = $_POST['matiere'];
$annee = $_POST['annee'];
$campus = $_POST['campus'];
$departement = $_POST['departement'];


$connexion = mysqli_connect("localhost", "root", "", "projet");


if (!$connexion) {
die("Erreur de connexion : " . mysqli_connect_error());
}


$sql = "SELECT nom, prenom FROM etudiants WHERE annee = '$annee' AND campus = '$campus' AND departement = '$departement'";

$resultat = mysqli_query($connexion, $sql);

if (mysqli_num_rows($resultat) > 0) {

echo "<ul>";
while ($ligne = mysqli_fetch_assoc($resultat)) {
echo "<li>" . $ligne['nom'] . " " . $ligne['prenom'] . "</li>";
}
echo "</ul>";
} else {
echo "Aucun étudiant trouvé";
}

mysqli_close($connexion);
?>
<a href="absence.html">Inserer les absences</a>
</div>
</body>
</html>


