<?php
  $hostname = "localhost";
  $db_name = "users";
  $username = "root";
  $password = "root";

  try {
    $db = new PDO("mysql:host=$hostname;dbname=$db_name", $username, $password);
  } catch (Exception $e) {
    echo "Erreur lors de la connexion à la base de données" . $e->getMessage();
    return;
  }

  $query = $db->prepare("DELETE FROM userlist WHERE id=:id");
  $query->bindParam(':id', $_GET['id']);
  $query->execute();
  header("Location: index.php");
?>