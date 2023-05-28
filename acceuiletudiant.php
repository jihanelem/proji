<?php

$conn = mysqli_connect("localhost", "root", "", "projet");


if (!$conn) {
    die("Connexion échouée: " . mysqli_connect_error());
}


$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$matiere = $_POST['matiere'];
$motif = $_POST['motif'];


$sql = "INSERT INTO justification (nom, prenom, matiere, motif) VALUES ('$nom', '$prenom', '$matiere', '$motif')";


if (mysqli_query($conn, $sql)) {
    echo "Justification enregistrée avec succès";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

