<!DOCTYPE html>
<html>
<head>
    <title>Bulletin de notes</title>
    <style>
        
h1 {
  font-size: 2.5em;
  text-align: center;
  color: #333;
}


h2 {
  font-size: 1.5em;
  text-align: center;
  color: #666;
}


table {
  margin: 0 auto;
  border-collapse: collapse;
  border: 1px solid #999;
}

th, td {
  padding: 10px;
  text-align: center;
  border: 1px solid #999;
}

th {
  background-color: #eee;
  color: #333;
}


.resultat {
  text-align: center;
  margin-top: 30px;
}

.moyenne {
  font-size: 1.2em;
  color: #666;
}

.mention {
  font-size: 1.5em;
  font-weight: bold;
  color: #333;
}


body {
  background-color: #f7f7f7;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

    </style>
</head>
<body>
    <?php 
   
   $serveur = "localhost"; 
   $utilisateur = "root"; 
   $motdepasse = ""; 
   $nom_base_de_donnees = "projet"; 
   

   $conn = new mysqli($serveur, $utilisateur, $motdepasse, $nom_base_de_donnees);
   

   if ($conn->connect_error) {
       die("La connexion a échoué : " . $conn->connect_error);
   }
   

   $nom = $_POST["nom"];
   $prenom = $_POST["prenom"];
   $annee = $_POST["annee"];
   $campus = $_POST["campus"];
   $departement = $_POST["departement"];
   

   $query = "SELECT matiere, note , note_participation FROM notes WHERE nom='$nom' AND prenom='$prenom'";
   
   $result = mysqli_query($conn, $query);
   
   if (!$result) {
       die('Erreur de requête SQL : ' . mysqli_error($conn));
   }
   
  
   echo "<h1>Bulletin de notes de $prenom $nom</h1>";
   echo "<h2>Année : $annee</h2>";
   echo "<h2>Campus : $campus</h2>";
   echo "<h2>Département : $departement</h2>";
   
 
   echo '<table>';
   echo '<tr><th>Matière</th><th>Note</th><th>Note participation</th></tr>';
   while ($row = $result->fetch_assoc()) {
       $matiere = $row["matiere"];
       $note = $row["note"];
       $note_participation = $row["note_participation"];

   
       echo "<tr><td>$matiere</td><td>$note/20</td><td>$note_participation/20</td></tr>";
   }
   echo '</table>';
   
   
   $query = "SELECT ((AVG(note) * 0.8) + (note_participation * 0.2)) AS moyenne 
   FROM notes 
   WHERE nom='$nom' AND prenom='$prenom'";
   $result = mysqli_query($conn, $query);
   $row = $result->fetch_assoc();
   $moyenne = $row["moyenne"];
   
  
   echo "<h2>Moyenne générale : $moyenne/20</h2>";
   
   
   if ($moyenne >= 16) {
       $mention = "Très bien";
   } else if ($moyenne >= 14) {
       $mention = "Bien";
   } else if ($moyenne >= 12) {
       $mention = "Assez bien";
   } else if ($moyenne >= 10) {
       $mention = "Passable";
   } else {
       $mention = "Insuffisant";
   }

  
   echo "<h2>Mention : $mention</h2>";
   
   $conn->close();
    ?>
</body>
</html>


