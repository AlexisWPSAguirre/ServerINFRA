<?php
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
                    <a href="crear_proyecto.php" class="btn btn-secondary">CREAR</a>
                </div>
                <div class="col">
                    <a href="groups_hitos.php" class="btn btn-secondary">HITOS</a>
                </div>
                <div class="col">
                    <a href="groups_seguimiento.php" class="btn btn-secondary">OBRAS</a>
                </div>
                <div class="col">
                    <a href="groups_coordenadas.php" class="btn btn-secondary">COORDENADAS</a>
                </div>
                <div class="col">
                    <a href="crear_list_contratistas.php" class="btn btn-secondary">CONTRATISTAS</a>
                </div>
                <div class="col">
                    <a href="list_contratos.php" class="btn btn-secondary">CONTRATOS</a>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>No. Proyecto</th>
                <th>Objeto</th>
                <th>Proceso</th>
                <th>Nombre contratista</th>
                <th>NIT contratista</th>
                <th>Fecha de Iniciación</th>
                <th>Fecha de Terminación</th>
                <th>Fecha de Liquidación</th>
                <th>Supervisor</th>
                <th>Dirección</th>
                <th>Telefono Celular</th>
                <th>Correo</th>
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
            a.id,
            a.no_proyecto,
            a.objeto,
            a.proceso,
            b.nombre,
            b.nit,
            a.fecha_iniciacion,
            a.fecha_terminacion,
            a.fecha_liquidacion,
            a.supervision_interventoria,
            a.direccion,
            a.tel_cel,
            a.correo           
            FROM proyecto a 
            INNER JOIN contratista b ON a.contratista_fk = b.id
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
                    <?php echo $line['objeto'] ?>
                </td>
                <td>
                    <?php echo $line['proceso'] ?>
                </td>
                <td>
                    <?php echo $line['nombre'] ?>
                </td>
                <td>
                    <?php echo $line['nit'] ?>
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
                    <?php echo $line['direccion'] ?>
                </td>
                <td>
                    <?php echo $line['tel_cel'] ?>
                </td>
                <td>
                    <?php echo $line['correo'] ?>
                </td>
                <td>
                    <a href="edit_proyecto.php?id=<?php echo $line['id']?>" class="btn btn-secondary mb-1">
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