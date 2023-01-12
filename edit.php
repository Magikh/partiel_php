<!DOCTYPE html>

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
    if (!empty($_POST)) {
        $query = $db->prepare("UPDATE userlist SET name=:name, firstname=:firstname, age=:age WHERE id=:id");
        $query->bindParam(':id', $_POST['id']);
        $query->bindParam(':name', $_POST['name']);
        $query->bindParam(':firstname', $_POST['firstname']);
        $query->bindParam(':age', $_POST['age']);
        $query->execute();
        $db = null;
        header("Location: index.php");
        return;
    }
    $query = $db->prepare("SELECT * FROM userlist WHERE id=:id");
    $query->bindParam(':id', $_GET['id']);
    $query->execute();
    $user = $query->fetch();
    $db = null;
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
        <h2>Modifier l'employé : <?= $user['name'].' '.$user['firstname']?> </h2>
        <p class="erreur_message">
        </p>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/> <!-- this allow me to send the id in the POST request -->
            <label>Nom</label>
            <input type="text" name="name" value="">
            <label>Prénom</label>
            <input type="text" name="firstname" value="">
            <label>âge</label>
            <input type="number" name="age" value="">
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>

</html>