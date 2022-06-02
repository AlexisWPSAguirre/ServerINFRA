<?php 
include("../config/db.php"); 
include('includes/styles.php');
include_once "full-width.php";

if(isset($_POST['editar'])){
        $cod = $_GET["cod"];
        $query = "UPDATE groups SET descripcion='".$_POST['descripcion']."'
        WHERE cod='$cod'";
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header("Location:../views/full-width.php?frame=groups_hitos.php");
    }
if(isset($_GET['group'])) {
    $cod = $_GET['group'];
    $query = "
    SELECT 
    *
    FROM groups
    WHERE cod = '$cod'";
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
              <h6 class="heading">Editar Group</h6>
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
                <form action="edit_group.php?cod=<?php echo $_GET['group'];?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Código:</label>
                        <input type="text" name="cod" class="form-control" value="<?php echo $line['cod'];?>" disabled>
                    </div>
                    
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="editar">
                            EDITAR
                        </button>
                    </div>
            </div>
            <div class="col">
                    <div class="mb-3">  
                        <label for="" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="<?php echo $line["descripcion"];?>" >
                    </div>
                    <div class="mb-1 abs-center">
                        <a href="../views/full-width.php?frame=groups_hitos.php" class="btn-danger">
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