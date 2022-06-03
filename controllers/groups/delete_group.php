<?php
    session_start();
    include("../../config/db.php");
    if(isset($_GET['cod'])) {
        switch ($_GET['gr_sel']) {
            case 'hito':
                $query = "UPDATE proyecto SET group_hito_fk = 'H1' WHERE group_hito_fk ='".$_GET['cod']."'";
                $result = pg_query($query); 
                $query = "DELETE FROM groups WHERE cod = '".$_GET['cod']."'";
                $result = pg_query($query); 
                header('Location: ../../views/full-width.php?frame=groups_hitos.php');
                break;
            case 'coordenada':
                $query = "UPDATE proyecto SET group_coordenadas_fk = 'C1' WHERE group_coordenadas_fk ='".$_GET['cod']."'";
                $result = pg_query($query); 
                $query = "DELETE FROM groups WHERE cod = '".$_GET['cod']."'";
                $result = pg_query($query); 
                header('Location: ../../views/full-width.php?frame=groups_coordenadas.php');
                break;
            case 'seguimiento':
                $query = "UPDATE proyecto SET group_seguimiento_fk = 'S1' WHERE group_seguimiento_fk ='".$_GET['cod']."'";
                $result = pg_query($query); 
                $query = "DELETE FROM groups WHERE cod = '".$_GET['cod']."'";
                $result = pg_query($query); 
                header('Location: ../../views/full-width.php?frame=groups_seguimiento.php');
                break;
    }
}     
?>