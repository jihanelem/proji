<?php

$dsn = "mysql:host=localhost;dbname=projet;charset=utf8";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}


if (isset($_POST['dateDebut']) && isset($_POST['dateFin']) && isset($_POST['nom_etudiant'])) {
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];
    $nom_etudiant = $_POST['nom_etudiant'];

   
    $sql = "SELECT COUNT(*) AS total_heures_absentes
            FROM absence
            WHERE nom_etudiant = :nom_etudiant
                AND datee >= :dateDebut
                AND datee <= :dateFin";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nom_etudiant', $nom_etudiant);
    $stmt->bindValue(':dateDebut', $dateDebut);
    $stmt->bindValue(':dateFin', $dateFin);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    echo "<h2>Récapitulatif des absences</h2>";
    echo "<p>L'étudiant $nom_etudiant a été absent pendant ".$result['total_heures_absentes']." heure(s) entre les dates $dateDebut et $dateFin.</p>";
}
?>

