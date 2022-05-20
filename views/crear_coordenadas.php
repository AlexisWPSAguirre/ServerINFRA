<?php
    session_start();
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    if(isset($_POST['create'])){
        $query="
        SELECT 
        b.id as pro_id,
        * FROM contrato a
        INNER JOIN proyecto b ON a.no_proyecto_fk = b.id
        WHERE a.id = ".$_POST['coo_contrato_fk']." LIMIT 1";
        $result = pg_query($query);
        $pro_id = $line=pg_fetch_assoc($result);

        $query="INSERT INTO coordenadas 
        (coo_contrato_fk, latitud, longitud, latitud_inicial, latitud_final, longitud_inicial, longitud_final) VALUES (".$_POST['coo_contrato_fk'].",'".$_POST['latitud']."','"
        .$_POST['longitud']."','".$_POST['latitud_inicial']."','".$_POST['latitud_final']."','".$_POST['longitud_inicial']."','".$_POST['longitud_final']."');
        UPDATE proyecto SET group_coordenadas = '".$_SESSION['group_coordenadas']."' WHERE id =".$pro_id['pro_id'];
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        } 
        header('Location: list_coordenadas.php?group='.$_SESSION['group_coordenadas']);
    }
?>
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <form action="crear_coordenadas.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Contrato:</label>
                        <select name="coo_contrato_fk" id="" class="form-select">
                            <?php
                                $query = "SELECT * FROM contrato";
                                $result = pg_query($query);
                                while($line=pg_fetch_assoc($result))
                                {
                            ?>
                            <option value="<?= $line['id']?>"><?= $line['no_contrato'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Latitud</label>
                        <input type="text" name="latitud" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Longitud</label>
                        <input type="text" name="longitud" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Latitud Inicial</label>
                        <input type="text" name="latitud_inicial" class="form-control">
                    </div>
                    
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="create">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Latitud Final</label>
                            <input type="text" name="latitud_final" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Longitud Inicial</label>
                            <input type="text" name="longitud_inicial" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Longitud Final</label>
                            <input type="text" name="longitud_final" class="form-control">
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="list_proyectos.php" class="btn btn-danger">
                                CANCELAR
                            </a>
                        </div>
            </div>
            </form>
        </div>
    </div>
</div>