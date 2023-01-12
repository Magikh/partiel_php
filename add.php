<!DOCTYPE html>

<?php
if (!empty($_POST)) {
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
	if (!filter_var($_POST['age'], FILTER_VALIDATE_INT) && $_POST['age'] > 0) {
		echo "age is not a valid positive int";
	}

	$query = $db->prepare("INSERT INTO userlist (name, firstname, age) VALUES (:name, :firstname, :age)");
	$query->bindParam(':name', $_POST['name']);
	$query->bindParam(':firstname', $_POST['firstname']);
	$query->bindParam(':age', $_POST['age']);
	$query->execute();
	$db = null;
}
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ajouter</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="form">
		<a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
		<h2>Ajouter un utilisateur</h2>
		<p class="erreur_message">
		</p>
		<form action="" method="POST">
			<label>Nom</label>
			<input type="text" name="name">
			<label>Prénom</label>
			<input type="text" name="firstname">
			<label>âge</label>
			<input type="number" name="age">
			<input type="submit" value="Ajouter" name="button">
		</form>
	</div>
</body>

</html>