<?php
include('../config/db.php');
include('includes/header.php');
include('includes/styles.php');
include('includes/jquery.php');
include('includes/scripts.php');
    $oldDate = "4/6/2021";
    echo $time = date("Y-m-d",strtotime($oldDate))."<hr>";
    $porciones = explode("/",$oldDate); 
    $oldDate = "$porciones[2]-$porciones[0]-$porciones[1]";
    echo $oldDate."<hr>";
    echo $time = date("Y-m-d",strtotime($oldDate))


?>