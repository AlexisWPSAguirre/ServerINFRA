<?php 
session_start();
include("../config/db.php"); 
include("includes/header.php");
include('includes/styles.php');
if(isset($_POST['crear'])){
    #No habia visto que el post se almacenará con el name del button D:
        $id = $_GET["id"];
        $query = "INSERT INTO hitos(hito,detalle_hito,valor_adiciones_hito,dias_hito,contrato_fk,fecha_hito)
        VALUES('".$_POST['hito']."','".$_POST['detalle_hito']."','".$_POST['valor_adiciones_hito']."',
        '".$_POST['dias_hito']."',".$id.",'".$_POST['fecha_hito']."');
        UPDATE proyecto SET group_hito = '".$_GET['group']."' WHERE id =".$_GET['pro_id'];
        pg_query($query);
        header('Location:groups_hitos.php');
    }
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT 
    *
    FROM contrato a
    INNER JOIN proyecto b ON b.id = a.no_proyecto_fk
    WHERE a.id = $id";
    $result = pg_query($query);
    if(!$result) {
        die("Query Failed.");
    }
    while ($line = pg_fetch_assoc($result))
    {
?>
<div class="container p-4">
    <div class="card card-body">
        <div class="row">
            <div class="col">
                <form action="crear_hito.php?id=<?php echo $_GET['id'];?>&group=<?= $_SESSION['group_hito']?>&pro_id=<?php echo $_GET['pro_id']?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Proyecto:</label>
                        <input type="text" name="no_proyecto" class="form-control" value="<?php echo $line['no_proyecto'];?>" disabled>
                        <input type="text" value="<?= $_SESSION['group_hito'] ?>" disabled>
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">No. contrato</label>
                        <input type="text" name="no_contrato" class="form-control" value="<?php echo $line["no_contrato"];?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Hito</label>
                        <input type="text" name="hito" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Detalle Hito</label>
                        <input type="text" name="detalle_hito" class="form-control">
                    </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="crear">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Valor Adiciones Hito</label>
                            <input type="text" name="valor_adiciones_hito" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Dias Hito</label>
                            <input type="text" name="dias_hito" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Hito</label>
                            <input type="date" name="fecha_hito" class="form-control">
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="list_hitos.php?group=<?= $_SESSION['group_hito'] ?>" class="btn btn-danger">
                                CANCELAR
                            </a>
                        </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
<?php
    }}
?>
<?php include('includes/footer.php');?>