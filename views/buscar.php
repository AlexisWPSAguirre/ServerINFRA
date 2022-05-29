<?php
include('../config/db.php');
include('../views/includes/styles.php');
include('../views/includes/jquery.php');
include('../views/includes/scripts.php');
include('../views/full-width.php');
?>
<div class="container mt-3">
    <?php
        $busqueda = $_REQUEST['busqueda'];
        if(empty($_REQUEST['busqueda']))
        {
            header("location: ../index.php");
        }
        $query = 'SELECT 
        a.id,
        a.no_proyecto,
        a.proceso,
        a.fecha_iniciacion,
        a.fecha_terminacion,
        a.fecha_liquidacion,
        a.supervision_interventoria,
        b.nombre,
        b.nit
        FROM proyecto a 
        INNER JOIN contratista b ON b.id = a.contratista_fk 
        WHERE';
        $query = $query." LOWER(a.no_proyecto) LIKE LOWER('%$busqueda%') OR LOWER(a.proceso) LIKE LOWER('%$busqueda%') ORDER BY a.id ASC";
        $result = pg_query($query) or die ('La consulta fallo: '. preg_last_error());
         //Paginador
        $sql_register = pg_query("SELECT COUNT(*) as total_registros FROM proyecto a WHERE LOWER(a.no_proyecto) LIKE LOWER('%$busqueda%') OR LOWER(a.proceso) LIKE LOWER('%$busqueda%')");
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
    ?>
    <div class="car car-body">   
        <div class="row mb-3">
            <div class="col-3">
                <form action="buscar.php" method="POST">
                    <input type="text" placeholder="Búsqueda" class="form-control" id="busqueda" name="busqueda" value="<?php echo $busqueda; ?>">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search-heart"></i></button>
                    </div>
                </form>
                <div class="col">
                    <a href="form_crear.php" class="btn btn-secondary">CREAR</a>
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
                <th>Contratista</th>
                <th>NIT</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php 
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
                    <?php echo $line['nombre'] ?>
                </td>
                <td>
                    <?php echo $line['nit'] ?>
                </td>
                <td>
                    <a href="../views/form_edit.php?id=<?php echo $line['id']?>" class="btn btn-secondary mb-1">
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
    <div class="container">
    <nav class="pagination">
        <ul>
            <?php
                for ($i=1; $i <= $total_paginas ; $i++) { 
                $prev = $i-1;
            ?>
                <li><a href="?pagina=<?=$i?>&frame=list_proyectos.php" class="m-2"><?=$i?></a></li>
            <?php
                }
            ?>
        </ul>
    </nav>
</div>
</div>
</tbody>
<?php include('../views/footer.php');?>