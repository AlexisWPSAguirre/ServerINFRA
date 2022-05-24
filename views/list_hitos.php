<?php
include('../config/db.php');
include('includes/header.php');
include('includes/styles.php');
include('includes/jquery.php');
include('includes/scripts.php');
include_once '../config/user_session.php';
$userSession = new UserSession();
if( !isset($_SESSION['user'])){
    header("Location: login.php");
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
                    <a href="list_contratos.php?group=<?php echo $_GET['group']?>" class="btn btn-secondary">AÑADIR</a>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NO_CONTRATO</th>
                <th>ID_BPIN</th>
                <th>NOMBRE_PROYECTO</th>
                <th>HITO</th>
                <th>FECHA_HITO</th>
                <th>DETALLE_HITO</th>
                <th>VALOR_ADICIONES_HITO</th>
                <th>DIAS_HITO</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php 
            //Paginador
            /* $sql_register = pg_query("SELECT COUNT(*) as total_registros FROM proyecto");
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
            $total_paginas = ceil($total_register/$por_pagina); */
            if($_GET['group'] != null){
                $query ="
                SELECT 
                a.id as id_hito,
                b.no_contrato,
                c.no_proyecto,
                c.objeto,
                a.hito,
                a.fecha_hito,
                a.detalle_hito,
                a.valor_adiciones_hito,
                a.dias_hito
                FROM hitos a
                INNER JOIN contrato b ON b.id = a.contrato_fk
                INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
                WHERE c.group_hito ='".$_GET['group']."'";
            }
            else
            {
                $query ="
                SELECT 
                a.id as id_hito,
                b.no_contrato,
                c.no_proyecto,
                c.objeto,
                a.hito,
                a.fecha_hito,
                a.detalle_hito,
                a.valor_adiciones_hito,
                a.dias_hito
                FROM hitos a
                INNER JOIN contrato b ON b.id = a.contrato_fk
                INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
                WHERE c.group_hito is null";
            }
            
            $result = pg_query($query);
            while($line=pg_fetch_assoc($result)){
        ?>
            <tr>
                <td>
                    <?php
                        echo $line['id_hito'];
                    ?>
                </td>
                <td>
                    <?php
                        echo $line['no_contrato'];
                    ?>
                </td>
                <td>
                    <?php echo $line['no_proyecto'] ?>
                </td>
                <td>
                    <?php echo $line['objeto'] ?>
                </td>
                <td>
                    <?php echo $line['hito'] ?>
                </td>
                <td>
                    <?php echo $line['fecha_hito'] ?>
                </td>
                <td>
                    <?php echo $line['detalle_hito'] ?>
                </td>
                <td>
                    <?php echo $line['valor_adiciones_hito'] ?>
                </td>
                <td>
                    <?php echo $line['dias_hito'] ?>
                </td>
                <td>
                    <?php
                        $_SESSION['group_hito'] = $_GET['group'] ;
                    ?>
                    <a href="edit_hito.php?id=<?php echo $line['id_hito']?>" class="btn btn-secondary mb-1">
                        <i class="bi bi-pen"></i>
                    </a>                    
                    <a href="../controllers/hitos/delete.php?id=<?php echo $line['id_hito']?>" class="btn btn-danger">
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
<!-- Paginador -->
<!-- <div class="container">
    <div class="row">
        <?php
            for ($i=1; $i <= $total_paginas ; $i++) { 
                if ($i==$pagina) {
                    echo '<div class="col-1">
                    <a href="?pagina='.$i.'" class="list-group-item list-group-item-action active">'.$i.'</a>
                    </div>';
                }
                else{
                    echo '<div class="col-1">
                    <a href="?pagina='.$i.'" class="list-group-item list-group-item-action">'.$i.'</a>
                    </div>';
                }
            }
        ?>
    </div>
</div> -->
<?php include('includes/footer.php');?>