<?php
    include("../config/db.php"); 
    include('includes/styles.php');
    include_once "full-width.php";
    
    if(isset($_POST['create'])){
        $query="INSERT INTO contrato 
        (no_contrato, no_proyecto_fk, no_certificado, fecha_certificado, fecha_firma, no_presupuestal, fecha_presupuestal,
        f_aprob_polizas) VALUES ('".$_POST['no_contrato']."','".$_POST['no_proyecto_fk']."','"
        .$_POST['no_certificado']."','".$_POST['fecha_certificado']."','".$_POST['fecha_firma']."','".$_POST['no_presupuestal']."','".$_POST['fecha_presupuestal']."','"
        .$_POST['f_aprob_polizas']."')";
        print($query);
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header('Location:../views/full-width.php?frame=list_contratos.php');
    }
?>
<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
          <div class="sectiontitle">
              <h6 class="heading">Crear Contratos</h6>
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
            <form action="crear_contratos.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Contrato:</label>
                        <input type="text" name="no_contrato" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">No. Proyecto</label>
                        <input type="text" name="no_proyecto" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">No. Certificado</label>
                        <input type="text" name="no_certificado" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fecha Certificado</label>
                        <input type="date" name="fecha_certificado" class="form-control">
                    </div>
                    <div class="mb-3">
                            <label for="" class="form-label">Fecha Firma</label>
                            <input type="date" name="fecha_firma" class="form-control">
                        </div>
                        
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="create">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">No. Presupuestal</label>
                            <input type="text" name="no_presupuestal" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Presupuestal</label>
                            <input type="date" name="fecha_presupuestal" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Aprobación Polizas</label>
                            <input type="date" name="f_aprob_polizas" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Proyecto</label>
                            <select name="no_proyecto_fk" class="form-select">
                                <option selected>Seleccionar</option>
                            <?php
                                $query = "SELECT * FROM proyecto";
                                $result = pg_query($query);
                                while ($line = pg_fetch_assoc($result)){
                            ?>
                                <option value="<?php echo $line['id']; ?>"><?php echo $line['no_proyecto'];?></option>
                                <?php };?>
                            </select>
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="../views/full-width.php?frame=list_contratos.php" class="btn-danger">
                                CANCELAR
                            </a>
                        </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php include('footer.php');?>