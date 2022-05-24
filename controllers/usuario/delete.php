<?php
    include("../../config/db.php");
    if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM usuarios WHERE id = $id";
    $result = pg_query($query);
    if(!$result) {
    die("Query Failed.");
    } 
    header('Location: ../../views/login.php');
    }
?>