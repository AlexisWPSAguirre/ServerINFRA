<?php
    include("../../config/db.php");
      if(isset($_GET['id'])) {
      $id = $_GET['id'];
      $query = "DELETE FROM proyecto WHERE id = $id";
      $result = pg_query($query);
      if(!$result) {
        die("Query Failed.");
      } 
      header('Location: ../../views/inicio.php');
      }
      /* $_SESSION['message'] = 'Task Removed Successfully';
      $_SESSION['message_type'] = 'danger';  */
?>