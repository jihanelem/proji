<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulaire";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}
if(isset($_POST["Login"])) {
  $nom_utilisateur = $_POST["nom"];
  $mot_de_passe= $_POST["password"];
  
  $sql = "SELECT * FROM utilisateur WHERE nom_utilisateur = '$nom_utilisateur' AND mot_de_passe = '$mot_de_passe'";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {

      header("Location: biblio.html");
  } else {
      echo "nom d'utilisateur  ou mot de passe invalide.";
  }
}
// Récupérer l'identifiant de l'enregistrement à supprimer
$nom_utilisateur = $_GET['nom'];

// Vérifier si l'utilisateur a confirmé la suppression
if (isset($_POST['confirm']) && $_POST['confirm'] == 'oui') {


  $sql = "DELETE FROM utilisateur WHERE id = $nom_utilisateur";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    echo "L'enregistrement a été supprimé avec succès.";
  } else {
    echo "Erreur lors de la suppression de l'enregistrement: " . mysqli_error($conn);
  }

} else {

  echo "Êtes-vous sûr de vouloir supprimer cet enregistrement?";
  echo "<form method='POST'>";
  echo "<input type='submit' name='confirm' value='oui'>";
  echo "<input type='submit' name='confirm' value='non'>";
  echo "</form>";

}

?>

