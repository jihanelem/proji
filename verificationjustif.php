<!DOCTYPE html>
<html>
<head>
<title>Liste des absences</title>
<style>
table {
border-collapse: collapse;
width: 100%;
}
th, td {
padding: 8px;
text-align: left;
border-bottom: 1px solid #ddd;
}
th {
background-color: #12275d;
color: white;
}
tr:hover {
background-color:#f5f5f5;
}
</style>
</head>
<body>
<h1>Liste des absences</h1>
<table>
<thead>
<tr>
<th>Nom</th>
<th>Prénom</th>
<th>Matière</th>
<th>Année</th>
<th>Absent</th>
<th>Justification</th>
<th>Valide</th>
</tr>
</thead>
<tbody>
<?php

$conn = mysqli_connect("localhost", "root", "", "projet");


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
       if($row["verification"] == "oui") {
        echo "Oui";
       } else {
        echo "Non";
       }
       echo "</td>";
       echo "</tr>";
   }
} else {
   echo "<tr><td colspan='8'>Aucune absence enregistrée</td></tr>";
}


mysqli_close($conn);
?>
</tbody>
</table>
</body>
</html>

