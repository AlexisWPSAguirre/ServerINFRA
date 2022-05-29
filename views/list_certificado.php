<?php
include('../config/db.php');
include('includes/jquery.php');
include('includes/scripts.php');
?>
<div class="wrapper row1">
    <section id="ctdetails" class="hoc clear"> 
        <!-- ################################################################################################ -->
        <ul class="nospace clear">
            <div class="sectiontitle">
                <h6 class="heading">Matriz Rubros</h6>
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
                    <input type="text" placeholder="Búsqueda" class="busqueda" id="busqueda" name="busqueda">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="crear_certificado.php" class="btn btn-secondary">AÑADIR</a>
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
            $sql_register = pg_query("SELECT COUNT(*) as total_registros FROM certificado_disponibilidad");
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
            
                $query ="
                SELECT 
                a.id AS id_certificado,
                *
                FROM certificado_disponibilidad a
                LEFT JOIN contrato b ON b.id = a.contrato_fk
                LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk
                ORDER BY a.id ASC";
            
            $query = $query." LIMIT $por_pagina OFFSET $desde";
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
                    <a href="../controllers/certificado/delete.php?id=<?php echo $line['id_certificado']?>" class="btn-danger">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php } ?>
        </table>
        </div>
    </div>
    </div>
    <div class="container">
    <nav class="pagination">
        <ul>
            <?php
                for ($i=1; $i <= $total_paginas ; $i++) { 
                $prev = $i-1;
            ?>
                <li><a href="?pagina=<?=$i?>&frame=list_certificado.php" class="m-2"><?=$i?></a></li>
            <?php
                }
            ?>
        </ul>
    </nav>
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

<?php include('footer.php');?>