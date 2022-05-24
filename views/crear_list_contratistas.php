<?php
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    include_once '../config/user_session.php';
    $userSession = new UserSession();
    if( !isset($_SESSION['user'])){
        header("Location: login.php");
    }
    if(isset($_POST['create'])){
        $query="INSERT INTO contratista
        (nombre,nit)
        VALUES ('".$_POST['nombre']."','".$_POST['nit']."')";
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }   
    }
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-5">
            <form action="" method="POST">
                    <div class="mb-3">  
                        <label for="" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">NIT:</label>
                        <input type="text" name="nit" class="form-control">
                    </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary m-2" name="create">
                            GUARDAR
                        </button>
                        <a href="list_proyectos.php" class="btn btn-secondary">
                            CANCELAR
                        </a>
                    </div>
            </form>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>NIT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM contratista";
                    $result = pg_query($query);
                    while ($line = pg_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?= $line['id'] ?></td>
                    <td><?= $line['nombre'] ?></td>
                    <td><?= $line['nit'] ?></td>
                    <td>
                        <a class="btn btn-primary mb-1" href="edit_contratista.php?id=<?= $line['id']?>">EDITAR</a>
                        <a class="btn btn-dark" href="../controllers/contratista/delete.php?id=<?= $line['id']?>">ELIMINAR</a>
                    </td>
                    <?php
                        }
                    ?>
                    
                </tr>
            </tbody>
        </table>
    </div>
</div>
    