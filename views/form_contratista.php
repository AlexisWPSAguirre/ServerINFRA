<?php
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    if(isset($_POST['create'])){
        $query="INSERT INTO contratista
        (nombre,nit)
        VALUES ('".$_POST['nombre']."','".$_POST['nit']."')";
        echo $query;
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
                        <button type="submit" class="btn btn-secondary" name="create">
                            GUARDAR
                        </button>
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
                    <?php
                            echo "<td>".$line['id']."</td>";
                            echo "<td>".$line['nombre']."</td>";
                            echo "<td>".$line['nit']."</td>";
                        }
                    ?>
                    
                </tr>
            </tbody>
        </table>
    </div>
</div>
    