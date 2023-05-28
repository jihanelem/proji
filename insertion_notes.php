<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
   die("Connexion échouée: " . mysqli_connect_error());
}


$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$annee = $_POST['annee'];
$departement = $_POST['departement'];
$campus = $_POST['campus'];
$matiere = $_POST['matiere'];
$note = $_POST['note'];
$note_participation = $_POST['note_participation'];



$sql = "INSERT INTO notes (nom, prenom, annee, departement, campus, matiere, note, note_participation) 
        VALUES ('$nom', '$prenom', '$annee', '$departement', '$campus', '$matiere', '$note_participation')";


if (mysqli_query($conn, $sql)) {
   echo "Note enregistrée avec succès !";
} else {
   echo "Erreur lors de l'enregistrement de la note: " . mysqli_error($conn);
}


mysqli_close($conn);
?>
