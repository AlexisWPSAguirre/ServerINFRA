<?php 
include("../config/db.php"); 
include("includes/header.php");
include('includes/styles.php');
include_once 'full-width.php';
/* include_once '../config/user_session.php';
$userSession = new UserSession();
if( !isset($_SESSION['user'])){
    header("Location: login.php");
} */
if(isset($_POST['update'])){
        $id = $_GET["id"];
        $query = "UPDATE proyecto SET no_proyecto='".$_POST['no_proyecto']."', objeto='".$_POST['objeto']."', proceso='".$_POST['proceso']."',
        fecha_iniciacion='".$_POST['fecha_iniciacion']."', fecha_terminacion='".$_POST['fecha_terminacion']."',
        fecha_liquidacion='".$_POST['fecha_liquidacion']."', supervision_interventoria='".$_POST['supervision_interventoria']."'
        , direccion='".$_POST['direccion']."', tel_cel='".$_POST['tel_cel']."', correo='".$_POST['correo']."', contratista_fk='".$_POST['contratista_fk']."'
        WHERE id=$id";
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header('Location:list_proyectos.php');
    }
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT *
    FROM proyecto a
    INNER JOIN contratista b ON a.contratista_fk = b.id
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
                <form action="edit_proyecto.php?id=<?php echo $_GET['id'];?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Proyecto:</label>
                        <input type="text" name="no_proyecto" class="form-control" autofocus value="<?php echo $line['no_proyecto'];?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Objeto</label>
                        <input type="text" name="objeto" class="form-control" autofocus value="<?php echo $line['objeto'];?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Proceso</label>
                        <input type="text" name="proceso" class="form-control" autofocus value="<?php echo $line['proceso'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Contratistas</label>
                        <select name="contratista_fk" id="" class="form-select">
                            <?php
                                $query = "
                                SELECT
                                nombre,
                                id 
                                FROM contratista";
                                $result = pg_query($query);
                                while ($contratistas = pg_fetch_assoc($result))
                                {
                            ?>
                            <option value="<?php echo $contratistas['id']?>"><?php echo $contratistas['nombre'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fecha Iniciación</label>
                        <input type="date" name="fecha_iniciacion" class="form-control" autofocus value="<?php echo $line['fecha_iniciacion'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fecha Terminación</label>
                        <input type="date" name="fecha_terminacion" class="form-control" autofocus value="<?php echo $line['fecha_terminacion'];?>">
                    </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="update">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Liquidación</label>
                            <input type="date" name="fecha_liquidacion" class="form-control" autofocus value="<?php echo $line['fecha_liquidacion'];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Supervisión</label>
                            <input type="text" name="supervision_interventoria" class="form-control" autofocus value="<?php echo $line['supervision_interventoria'];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control" autofocus value="<?php echo $line['direccion'];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Telefono/Celular</label>
                            <input type="text" name="tel_cel" class="form-control" autofocus value="<?php echo $line['tel_cel'];?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Correo</label>
                            <input type="text" name="correo" class="form-control" autofocus value="<?php echo $line['correo'];?>">
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="list_proyectos.php" class="btn btn-danger">
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