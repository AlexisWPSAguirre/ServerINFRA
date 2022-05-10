<?php
    session_start();
    include("../../config/db.php");
      if(isset($_GET['id'])) {
      $id = $_GET['id'];
      $query = "DELETE FROM coordenadas WHERE id = $id";
      $result = pg_query($query);
      if(!$result) {
        die("Query Failed.");
      } 
      header('Location: ../../views/list_coordenadas.php?group='.$_SESSION['group_coordenadas']);
      }
      
?>