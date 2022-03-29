<?php
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    if(isset($_POST['create'])){
        $query="INSERT INTO proyecto 
        (no_proyecto, proceso, fecha_iniciacion, fecha_terminacion, fecha_liquidacion,
        supervision_interventoria, contratista_fk, objeto) VALUES ('".$_POST['no_proyecto']."','".$_POST['proceso']."','"
        .$_POST['fecha_iniciacion']."','".$_POST['fecha_terminacion']."','".$_POST['fecha_liquidacion']."','"
        .$_POST['supervision']."','".$_POST['contratista']."','".$_POST['objeto']."')";
        print($query);
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header('Location:inicio.php');
    }
?>
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <form action="form_crear.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Proyecto:</label>
                        <input type="text" name="no_proyecto" class="form-control" required>
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Proceso</label>
                        <input type="text" name="proceso" class="form-control" required>
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Objeto</label>
                        <input type="text" name="objeto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fecha Iniciación</label>
                        <input type="date" name="fecha_iniciacion" class="form-control" required>
                    </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="create">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Terminación</label>
                            <input type="date" name="fecha_terminacion" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Liquidación</label>
                            <input type="date" name="fecha_liquidacion" class="form-control" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Supervisión</label>
                            <input type="text" name="supervision" class="form-control" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Contratista</label>
                            <select name="contratista" class="form-select">
                                <option selected>Seleccionar</option>
                            <?php
                                $query = "SELECT * FROM contratista";
                                $result = pg_query($query);
                                while ($line = pg_fetch_row($result)){
                            ?>
                                <option value="<?php echo $line[0]; ?>"><?php echo $line[1];?></option>
                                <?php };?>
                            </select>
                        </div>
                        <div class="mb-3">
                            
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="inicio.php" class="btn btn-danger">
                                CANCELAR
                            </a>
                        </div>
            </div>
            </form>
        </div>
    </div>
</div>