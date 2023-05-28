<!DOCTYPE html>
<html>
<head>
    <title>Liste des étudiants</title>
    <link rel="stylesheet" type="text/css" href="liste_etudiant.css">
</head>
<body>
    <div class="container">
        <h1>Liste des étudiants</h1>
        <form method="post" action="liste_etudiants.php">
            <label for="prof">Nom du professeur :</label>
            <input type="text" name="prof" id="prof">

            <label for="matiere">Matière :</label>
            <input type="text" name="matiere" id="matiere">

            <label for="annee">Année :</label>
            <input type="text" name="annee" id="annee">

            <label for="campus">Campus :</label>
            <input type="text" name="campus" id="campus">

            <label for="filiere">Filière :</label>
            <input type="text" name="filiere" id="filiere">

            <input type="submit" value="Rechercher">
        </form>

        <?php
            // Connexion à la base de données
            $host = 'localhost';
            $dbname = 'projet';
            $username = 'root';
            $password = '';

            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            // Récupération des données du formulaire
            if(isset($_POST['nom']) && isset($_POST['matiere']) && isset($_POST['annee']) && isset($_POST['campus']) && isset($_POST['departement'])) {
                $nom = $_POST['nom'];
                $matiere = $_POST['matiere'];
                $annee = $_POST['annee'];
                $campus = $_POST['campus'];
                $departement = $_POST['departement'];

                
                $query = "SELECT nom, prenom FROM etudiants WHERE annee = :annee AND campus = :campus AND departement = :departement";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':annee', $annee);
                $stmt->bindParam(':campus', $campus);
                $stmt->bindParam(':departement', $departement);
                $stmt->execute();

                
                echo '<h2>Résultats :</h2>';
                echo '<ul>';
                while ($row = $stmt->fetch()) {
                    echo '<li>'.$row['nom'].' '.$row['prenom'].'</li>';
                }
                echo '</ul>';
            }
        ?>
    </div>
</body>
</html>

