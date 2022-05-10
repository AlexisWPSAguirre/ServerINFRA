<?php 
session_start();
include("../config/db.php"); 
include("includes/header.php");
include('includes/styles.php');
if(isset($_POST['editar'])){
    #No habia visto que el post se almacenará con el name del button D:
        $id = $_GET["id"];
        $query = "UPDATE hitos SET hito='".$_POST['hito']."', detalle_hito='".$_POST['detalle_hito']."',
        valor_adiciones_hito='".$_POST['valor_adiciones_hito']."', dias_hito='".$_POST['dias_hito']."',
        contrato_fk=(SELECT id FROM contrato WHERE no_contrato ='".$_SESSION['no_contrato']."' LIMIT 1), fecha_hito='".$_POST['fecha_hito']."'
        WHERE id=$id";
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header("Location:list_hitos.php?group=".$_SESSION['group_hito']);
    }
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT 
    *
    FROM hitos a
    INNER JOIN contrato b ON b.id = a.contrato_fk
    INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
    WHERE a.id = $id";
    $result = pg_query($query);
    if(!$result) {
        die("Query Failed.");
    }
    while ($line = pg_fetch_assoc($result))
    {
    $_SESSION['no_contrato'] = $line['no_contrato']
?>
<div class="container p-4">
    <div class="card card-body">
        <div class="row">
            <div class="col">
                <form action="edit_hito.php?id=<?php echo $_GET['id'];?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Proyecto:</label>
                        <input type="text" name="no_proyecto" class="form-control" value="<?php echo $line['no_proyecto'];?>" disabled>
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">No. contrato</label>
                        <input type="text" name="no_contrato" class="form-control" value="<?php echo $line["no_contrato"];?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Hito</label>
                        <input type="text" name="hito" class="form-control" value="<?php echo $line["hito"];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Detalle Hito</label>
                        <input type="text" name="detalle_hito" class="form-control" value="<?php echo $line["detalle_hito"];?>">
                    </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="editar">
                            EDITAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Valor Adiciones Hito</label>
                            <input type="text" name="valor_adiciones_hito" class="form-control" value="<?php echo $line["valor_adiciones_hito"];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Dias Hito</label>
                            <input type="text" name="dias_hito" class="form-control" value="<?php echo $line["dias_hito"];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Hito</label>
                            <input type="date" name="fecha_hito" class="form-control" value="<?php echo $line["fecha_hito"];?>">
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="list_hitos.php?group=<?= $_SESSION['group_hito']?>" class="btn btn-danger">
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