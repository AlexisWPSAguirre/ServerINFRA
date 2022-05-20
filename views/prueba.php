<?php
include('../config/db.php');
include('includes/header.php');
include('includes/styles.php');
include('includes/jquery.php');
include('includes/scripts.php');

$query = "
    SELECT * 
    FROM coordenadas a
    INNER JOIN contrato b ON b.id = a.coo_contrato_fk
    INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
    WHERE c.group_coordenadas is not null
    ";
    $result = pg_query($query);
    while($row = pg_fetch_array($result)){
        foreach ($row as $key) {
            print($key."---");
        }
        echo "<hr>";
    };
?>