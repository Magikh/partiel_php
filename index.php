<!DOCTYPE html>

<?php
function printUsers()
{
	$hostname = "localhost";
	$db_name = "users";
	$username = "root";
	$password = "root";
	try {
        $db = new PDO("mysql:host=$hostname;dbname=$db_name", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        echo "Erreur lors de la connexion à la base de données" . $e->getMessage();
        return;
    }
    $query = $db->prepare("SELECT * FROM userlist");
    $query	->execute();
	$list_users = $query->fetchAll();

	foreach ($list_users as $i => $user) {
		echo "<tr>\n";
		echo "<td>".$user['name']."</td>";
		echo "<td>".$user['firstname']."</td>";
		echo "<td>".$user['age']."</td>";
		echo "<td>"."<a href=./edit.php?id=".$user['id'].">EDIT</a>"."</td>";
		echo "<td>"."<a href=./delete.php?id=".$user['id'].">DELETE</a>"."</td>";
		echo "</tr>\n";
	}

	$db = null;
	return;
}
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gestion Utilisateurs</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="container">
		<a href="add.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>
		<table>
			<thead>
				<tr id="items">
					<th>Nom</th>
					<th>Prénom</th>
					<th>Age</th>
					<th>Modifier</th>
					<th>Supprimer</th>
				</tr>
			</thead>
			<tbody>
				<?php printUsers(); ?>
			</tbody>
		</table>
	</div>
</body>

</html>