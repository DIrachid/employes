<?php include_once 'data.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($_GET['id'])){ echo 'Modifier'; }else{ echo 'Ajouter'; } ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form">
        <?php 
        
        if(empty($_GET['id'])){
            if(isset($_POST['ajouter'])){
                if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['age'])){
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $age = $_POST['age'];
                    $sql = $con->prepare('insert into employe values (null,:nom,:prenom,:age)');
                    $sql->bindParam(':nom',$nom);
                    $sql->bindParam(':prenom',$prenom);
                    $sql->bindParam(':age',$age);
                    $sql->execute();
                    header('location:index.php');
                }else{
                    $message = "Veuillez remplir tous les champs !";
                }
            }
        }else{
            if(isset($_POST['ajouter'])){
                if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['age'])){
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $age = $_POST['age'];
                    $id = $_GET['id'];
                    $sql = $con->prepare('update employe set nom=:nom,prenom=:prenom,age=:age where id = :id');
                    $sql->bindParam(':nom',$nom);
                    $sql->bindParam(':prenom',$prenom);
                    $sql->bindParam(':age',$age);
                    $sql->bindParam(':id',$id);
                    $sql->execute();
                    header('location:index.php');
                }else{
                    $message = "Veuillez remplir tous les champs !";
                }
            }
        }
        ?>
        <a href="index.php" class="back_btn"><img src="icon/back.png" alt=""> Retour</a>
        <h2><?php if(isset($_GET['id'])){echo 'Moddifier';}else{ echo 'Ajouter';} ?> un employé</h2>
        <p class="error_message"> <?php if(isset($message)) echo $message ?> </p>
        <form action="" method="post">
            <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sqlemp = $con->prepare('select * from employe where id = :id');
                $sqlemp->bindParam(':id',$id);
                $sqlemp->execute();
                $emp = $sqlemp->fetch();
            }
            ?>
            <label for="">Nom</label>
            <input type="text" name="nom" value='<?php if(isset($_GET['id'])) echo $emp['nom'] ?>'>
            <label for="">Prénom</label>
            <input type="text" name="prenom"  value='<?php if(isset($_GET['id'])) echo $emp['prenom'] ?>'>
            <label for="">Age</label>
            <input type="number" name="age"  value='<?php if(isset($_GET['id'])) echo $emp['age'] ?>'>
            <input type="submit" value="<?php if(isset($_GET['id'])){echo 'Moddifier';}else{ echo 'Ajouter';} ?>" name="ajouter">
        </form>
    </div>
</body>
</html>