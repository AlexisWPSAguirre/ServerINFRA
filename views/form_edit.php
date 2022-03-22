<style>
    .abs-center {
    display: flex;
    align-items: center;
    justify-content: center;
        /* Arreglar el enlace de estilos  */
}
</style>
<?php 
include("../config/db.php"); 
include("includes/header.php");
include('includes/styles.php');
if(isset($_POST['update'])){
    #No habia visto que el post se almacenará con el name del button D:
        $id = $_GET["id"];
        echo $_POST["no_proyecto"];   
        echo $_POST["proceso"];
        echo $_POST["fecha_iniciacion"];
        echo $_POST["fecha_terminacion"];
        echo $_POST["fecha_liquidacion"];
        echo $_POST["supervision"];
        echo $_POST["nombre"];
        echo $_POST["nit"];
        $query = "UPDATE proyecto SET no_proyecto='".$_POST['no_proyecto']."', proceso='".$_POST['proceso']."',
        fecha_iniciacion='".$_POST['fecha_iniciacion']."', fecha_terminacion='".$_POST['fecha_terminacion']."',
        fecha_liquidacion='".$_POST['fecha_liquidacion']."', supervision_interventoria='".$_POST['supervision']."'
        WHERE id=$id";
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header('Location: ../index.php');
    }
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM proyecto WHERE id = $id";
    $result = pg_query($query);
    if(!$result) {
        die("Query Failed.");
    }
    while ($line = pg_fetch_row($result))
    {
?>
<div class="container p-4">
    <div class="card card-body">
        <div class="row">
            <div class="col">
                <form action="form_edit.php?id=<?php echo $_GET['id'];?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Proyecto:</label>
                        <input type="text" name="no_proyecto" class="form-control" autofocus value="<?php echo $line[1];?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Proceso</label>
                        <input type="text" name="proceso" class="form-control" autofocus value="<?php echo $line[2];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fecha Iniciación</label>
                        <input type="date" name="fecha_iniciacion" class="form-control" autofocus value="<?php echo $line[3];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fecha Terminación</label>
                        <input type="date" name="fecha_terminacion" class="form-control" autofocus value="<?php echo $line[4];?>">
                    </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="update">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Liquidación</label>
                            <input type="date" name="fecha_liquidacion" class="form-control" autofocus value="<?php echo $line[5];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Supervisión</label>
                            <input type="text" name="supervision" class="form-control" autofocus value="<?php echo $line[6];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" autofocus value="<?php echo $line[7];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">NIT</label>
                            <input type="text" name="nit" class="form-control" autofocus value="<?php echo $line[8];?>">
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="../index.php" class="btn btn-danger">
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