<?php

$host = 'localhost'; 
$dbname = 'projet'; 
$username = 'root'; 
$password = ''; 


try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die('Erreur lors de la connexion à la base de données : ' . $e->getMessage());
}
?>