<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exo complet lecture SQL.</title>
</head>
<body>
<?php
try {
    $server ="localhost";
    $db = "exo_197";
    $user = 'root';
    $pass = '';
    echo 'Voici la liste de tous les clients: <br><br>';
    $bdd = new PDO ("mysql:host=$server;dbname=$db;charset=utf8", $user, $pass);

    $stmt = $bdd->prepare("SELECT id, lastName, firstName from clients");

    $state = $stmt->execute();

    if($state) {
        foreach ($stmt->fetchAll() as $user) {
            echo 'Clients :' . $user['id'] . '---> ' . $user['lastName'] . $user['firstName'] . "<br>";
        }
    }
    echo '<br><br>';

    echo 'Voici la liste des spectacles disponibles: <br><br>';
    $stmt2 = $bdd->prepare("SELECT id, title, performer, date, duration, startTime from shows");

    $state2 = $stmt2->execute();

    if($state2) {
        foreach ($stmt2->fetchAll() as $show) {
            echo 'Spectacles :' . $show['id'] . '---> ' . $show['title'] . ' ' . $show['performer'] . ' '. $show['date'] .
                ' '. $show['duration'] . ' ' . $show['startTime']  . "<br>";
        }
    }

    echo '<br><br>';

    echo 'Voici la liste des 20 premiers clients: <br><br>';
    $stmt = $bdd->prepare("SELECT * from clients WHERE id < 21");

    $state = $stmt->execute();

    if($state) {
        foreach ($stmt->fetchAll() as $user) {
            echo 'Clients :' . $user['id'] . '---> ' . $user['lastName'] . $user['firstName'] . "<br>";
        }
    }

    echo '<br><br>';

    echo 'Clients possédant une carte de fidélité: <br><br>';
    $stmt = $bdd->prepare("SELECT * from clients WHERE card = 1");

    $state = $stmt->execute();

    if($state) {
        foreach ($stmt->fetchAll() as $user) {
            echo 'Clients :' . $user['id'] . '---> ' . $user['lastName'] . $user['firstName'] . "<br>";
        }
    }

    echo '<br><br>';

    echo 'Clients dont le nom commence par un "M" <br><br>';

    $stmt = $bdd->prepare("SELECT * from clients WHERE lastName LIKE 'M%'");

    $state = $stmt->execute();

    if($state) {
        foreach ($stmt->fetchAll() as $user) {
            echo "<div>Nom: " . $user['lastName'] . "</div>" . "<div>Prenom: " . $user['firstName'] . "<div>" . '<br>';
        }
    }

    echo '<br><br>';

    echo 'Liste de tous les spectacles Artiste, date et heure par ordre alphabétiques<br><br>';

    $stmt2 = $bdd->prepare("SELECT id, title, performer, date, startTime from shows ORDER BY title ASC");

    $state2 = $stmt2->execute();

    if($state2) {
        foreach ($stmt2->fetchAll() as $show) {
            echo 'Spectacles :' . $show['title'] . ' par ' . $show['performer'] . ' le '. $show['date'] .
                ' à '. $show['startTime']  . "<br>";
        }
    }

    echo 'Clients dont le nom commence par un "M" <br><br>';

    $stmt = $bdd->prepare("SELECT * from clients");

    $state = $stmt->execute();

    if($state) {
        foreach ($stmt->fetchAll() as $user) {
            echo "<div>Nom: " . $user['lastName'] . "<div>Prenom: " . $user['firstName'] . "<div>" .
                "<div>Date de naissance: " . $user['birthDate'] . "<br>";

                if ($user['card'] === 1) {
                    echo "Carte de fidélité: Oui,  carte numéro" .' ' . $user['cardNumber'] . "<br><br>";
                    
                } else {
                    echo 'Carte de fidélité: Non<br><br>';
                }
        }
    }

}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>

</body>
</html>
