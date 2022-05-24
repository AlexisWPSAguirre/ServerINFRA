<?php
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    class password{
        const SALT = 'alcaldia2022';
        function hashing($pass){
            return hash('sha512',self::SALT.$pass);
        }
        function verify($password, $hash) {
            return ($hash == self::hashig($password));
        }
    }
    if(isset($_POST['create'])){
        $hash = password::hashing($_POST['password']); 
        $query="INSERT INTO usuarios 
        (usuario, correo, password) VALUES ('".$_POST['usuario']."','".$_POST['correo']."','"
        .$hash."')";
        $result = pg_query($query); 
    }
?>
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <form action="crear_usuario.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label" required>Usuario:</label>
                        <input type="text" name="usuario" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label" required>Correo</label>
                        <input type="email" name="correo" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label" required>Contraseña</label>
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