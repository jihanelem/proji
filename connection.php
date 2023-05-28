<?php

$db_host = "localhost";
$db_name = "projet";
$db_user = "root";
$db_pass = "";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);


if(isset($_POST['username']) && isset($_POST['password'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $query = "SELECT * FROM utilisateurs WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        
        header("Location: homepage.html");
        exit;
    } else{
        echo "Nom d'utilisateur ou mot de passe incorrect";
    }
}


mysqli_close($conn);
?>
