<?php
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    if(isset($_POST['create'])){
        $query="
        SELECT * 
        FROM usuarios
        WHERE usuario = '".$_POST['usuario']."' AND password = '".$_POST['password']."'";
        $result = pg_query($query);
        if($line=pg_fetch_row($result)){
            header('Location:list_proyectos.php');             
        }
        else{
            echo "<h1>No pasas cari</h1>";
        }
    }
?>
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Usuario:</label>
                        <input type="text" name="usuario" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Contraseña</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <a href="crear_usuario.php" class="link-success">Registrar usuario</a>
                    </div>
                        <button type="submit" class="btn btn-secondary" name="create">
                            GUARDAR
                        </button>
            </div>
            </form>
        </div>
    </div>
</div>