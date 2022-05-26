<?php
include('../config/db.php');
include('includes/jquery.php');
include('includes/scripts.php');
/* include_once '../config/user_session.php';
$userSession = new UserSession();
if( !isset($_SESSION['user'])){
    header("Location: login.php");
} */
?>
<div class="wrapper row1">
    <section id="ctdetails" class="hoc clear"> 
        <!-- ################################################################################################ -->
        <ul class="nospace clear">
            <div class="sectiontitle">
                <h6 class="heading">Información Rubros</h6>
            </div>
        </li>
        </ul>
        <!-- ################################################################################################ -->
    </section>
    </div>
    <div class="wrapper row3">
    <main class="hoc container clear"> 
    <div class="content">
        <div class="scrollable">
    <div class="car car-body">   
        <div class="row mb-3">
            <div class="col-3">
                <form action="buscar.php" method="GET">
                    <input type="text" placeholder="Búsqueda" class="form-control" id="busqueda" name="busqueda">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
                <div class="col">
                    <a href="crear_certificado.php" class="btn btn-secondary">AÑADIR</a>
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
                <th>OBJETO</th>
                <th>RUBRO</th>
                <th>VALOR</th>
                <th>FUENTE_RECURSOS</th>
                <th>ANTICIPO</th>
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
                $query ="
                SELECT 
                a.id AS id_certificado,
                *
                FROM certificado_disponibilidad a
                INNER JOIN contrato b ON b.id = a.contrato_fk
                INNER JOIN proyecto c ON c.id = b.no_proyecto_fk";
            
            $result = pg_query($query);
            while($line=pg_fetch_assoc($result)){
        ?>
            <tr>
                <td>
                    <?php
                        echo $line['id_certificado'];
                    ?>
                </td>
                <td>
                    <?php
                        echo $line['no_contrato'];
                    ?>
                </td>
                <td>
                    <?php echo $line['objeto'] ?>
                </td>
                <td>
                    <?php echo $line['rubro'] ?>
                </td>
                <td>
                    <?php echo $line['valor'] ?>
                </td>
                <td>
                    <?php echo $line['fuente_recursos'] ?>
                </td>
                <td>
                    <?php echo $line['anticipo'] ?>
                </td>
                <td>
                    <a href="edit_certificado.php?id=<?php echo $line['id_certificado']?>" class="btn btn-secondary mb-1">
                        Editar
                    </a>                    
                    <a href="../controllers/certificado/delete.php?id=<?php echo $line['id_certificado']?>" class="btn btn-danger">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php } ?>
        </table>
        </div>
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
<?php include('footer.php');?>