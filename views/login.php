<?php
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    include_once '../config/user_session.php';
    $userSession = new UserSession();

    class password{
        const SALT = 'alcaldia2022';
        function hashing($pass){
            return hash('sha512',self::SALT.$pass);
        }
        function verify($password, $hash) {
            return ($hash == self::hashig($password));
        }
    }
    if(isset($_POST['login'])){
        
        $hash = password::hashing($_POST['password']);
        $query="
        SELECT * 
        FROM usuarios
        WHERE usuario = '".$_POST['usuario']."' AND password = '".$hash."'";
        $result = pg_query($query);
        if($line=pg_fetch_row($result)){
            $userSession->setCurrentUser($_POST['usuario'],$hash);
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
                        <label for="" class="form-label" required>Usuario:</label>
                        <input type="text" name="usuario" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label" required>Contraseña</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <a href="crear_usuario.php" class="link-success">Registrar usuario</a>
                    </div>
                        <button type="submit" class="btn btn-secondary" name="login">
                            Iniciar Sesion
                        </button>
            </div>
            </form>
        </div>
    </div>
</div>