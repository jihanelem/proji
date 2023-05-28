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
                <th>Statut</th>
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
                        echo "<td>" . $row["nombre_heures"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Aucune absence enregistrée";
                }

            
                mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>
</body>
</html>