<?php include_once 'data.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Employés</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a href="ajouter.php" class="btn_add"><img src="icon/plus.png" alt=""> Ajouter</a>
        <table>
            <?php 
            $sql = $con->prepare('select * from employe');
            $sql->execute();
            $row = $sql->rowCount();
            $employes = $sql->fetchAll();
            ?>
            <tr id="items">
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach($employes as $employe){ ?>
            <tr>
                <td><?php echo $employe['nom'] ?></td>
                <td><?php echo $employe['prenom'] ?></td>
                <td><?php echo $employe['age'] ?></td>
                <td><a href="ajouter.php?id=<?php echo $employe['id'] ?>"><img src="icon/modif(1).png" alt=""></a></td>
                <td><a href="delete.php?id=<?php echo $employe['id'] ?>"><img src="icon/R.png" alt=""></a></td>
            </tr>
            <?php }
            if($row < 1){
                ?>  
            <tr>
                <p class="error_info">il n'y a pas encore d'employé ajouter </p>
            </tr>
                <?php
            } ?>
        </table>
    </div>
</body>
</html>