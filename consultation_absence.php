<!DOCTYPE html>
<html>
<head>
    <title>Consulter mes absences</title>
    <link rel="stylesheet" type="text/css" href="acceuiladmin.css">
</head>
<body>
    <h2>Mes absences</h2>
    <?php
        
        $dsn = "mysql:host=localhost;dbname=projet;charset=utf8";
        $username = "root";
        $password = "";

        try {
            $pdo = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }

        
        $etudiant = "Nom de l'étudiant"; 
        $sql = "SELECT a.nom, a.nombre_heures,
                FROM absence AS a
                INNER JOIN matiere AS m ON a.matiere = m.nom
                WHERE a.nom = :etudiant";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':etudiant', $etudiant);
        $stmt->execute();
        $absences = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($absences) > 0) {
            echo "<table>
                    <tr>
                        <th>Matière</th>
                        <th>Volume horaire</th>
                        <th>Heures absentes</th>
                        <th>Justifiée</th>
                    </tr>";
            foreach ($absences as $absence) {
                $matiere = $absence['nom'];
                $V_H = $absence['V_H'];
                $heures_absentes = $absence['nombre_heures'];
                $justifiee = ($heures_absentes == 0) ? "Oui" : "Non";

                echo "<tr>
                        <td>$matiere</td>
                        <td>$V_H</td>
                        <td>$heures_absentes</td>
                        <td>$justifiee</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "Aucune absence enregistrée.";
        }
    ?>
</body>
</html>