<?php 
include("../config/db.php"); 
include('includes/styles.php');
include_once "full-width.php";

if(isset($_POST['crear'])){
    $id = $_GET["id"];
    if(isset($_GET['gr_new'])){
        $query = "INSERT INTO hitos(hito,detalle_hito,valor_adiciones_hito,dias_hito,contrato_fk,fecha_hito)
        VALUES('".$_POST['hito']."','".$_POST['detalle_hito']."','".$_POST['valor_adiciones_hito']."',
        '".$_POST['dias_hito']."',".$id.",'".$_POST['fecha_hito']."');
        INSERT INTO groups (cod,descripcion) VALUES('".$_POST['cod']."','".$_POST['descripcion']."');
        UPDATE proyecto SET group_hito_fk = '".$_POST['cod']."' WHERE id =".$_GET['pro_id'];
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        } 
        header('Location: list_hitos.php?group='.$_POST['cod']);
    }
    else{
        $query = "INSERT INTO hitos(hito,detalle_hito,valor_adiciones_hito,dias_hito,contrato_fk,fecha_hito)
        VALUES('".$_POST['hito']."','".$_POST['detalle_hito']."','".$_POST['valor_adiciones_hito']."',
        '".$_POST['dias_hito']."',".$id.",'".$_POST['fecha_hito']."');
        UPDATE proyecto SET group_hito_fk = '".$_SESSION['group_hito']."' WHERE id =".$_GET['pro_id'];
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        } 
        header('Location: list_hitos.php?group='.$_SESSION['group_hito']);
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
              <h6 class="heading">Crear Hito</h6>
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
                    <form action="crear_hito.php?id=<?php echo $_GET['id'];?>&pro_id=<?php echo $_GET['pro_id']?>&gr_new='TRUE'" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Código:</label>
                            <input type="text" name="cod" class="form-control" value="H">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Descripción de Grupo:</label>
                        <input type="text" name="descripcion" class="form-control">
                    </div>
                    <?php
                        }else{
                    ?>
                    <form action="crear_hito.php?id=<?php echo $_GET['id'];?>&pro_id=<?php echo $_GET['pro_id']?>" method="POST">
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
                            <input type="text" name="dias_hito" class="form-control" value=0>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Hito</label>
                            <input type="date" name="fecha_hito" class="form-control">
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="../views/full-width.php?frame=list_hitos.php&group=<?= $_SESSION['group_hito'] ?>" class="btn-danger">
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