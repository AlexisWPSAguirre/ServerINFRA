<?php
    session_start();
    include("../../config/db.php");
    if(isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    $query = "DELETE FROM groups WHERE cod = '$cod'";
    $result = pg_query($query);
    if(!$result) {
    die("Query Failed.");
    } 
    header('Location: ../../views/full-width.php?frame=groups_hitos.php');
    }    
?>