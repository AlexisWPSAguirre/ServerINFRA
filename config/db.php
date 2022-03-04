<?php 
    $dbconn = pg_connect('host=localhost dbname=inf_contra user=postgres password=2023') or die ('No se ha podido conectar '. preg_last_error());
    
?>