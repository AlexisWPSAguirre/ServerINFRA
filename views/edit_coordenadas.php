<?php 
include("../config/db.php"); 
include("includes/header.php");
include('includes/styles.php');
include_once '../config/user_session.php';
$userSession = new UserSession();
if( !isset($_SESSION['user'])){
    header("Location: login.php");
}
if(isset($_POST['editar'])){
    #No habia visto que el post se almacenará con el name del button D:
        $id = $_GET["id"];
        $query = "UPDATE coordenadas SET latitud='".$_POST['latitud']."', longitud='".$_POST['longitud']."',
        latitud_inicial='".$_POST['latitud_inicial']."', latitud_final='".$_POST['latitud_final']."',
        longitud_inicial='".$_POST['longitud_inicial']."', longitud_final='".$_POST['longitud_final']."'
        WHERE id=$id";
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header("Location:list_coordenadas.php?group=".$_SESSION['group_coordenadas']);
    }
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT 
    *
    FROM coordenadas a
    INNER JOIN contrato b ON b.id = a.coo_contrato_fk
    INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
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
                <form action="edit_coordenadas.php?id=<?php echo $_GET['id'];?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Proyecto:</label>
                        <input type="text" name="no_proyecto" class="form-control" value="<?php echo $line['no_proyecto'];?>" disabled>
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">No. contrato</label>
                        <input type="text" name="no_contrato" class="form-control" value="<?php echo $line["no_contrato"];?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Latitud</label>
                        <input type="text" name="latitud" class="form-control" value="<?php echo $line["latitud"];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Longitud</label>
                        <input type="text" name="longitud" class="form-control" value="<?php echo $line["longitud"];?>">
                    </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="editar">
                            EDITAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Latitud Inicial</label>
                            <input type="text" name="latitud_inicial" class="form-control" value="<?php echo $line["latitud_inicial"];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Latitud Final</label>
                            <input type="text" name="latitud_final" class="form-control" value="<?php echo $line["latitud_final"];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Longitud Inicial</label>
                            <input type="date" name="longitud_inicial" class="form-control" value="<?php echo $line["longitud_inicial"];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Longitud Final</label>
                            <input type="date" name="longitud_final" class="form-control" value="<?php echo $line["longitud_final"];?>">
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="list_coordenadas.php?group=<?= $_SESSION['group_coordenadas']?>" class="btn btn-danger">
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