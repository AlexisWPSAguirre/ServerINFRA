<?php
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    $query = "SELECT id,no_contrato from contrato";
    $result = pg_query($query);
    if(isset($_POST['create'])){
        $query="INSERT INTO hitos
        (contrato_fk,hito,detalle_hito,fecha_hito,valor_adiciones_hito,dias_hito)
        VALUES ('".$_POST['no_contrato']."','".$_POST['hito']."','".$_POST['detalle_hito']."','"
        .$_POST['fecha_hito']."','".$_POST['valor_adiciones_hito']."',".$_POST['dias_hito'].")";
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
            <form action="" method="POST">
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
                        <label for="" class="form-label">Hito</label>
                        <input type="text" name="hito" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Detalle Hito</label>
                        <input type="text" name="detalle_hito" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fecha Hito</label>
                        <input type="date" name="fecha_hito" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Valor Adiciones Hito</label>
                        <input type="text" name="valor_adiciones_hito" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Dias Hito</label>
                        <input type="text" name="dias_hito" class="form-control">
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
    