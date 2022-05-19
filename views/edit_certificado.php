<?php 
include("../config/db.php"); 
include("includes/header.php");
include('includes/styles.php');
if(isset($_POST['update'])){
        $id = $_GET["id"];
        $query = "UPDATE certificado_disponibilidad SET rubro='".$_POST['rubro']."', valor='".$_POST['valor']."', fuente_recursos='".$_POST['fuente_recursos']."',
        anticipo='".$_POST['anticipo']."'
        WHERE id=$id";
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header('Location:list_certificado.php');
    }
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT 
    *
    FROM certificado_disponibilidad a
    INNER JOIN contrato b ON a.contrato_fk = b.id
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
                <form action="edit_certificado.php?id=<?php echo $_GET['id'];?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Contrato</label>
                        <input type="text" name="no_contrato" class="form-control" disabled value="<?php echo $line['no_contrato'];?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Rubro</label>
                        <input type="text" name="rubro" class="form-control" autofocus value="<?php echo $line['rubro'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Valor</label>
                        <input type="text" name="valor" class="form-control" autofocus value="<?php echo $line['valor'];?>">
                    </div>
                    
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="update">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Fuente Recursos</label>
                            <input type="text" name="fuente_recursos" class="form-control" autofocus value="<?php echo $line['fuente_recursos'];?>">
                        </div>  
                        <div class="mb-3">
                            <label for="" class="form-label">Anticipo</label>
                            <input type="text" name="anticipo" class="form-control" autofocus value="<?php echo $line['anticipo'];?>">
                        </div>      
                        <div class="mb-1 abs-center">
                            <a href="list_contratos.php" class="btn btn-danger">
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