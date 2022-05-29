<?php
    include("../config/db.php"); 
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
            header('Location:../template.php');
        }
        else{
            echo "<h1>No pasas cari</h1>";
        }
    }
?>
<!doctype html>
<html lang="en">
    <head>
    <title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">

    </head>
    <body class="img js-fullheight" style="background-image: url(../images/bg.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Inicio de Sesión</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                <h3 class="mb-4 text-center">¿Tienes una  cuenta?</h3>
                <form action="login.php" class="signin-form" method="POST">
                    <div class="form-group">
                        <input name="usuario" type="text" class="form-control" placeholder="Username" required>
                    </div>
                <div class="form-group">
                    <input name="password" id="password-field" type="password" class="form-control" placeholder="Password" required>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form-group">
                    <button name="login" type="submit" class="form-control btn btn-primary submit px-3">Entrar</button>
                </div>
                </form>
                <p class="w-100 text-center"><a href="">Registrar Usuario</a></p>
            </div>
        </div>
    </section>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    </body>
</html>

