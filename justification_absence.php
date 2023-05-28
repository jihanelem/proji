<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_POST['nom_etudiant']) && isset($_POST['prenom_etudiant']) && isset($_POST['matiere'])) {
        $nom = $_POST['nom_etudiant'];
        $prenom = $_POST['prenom_etudiant'];
        $matiere = $_POST['matiere'];
        $justification = isset($_POST['justif']) ? $_POST['justif'] : '';
        $commentaires = isset($_POST['commentaires']) ? $_POST['commentaires'] : '';
        echo"$justification";
        echo"$commentaires";
        $sql = "SELECT * FROM absence WHERE nom_etudiant = ? AND prenom_etudiant = ? AND matiere = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nom, $prenom, $matiere]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $sql = "UPDATE absence SET justif = ?, commentaires = ? WHERE nom_etudiant = ? AND prenom_etudiant = ? AND matiere = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$justification, $commentaires, $nom, $prenom, $matiere]);
            echo "La justification a été enregistrée avec succès !";
        } 
    }
    echo "La justification a été enregistrée avec succès !";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
$conn = null;
?>
