<?php 
include_once("../config/db.php"); 
include_once('includes/styles.php');
include_once "full-width.php";
if(isset($_POST['update'])){
        $id = $_GET["id"];
        $query = "UPDATE contratista SET nombre='".$_POST['nombre']."', nit='".$_POST['nit']."'
        WHERE id=$id";
        $result = pg_query($query);
        header('Location:../views/full-width.php?frame=crear_list_contratistas.php');
}
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT *
    FROM contratista
    WHERE id = $id";
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
              <h6 class="heading">Editar Contratista</h6>
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
                <form action="edit_contratista.php?id=<?php echo $_GET['id'];?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" autofocus value="<?php echo $line['nombre'];?>">
                    </div>                
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="update">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">NIT</label>
                            <input type="text" name="nit" class="form-control" autofocus value="<?php echo $line['nit'];?>">
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="../views/full-width.php?frame=crear_list_contratistas.php" class="btn btn-danger">
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