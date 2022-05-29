<?php 
include("../config/db.php"); 
include('includes/styles.php');
include_once "full-width.php";
if(isset($_POST['update'])){
        $id = $_GET["id"];
        $query = "UPDATE contrato SET no_contrato='".$_POST['no_contrato']."', no_proyecto_fk='".$_POST['no_proyecto_fk']."', no_certificado='".$_POST['no_certificado']."',
        fecha_certificado='".$_POST['fecha_certificado']."', fecha_firma='".$_POST['fecha_firma']."',
        no_presupuestal='".$_POST['no_presupuestal']."', fecha_presupuestal='".$_POST['fecha_presupuestal']."'
        , f_aprob_polizas='".$_POST['f_aprob_polizas']."'
        WHERE id=$id";
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header('Location:../views/full-width.php?frame=list_contratos.php');
    }
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT *
    FROM contrato a
    INNER JOIN proyecto b ON a.no_proyecto_fk = b.id
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
              <h6 class="heading">Editar Proyecto</h6>
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
                <form action="edit_contratos.php?id=<?php echo $_GET['id'];?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Contrato:</label>
                        <input type="text" name="no_contrato" class="form-control" autofocus value="<?php echo $line['no_contrato'];?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">No. Certificado</label>
                        <input type="text" name="no_certificado" class="form-control" autofocus value="<?php echo $line['no_certificado'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">No. Proyecto</label>
                        <select name="no_proyecto_fk" id="" class="form-select">
                            <?php
                                $query = "
                                SELECT
                                no_proyecto,
                                id 
                                FROM proyecto";
                                $result = pg_query($query);
                                while ($proyectos = pg_fetch_assoc($result))
                                {
                            ?>
                            <option value="<?php echo $proyectos['id']?>"><?php echo $proyectos['no_proyecto'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fecha Certificado</label>
                        <input type="text" name="fecha_certificado" class="form-control" autofocus value="<?php echo $line['fecha_certificado'];?>">
                    </div>
                    
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="update">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Firma</label>
                            <input type="date" name="fecha_firma" class="form-control" autofocus value="<?php echo $line['fecha_firma'];?>">
                        </div>  
                        <div class="mb-3">
                            <label for="" class="form-label">No. Presupuestal</label>
                            <input type="text" name="no_presupuestal" class="form-control" autofocus value="<?php echo $line['no_presupuestal'];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Presupuestal</label>
                            <input type="date" name="fecha_presupuestal" class="form-control" autofocus value="<?php echo $line['fecha_presupuestal'];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Aprobación Polizas</label>
                            <input type="date" name="f_aprob_polizas" class="form-control" autofocus value="<?php echo $line['f_aprob_polizas'];?>">
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="../views/full-width.php?frame=list_contratos.php" class="btn btn-danger">
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