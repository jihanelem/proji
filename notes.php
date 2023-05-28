<?php

$serveur = "localhost"; 
$utilisateur = "root"; 
$motdepasse = ""; 
$nom_base_de_donnees = "projet"; 

$conn = new mysqli($serveur, $utilisateur, $motdepasse, $nom_base_de_donnees);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$query = "SELECT a.nom_etudiant, a.prenom_etudiant, a.matiere, a.nombre_heures AS total_absences, n.note ,n.note_participation
          FROM absence a 
          LEFT JOIN notes n ON a.nom_etudiant = n.nom AND a.prenom_etudiant = n.prenom 
          WHERE a.verification != 'oui'
          GROUP BY a.nom_etudiant, a.prenom_etudiant, a.matiere";

$result = mysqli_query($conn, $query);

if (!$result) {
    die('Erreur de requête SQL : ' . mysqli_error($conn));
}

echo '<table>';
echo '<tr><th>Nom</th><th>Prénom</th><th>Matière</th><th>Total absences</th><th>Note</th><th>Note participation</th><th>Possibilités de rachat</th></tr>';

while ($row = $result->fetch_assoc()) {
    $nom = $row["nom_etudiant"];
    $prenom = $row["prenom_etudiant"];
    $matiere = $row["matiere"];
    $total_absences = $row["total_absences"];
    $note = $row["note"];
    $note_participation = $row["note_participation"];


    if ($total_absences >= 72) {
        $note_participation  = 0;
        $rachat = 0;
    } else if ($total_absences >= 40) {
        $note_participation  = 0;
        $rachat = 0;
    } else if ($total_absences >= 20) {
        $note_participation  = $note_participation / 2;
        $rachat = 1;
    } else if ($total_absences >= 6) {
        $note_participation  = 0;
        $rachat = 2;
    } else if ($total_absences >= 3) {
        $note_participation  = 10;
        $rachat = 2;
    } else {
        $rachat = 2;
    }

    $sql = "UPDATE notes SET note_participation = '$note_participation ', rachat = '$rachat' 
    WHERE nom = '$nom' AND prenom = '$prenom' AND matiere = '$matiere'";
    $result_insert = $conn->query($sql);

    if (!$result_insert) {
        die('Erreur de requête SQL : ' . mysqli_error($conn));
    }

    echo "<tr><td>$nom</td><td>$prenom</td><td>$matiere</td><td>$total_absences</td><td>$note/20</td><td>$note_participation /20</td><td>$rachat</td></tr>"; 
}

echo '</table>';

mysqli_close($conn);


?>



echo '<style>
table {
    font-family: Arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  td, th {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }
  
  th {
    background-color:#12275d;
    color: white;
  }
  
  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  
  tr:hover {
    background-color: #ddd;
  }
  </style>';





