<?php
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    include_once '../config/user_session.php';
    $userSession = new UserSession();
    if( !isset($_SESSION['user'])){
        header("Location: login.php");
    }
    $query = "SELECT id,no_contrato from contrato";
    $result = pg_query($query);
    if(isset($_POST['create'])){
        $query="INSERT INTO hitos
        (contrato_fk,hito,detalle_hito,fecha_hito,valor_adiciones_hito,dias_hito)
        VALUES ('".$_POST['no_contrato']."','".$_POST['hito']."','".$_POST['detalle_hito']."','"
        .$_POST['fecha_hito']."','".$_POST['valor_adiciones_hito']."',".$_POST['dias_hito'].")";
        echo $query;
        /* $result = pg_query($query); */
        if(!$result)
        {
            die("Query Failed.");
        }   
    }
?>
<div class="container mt-3">
    <div class="car car-body">   
        <div class="row mb-3">
            <div class="col-3">
                <form action="buscar.php" method="GET">
                    <input type="text" placeholder="Búsqueda" class="form-control" id="busqueda" name="busqueda">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search-heart"></i></button>
                    </div>
                </form>
                <div class="col">
                    <a href="form_crear.php" class="btn btn-secondary">CREAR</a>
                </div>
                <div class="col">
                    <a href="form_hitos.php" class="btn btn-secondary">HITOS</a>
                </div>
                <div class="col">
                    <a href="form_obras.php" class="btn btn-secondary">OBRAS</a>
                </div>
                <div class="col">
                    <a href="form_coordenadas.php" class="btn btn-secondary">COORDENADAS</a>
                </div>
                <div class="col">
                    <a href="form_contratista.php" class="btn btn-secondary">CONTRATISTA</a>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>No. Proyecto</th>
                <th>Proceso</th>
                <th>Fecha de Iniciación</th>
                <th>Fecha de Terminación</th>
                <th>Fecha de Liquidación</th>
                <th>Supervisor</th>
                <th>Fecha Modificación</th>
                <th>NIT</th>
                <th>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php 
            //Paginador
            $sql_register = pg_query("SELECT COUNT(*) as total_registros FROM proyecto");
            $result_register = pg_fetch_assoc($sql_register);
            $total_register = $result_register['total_registros'];
            $por_pagina = 5;
            if(empty($_GET['pagina']))
            {
                $pagina = 1;
                $desde = 0;
            }else
            {
                $pagina = $_GET['pagina'];
                $desde = ($pagina-1) * $por_pagina;
            }
            $total_paginas = ceil($total_register/$por_pagina);
            /* 
            b.nombre,
            b.nit
            INNER JOIN contratista b ON b.id = a.contratista_fk */
            $query = 'SELECT
            a.id,
            a.no_proyecto,
            a.proceso,
            a.fecha_iniciacion,
            a.fecha_terminacion,
            a.fecha_liquidacion,
            a.supervision_interventoria            
            FROM proyecto a 
            ORDER BY a.id ASC';
            $query = $query." LIMIT $por_pagina OFFSET $desde";
            $result = pg_query($query) or die ('La consulta fallo: '. preg_last_error());
            $index = 1;
            while ($line = pg_fetch_assoc($result)) {
        ?>
            <tr>
                <td>
                    <?php
                        echo $line['id'];
                    ?>
                </td>
                <td>
                    <?php echo $line['no_proyecto'] ?>
                </td>
                <td>
                    <?php echo $line['proceso'] ?>
                </td>
                <td>
                    <?php echo $line['fecha_iniciacion'] ?>
                </td>
                <td>
                    <?php echo $line['fecha_terminacion'] ?>
                </td>
                <td>
                    <?php echo $line['fecha_liquidacion'] ?>
                </td>
                <td>
                    <?php echo $line['supervision_interventoria'] ?>
                </td>
                <td>
                    
                </td>
             <!--    <td>
                    <?php echo $line['nombre'] ?>
                </td>
                <td>
                    <?php echo $line['nit'] ?>
                </td> -->
                <td>
                    <a href="form_edit.php?id=<?php echo $line['id']?>" class="btn btn-secondary mb-1">
                        <i class="bi bi-pen"></i>
                    </a>
                    <a href="../controllers/proyectos/delete.php?id=<?php echo $line['id']?>" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                    </a>
                    </td>
            </tr>
        <?php } ?>
        </table>
        </div>
    </div>
</div>
    <!-- <script>
        $(function(){
            $("p").click(function(event){
                alert("evento click")
            });
        });
    </script> -->
</div>
</tbody>