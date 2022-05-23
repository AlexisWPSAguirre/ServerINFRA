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
        </div>
    </div>
    <div class="row">
        <div class="col">
        <table class="table">
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>No. Agrupación</th>
                <th>Descripción</th>
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
            $query = '
            SELECT count(*),c.group_coordenadas
            FROM coordenadas a
            INNER JOIN contrato b ON b.id = a.coo_contrato_fk
            INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
            GROUP BY c.group_coordenadas
            ORDER BY c.group_coordenadas ASC';
            /* $query = $query." LIMIT $por_pagina OFFSET $desde"; */
            $result = pg_query($query) or die ('La consulta fallo: '. preg_last_error());
            while ($line = pg_fetch_assoc($result)) {
        ?>
            <tr>
                <td>
                    <a href="list_coordenadas.php?group=<?php echo $line['group_coordenadas'] ?>">
                    <?php
                        echo $line['count'];
                    ?>
                    </a>
                </td>
                <td>
                    <?php echo $line['group_coordenadas'] ?>
                </td>
                </td>
                <td>
                    
                </td>
                <td>
                    <a href="excel_coordenadas.php?group=<?php echo $line['group_coordenadas']?>" class="btn btn-dark mb-1">
                    <i class="bi bi-file-earmark-spreadsheet"></i>
                    </a>
                    <!-- 
                    <a href="form_edit.php?id=<?php echo $line['id']?>" class="btn btn-secondary mb-1">
                        <i class="bi bi-pen"></i>
                    </a>
                    <a href="../controllers/proyectos/delete.php?id=<?php echo $line['id']?>" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                    </a> -->
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