<?php
include('../config/db.php');
include_once "full-width.php";
?>
    <div class="wrapper row1">
    <section id="ctdetails" class="hoc clear"> 
        <!-- ################################################################################################ -->
        <ul class="nospace clear">
            <div class="sectiontitle">
                <h6 class="heading">Matriz Hitos</h6>
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
        <div class="row mb-3">
            <div class="col-3">
                <form action="buscar.php" method="GET">
                    <!-- <input type="text" placeholder="Búsqueda" class="busqueda" id="busqueda" name="busqueda">
                    <button type="submit" class="btn btn-primary">Buscar</button> -->
                    <a href="../views/full-width.php?frame=list_contratos.php&gr_sel=hito" class="btn btn-secondary">AÑADIR</a>
                    </div>
                </form>
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
            if($_GET['group']!=''){
                $sql_register = pg_query("
                SELECT COUNT(*) as total_registros FROM hitos a
                LEFT JOIN contrato b ON b.id = a.contrato_fk
                LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk
                WHERE c.group_hito_fk ='".$_GET['group']."'");
            }
            else
            {
                $sql_register = pg_query("
                SELECT COUNT(*) as total_registros FROM hitos a
                LEFT JOIN contrato b ON b.id = a.contrato_fk
                LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk
                WHERE c.group_hito_fk is null");
            }
            $result_register = pg_fetch_assoc($sql_register);
            $total_register = $result_register['total_registros'];
            $por_pagina = 10;
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

            if(($_GET['group'])!=''){
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
                LEFT JOIN contrato b ON b.id = a.contrato_fk
                LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk
                LEFT JOIN groups d ON d.cod = c.group_hito_fk
                WHERE c.group_hito_fk ='".$_GET['group']."'
                ORDER BY a.id ASC";
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
                LEFT JOIN contrato b ON b.id = a.contrato_fk
                LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk
                LEFT JOIN groups d ON d.cod = c.group_hito_fk
                WHERE c.group_hito_fk is null
                ORDER BY a.id ASC";
            }
            
            $query = $query." LIMIT $por_pagina OFFSET $desde";
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
                        Editar
                    </a>                    
                    <a href="../controllers/hitos/delete.php?id=<?php echo $line['id_hito']?>" class="btn-danger">
                        Eliminar
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
                <li><a href="?pagina=<?=$i?>&group=<?= $_SESSION['group_hito']?>" class="m-2"><?=$i?></a></li>
            <?php
                }
            ?>
        </ul>
    </nav>
</div>

</div>

</tbody>
<?php include('footer.php');?>