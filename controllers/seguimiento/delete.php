<?php
    include("../../config/db.php");
      if(isset($_GET['id'])) {
      $id = $_GET['id'];
      $query = "DELETE FROM obras WHERE id = $id";
      $result = pg_query($query);
      if(!$result) {
        die("Query Failed.");
      } 
      header('Location: ../../views/list_seguimiento.php?group='.$_SESSION['group_seguimiento']);
      }
?>