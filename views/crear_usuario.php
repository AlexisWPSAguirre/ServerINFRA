<?php
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    if(isset($_POST['create'])){
        $query="INSERT INTO usuarios 
        (usuario, correo, password) VALUES ('".$_POST['usuario']."','".$_POST['correo']."','"
        .$_POST['password']."')";
        print($query);
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header('Location:login.php');
    }
?>
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <form action="crear_usuario.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Usuario:</label>
                        <input type="text" name="usuario" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Correo</label>
                        <input type="email" name="correo" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Contraseña</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                        <button type="submit" class="btn btn-secondary" name="create">
                            GUARDAR
                        </button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>