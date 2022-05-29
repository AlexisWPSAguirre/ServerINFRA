<?php 
include("../config/db.php"); 
include('includes/styles.php');
include_once "full-width.php";
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
        header('Location:../views/full-width.php?frame=list_certificado.php');
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
<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
          <div class="sectiontitle">
              <h6 class="heading">Editar Rubro</h6>
          </div>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content">
        <div class="scrollable">
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
                            <a href="../views/full-width.php?frame=list_certificado.php" class="btn btn-danger">
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
<?php include('footer.php');?>