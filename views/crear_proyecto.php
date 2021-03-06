<?php
    include_once("../config/db.php"); 
    include_once('includes/styles.php');
    include_once "full-width.php";
    if(isset($_POST['create'])){
        date_default_timezone_set("America/Bogota");
        $group_entrada = date('m');
        $anio = date('Y');

        $query="INSERT INTO proyecto 
        (no_proyecto, objeto, proceso, contratista_fk, fecha_iniciacion, fecha_terminacion, fecha_liquidacion,
        supervision_interventoria, direccion, tel_cel, correo, group_entrada, anio) VALUES ('".$_POST['no_proyecto']."','".$_POST['objeto']."','"
        .$_POST['proceso']."','".$_POST['contratista_fk']."','".$_POST['fecha_iniciacion']."','".$_POST['fecha_terminacion']."','".$_POST['fecha_liquidacion']."','"
        .$_POST['supervision_interventoria']."','".$_POST['direccion']."','".$_POST['tel_cel']."','".$_POST['correo']."','$group_entrada','$anio')";
        $result = pg_query($query);
        header('Location:../views/full-width.php?frame=list_proyectos.php');
    }
?>
<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
          <div class="sectiontitle">
              <h6 class="heading">Crear Proyecto</h6>
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
            <form action="crear_proyecto.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Proyecto:</label>
                        <input type="text" name="no_proyecto" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Objeto</label>
                        <input type="text" name="objeto" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Proceso</label>
                        <input type="text" name="proceso" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fecha Iniciaci??n</label>
                        <input type="date" name="fecha_iniciacion" class="form-control">
                    </div>
                    <div class="mb-3">
                            <label for="" class="form-label">Fecha Terminaci??n</label>
                            <input type="date" name="fecha_terminacion" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Liquidaci??n</label>
                            <input type="date" name="fecha_liquidacion" class="form-control">
                        </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="create">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        
                        <div class="mb-3">
                            <label for="" class="form-label">Supervisi??n</label>
                            <input type="text" name="supervision_interventoria" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Direcci??n</label>
                            <input type="text" name="direccion" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Telefono/Celular</label>
                            <input type="text" name="tel_cel" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Correo</label>
                            <input type="text" name="correo" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Contratista</label>
                            <select name="contratista_fk" class="form-select">
                                <option value=1 selected>Seleccionar</option>
                            <?php
                                $query = "SELECT * FROM contratista";
                                $result = pg_query($query);
                                while ($line = pg_fetch_row($result)){
                            ?>
                                <option value="<?php echo $line[2]; ?>"><?php echo $line[0];?></option>
                                <?php };?>
                            </select>
                        </div>
                        <div class="mb-3">
                            
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="../views/full-width.php?frame=list_proyectos.php" class="btn-danger">
                                CANCELAR
                            </a>
                        </div>
            </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php include('footer.php');?>