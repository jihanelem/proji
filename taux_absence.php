<?php
// Connexion à la base de données
$dsn = "mysql:host=localhost;dbname=projet;charset=utf8";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

// Calcul du taux d'absentéisme par matière
$sqlMatiere = "SELECT matiere, SUM(nombre_heures) AS total_heures_absentes
               FROM absence
               GROUP BY matiere";
$stmtMatiere = $pdo->query($sqlMatiere);
$resultMatiere = $stmtMatiere->fetchAll(PDO::FETCH_ASSOC);

// Calcul du taux d'absentéisme par promotion
$sqlPromotion = "SELECT annee, SUM(nombre_heures) AS total_heures_absentes
                 FROM absence
                 GROUP BY annee";
$stmtPromotion = $pdo->query($sqlPromotion);
$resultPromotion = $stmtPromotion->fetchAll(PDO::FETCH_ASSOC);

// Calcul du taux d'absentéisme sur l'établissement
$sqlEtablissement = "SELECT SUM(nombre_heures) AS total_heures_absentes
                     FROM absence
                     GROUP BY campus";
$stmtEtablissement = $pdo->query($sqlEtablissement);
$resultEtablissement = $stmtEtablissement->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Calcul des taux d'absentéisme</title>
    <link rel="stylesheet" type="text/css" href="taux_absence.css">
</head>
<body>
    <div class="container">
        <h2>Calcul des taux d'absentéisme</h2>

        <h3>Taux d'absentéisme par matière :</h3>
        <table>
            <tr>
                <th>Matière</th>
                <th>Total heures absentes</th>
            </tr>
            <?php foreach ($resultMatiere as $rowMatiere): ?>
                <tr>
                    <td><?php echo $rowMatiere['matiere']; ?></td>
                    <td><?php echo $rowMatiere['total_heures_absentes']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h3>Taux d'absentéisme par promotion :</h3>
        <table>
            <tr>
                <th>Année</th>
                <th>Total heures absentes</th>
            </tr>
            <?php foreach ($resultPromotion as $rowPromotion): ?>
                <tr>
                    <td><?php echo $rowPromotion['annee']; ?></td>
                    <td><?php echo $rowPromotion['total_heures_absentes']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h3>Taux d'absentéisme sur l'établissement :</h3>
        <p>Total heures absentes : <?php echo $resultEtablissement['total_heures_absentes']; ?></p>
    </div>
</body>
</html>