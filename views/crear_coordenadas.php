<?php
    include("../config/db.php"); 
    include('includes/styles.php');
    include_once '../config/user_session.php';
    include_once "full-width.php";

    if(isset($_POST['create'])){        
        if(isset($_GET['gr_new'])){
            $query="INSERT INTO coordenadas 
            (coo_contrato_fk, latitud, longitud, latitud_inicial, latitud_final, longitud_inicial, longitud_final) VALUES (".$_GET['id'].",'".$_POST['latitud']."','"
            .$_POST['longitud']."','".$_POST['latitud_inicial']."','".$_POST['latitud_final']."','".$_POST['longitud_inicial']."','".$_POST['longitud_final']."');
            INSERT INTO groups (cod,descripcion) VALUES('".$_POST['cod']."','".$_POST['descripcion']."');
            UPDATE proyecto SET group_coordenadas_fk = '".$_POST['cod']."' WHERE id =".$_GET['pro_id'];
            $result = pg_query($query);
            if(!$result)
            {
                die("Query Failed.");
            } 
            header('Location: list_coordenadas.php?group='.$_POST['cod']);
        }else{
            $query="INSERT INTO coordenadas 
            (coo_contrato_fk, latitud, longitud, latitud_inicial, latitud_final, longitud_inicial, longitud_final) VALUES (".$_GET['id'].",'".$_POST['latitud']."','"
            .$_POST['longitud']."','".$_POST['latitud_inicial']."','".$_POST['latitud_final']."','".$_POST['longitud_inicial']."','".$_POST['longitud_final']."');
            UPDATE proyecto SET group_coordenadas_fk = '".$_SESSION['group_coordenadas']."' WHERE id =".$_GET['pro_id'];
            $result = pg_query($query);
            if(!$result)
            {
                die("Query Failed.");
            } 
            header('Location: list_coordenadas.php?group='.$_SESSION['group_coordenadas']);
        }
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
<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
          <div class="sectiontitle">
              <h6 class="heading">Crear Coordenadas</h6>
          </div>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content">
    <div class="row">
        <div class="col">
                    <?php
                        if(isset($_GET['gr_new']))
                        {
                    ?>
                    <form action="crear_coordenadas.php?id=<?php echo $_GET['id'];?>&pro_id=<?php echo $_GET['pro_id']?>&gr_new='TRUE'" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">C??digo:</label>
                            <input type="text" name="cod" class="form-control" value="C">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Descripci??n de Grupo:</label>
                        <input type="text" name="descripcion" class="form-control">
                    </div>
                    <?php
                        }else{
                    ?>
                    <form action="crear_coordenadas.php?id=<?php echo $_GET['id'];?>&pro_id=<?php echo $_GET['pro_id']?>" method="POST">
                    <?php
                        }
                    ?>
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
                        <input type="text" name="latitud" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Longitud</label>
                        <input type="text" name="longitud" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Latitud Inicial</label>
                        <input type="text" name="latitud_inicial" class="form-control">
                    </div>
                    
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="create">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Latitud Final</label>
                            <input type="text" name="latitud_final" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Longitud Inicial</label>
                            <input type="text" name="longitud_inicial" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Longitud Final</label>
                            <input type="text" name="longitud_final" class="form-control">
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="list_proyectos.php" class="btn-danger">
                                CANCELAR
                            </a>
                        </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php }}include('footer.php');?>