<!DOCTYPE html>
<html>
<head>
<title>Liste des absences</title>
<link rel="stylesheet" type="text/css" href="reacap.css">
</head>
<body>
<header>
<h1>Liste des absences</h1>
</header>
<div class="container">
<table>
<thead>
<tr>
<th>Nom</th>
<th>Prénom</th>
<th>Matière</th>
<th>Année</th>
<th>Absent</th>
<th>justif</th>
<th>Valide</th>
</tr>
</thead>
<tbody>
<?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "projet");

// Vérification de la connexion
if (!$conn) {
   die("Connexion échouée: " . mysqli_connect_error());
}


$sql = "SELECT * FROM absence";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
       echo "<tr>";
       echo "<td>" . $row["nom_etudiant"] . "</td>";
       echo "<td>" . $row["prenom_etudiant"] . "</td>";
       echo "<td>" . $row["matiere"] . "</td>";
       echo "<td>" . $row["annee"] . "</td>";
       echo "<td>" . $row["statut"] . "</td>";
       echo "<td>" . $row["justif"] . "</td>";
       echo "<td>" . $row["nombre_heures"] . "</td>";
       echo "<td>";
       echo "<form method='post' action=''>";
       echo "<input type='hidden' name='nom_etudiant' value='" . $row["nom_etudiant"] . "'>";
       echo "<input type='submit' name='valide' value='Oui'>";
       echo "<input type='submit' name='non_valide' value='Non'>";
       echo "</form>";
       echo "</td>";
       echo "</tr>";
   }
} else {
   echo "Aucune absence enregistrée";
}

// Vérification de la validation de l'absence
if (isset($_POST['valide']) || isset($_POST['non_valide'])) {
$nom_etudiant = $_POST['nom_etudiant'];
$valide = (isset($_POST['valide'])) ? "oui" : "non";

$sql_update = "UPDATE absence SET verification = '$valide' WHERE nom_etudiant = '$nom_etudiant'";
if (mysqli_query($conn, $sql_update)) {
echo "Mise à jour effectuée avec succès";
} else {
echo "Erreur lors de la mise à jour: " . mysqli_error($conn);
}
}

// Fermeture de la connexion