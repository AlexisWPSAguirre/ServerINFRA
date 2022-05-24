<?php 
include("../config/db.php"); 
include("includes/header.php");
include('includes/styles.php');
include_once '../config/user_session.php';
$userSession = new UserSession();
if( !isset($_SESSION['user'])){
    header("Location: login.php");
}
if(isset($_POST['editar'])){
        $id = $_GET["id"];
        $query = "UPDATE usuarios SET usuario='".$_POST['usuario']."', correo='".$_POST['correo']."',
        password='".$_POST['password']."'
        WHERE id=$id";
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header("Location:login.php");
    }
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT 
    *
    FROM usuarios 
    WHERE id = $id";
    $result = pg_query($query);
    if(!$result) {
        die("Query Failed.");
    }
    while ($line = pg_fetch_assoc($result))
    {
?>
<div class="container p-4">
    <div class="card card-body">
        <div class="row">
            <div class="col">
                <form action="edit_usuario.php?id=<?php echo $_GET['id'];?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Usuario:</label>
                        <input type="text" name="usuario" class="form-control" value="<?php echo $line['usuario'];?>" disabled>
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Correo</label>
                        <input type="text" name="correo" class="form-control" value="<?php echo $line["correo"];?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="text" name="password" class="form-control" value="<?php echo $line["password"];?>">
                    </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="editar">
                            EDITAR
                        </button>
                    </div>
                    <div class="mb-1 abs-center">
                        <a href=".php" class="btn btn-danger">
                            CANCELAR
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }}
?>
<?php include('includes/footer.php');?>