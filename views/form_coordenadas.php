<?php
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    $query = "SELECT id,no_contrato from contrato";
    $result = pg_query($query);
    
    if(isset($_POST['create'])){
        $query="INSERT INTO coordenadas 
        (coo_contrato_fk,latitud,longitud,latitud_inicial,latitud_final,longitud_inicial,longitud_final)
        VALUES ('".$_POST['no_contrato']."','".$_POST['latitud']."','".$_POST['longitud']."','"
        .$_POST['latitud_inicial']."','".$_POST['latitud_final']."','".$_POST['longitud_inicial']."','"
        .$_POST['longitud_final']."')";
        echo $query;
        /* $result = pg_query($query); */
        if(!$result)
        {
            die("Query Failed.");
        }
    }
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-5">
            <form action="form_coordenadas.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Contrato:</label>
                        <select name="no_contrato" id="" class="form-select">
                            <?php
                                while ($line = pg_fetch_assoc($result)) {
                                echo "<option value='".$line["id"]."'>".$line["no_contrato"]."</option>";}
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Latitud</label>
                        <input type="text" name="latitud" class="form-control" >
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Longitud</label>
                        <input type="text" name="longitud" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Latitud Inicial</label>
                        <input type="text" name="latitud_inicial" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Latitud Final</label>
                        <input type="text" name="latitud_final" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Longitud Inicial</label>
                        <input type="text" name="longitud_inicial" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Longitud Final</label>
                        <input type="text" name="longitud_final" class="form-control" >
                    </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="create">
                            GUARDAR
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
    