<?php
session_start();
include('../config/db.php');
include('includes/header.php');
include('includes/styles.php');
include('includes/jquery.php');
include('includes/scripts.php');
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
                    <a href="crear_contratos.php" class="btn btn-secondary">CREAR</a>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>No. Contrato</th>
                <th>No. Proyecto</th>
                <th>No. Certificado</th>
                <th>Fecha Certificado</th>
                <th>Fecha de Firma</th>
                <th>No. Presupuestal</th>
                <th>Fecha Presupuestal</th>
                <th>Fecha Aprobación Polizas</th>
                <th>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php 
            //Paginador
            /* Se debe colocar */
            $sql_register = pg_query("SELECT COUNT(*) as total_registros FROM contrato");
            $result_register = pg_fetch_assoc($sql_register);
            $total_register = $result_register['total_registros'];
            $por_pagina = 20;
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
            no_contrato,
            a.id,
            b.id as proyecto_id,
            b.no_proyecto as no_proyecto,
            no_presupuestal,
            fecha_presupuestal,
            fecha_firma,
            f_aprob_polizas,
            fecha_certificado,
            no_certificado           
            FROM contrato a 
            INNER JOIN proyecto b ON b.id = a.no_proyecto_fk
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
                    <?php echo $line['no_contrato'] ?>
                </td>
                <td>
                    <?php echo $line['no_proyecto'] ?>
                </td>
                <td>
                    <?php echo $line['no_certificado'] ?>
                </td>
                <td>
                    <?php echo $line['fecha_certificado'] ?>
                </td>
                <td>
                    <?php echo $line['fecha_firma'] ?>
                </td>
                <td>
                    <?php echo $line['no_presupuestal'] ?>
                </td>
                <td>
                    <?php echo $line['fecha_presupuestal'] ?>
                </td>
                <td>
                    <?php echo $line['f_aprob_polizas'] ?>
                </td>
                <td>
                    <?php
                        if(isset($_GET['group'])){
                    ?>
                    <a href="crear_hito.php?id=<?php echo $line['id']?>&pro_id=<?php echo $line['proyecto_id']?>" class="btn btn-secondary mb-1">
                        <i class="bi bi-pen"></i>
                    </a>
                    <?php
                        }else{
                    ?>
                    <a href="edit_contratos.php?id=<?php echo $line['id']?>" class="btn btn-secondary mb-1">
                        <i class="bi bi-pen"></i>
                    </a>
                    <a href="../controllers/contratos/delete.php?id=<?php echo $line['id']?>" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                    </a>
                    <?php
                        }
                    ?>
                    </td>
            </tr>
        <?php } ?>
        </table>
        </div>
    </div>
</div>
</div>
</tbody>
<!-- Paginador -->
<div class="container">
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
</div>
<?php include('includes/footer.php');?>