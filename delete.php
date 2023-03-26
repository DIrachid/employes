<?php
require_once 'data.php';
$id = $_GET['id'];
$sql = $con->prepare('delete from employe where id=:id');
$sql->bindParam(':id',$id);
$sql->execute();
header('location: index.php');