<?php
include('../config/db.php');
include('includes/jquery.php');
?>
    <div class="wrapper row1">
    <section id="ctdetails" class="hoc clear"> 
        <!-- ################################################################################################ -->
        <ul class="nospace clear">
            <div class="sectiontitle">
                <h6 class="heading">Matriz Proyectos</h6>
            </div>
        </li>
        </ul>
        <!-- ################################################################################################ -->
    </section>
    </div>

    <div class="wrapper row2">
        <div class="row">
            <select name="" id="search_anio_proyecto" class="form-select" style="margin-left:50%">
                <?php
                    $query="SELECT count(*), anio FROM proyecto GROUP BY anio ORDER BY anio DESC";
                    $result = pg_query($query);
                    
                    if(isset($_GET['anio'])){
                        while($anios=pg_fetch_assoc($result)){
                            if($_GET['anio']==$anios['anio']){
                ?>
                    <option value="<?= $anios['anio']?>" selected><?=$anios['anio']?></option>
                <?php
                        }else{
                ?>
                    <option value="<?= $anios['anio']?>"><?=$anios['anio']?></option>
                <?php
                        }
                    }
                    }else{
                    ?>
                    <option value="" selected>Seleccionar</option>
                    <?php
                        while($anios=pg_fetch_assoc($result)){
                ?>
                    <option value="<?= $anios['anio']?>"><?=$anios['anio']?></option>
                <?php
                    }}
                ?>
            </select>
        </div>
    </div>
    <div class="wrapper row3">
    <main class="hoc container clear"> 
        <div class="content">
            <div class="scrollable">
            <div class="row mb-3">
            <div class="col-3">
                <form action="list_proyectos.php" method="GET">
                    <!-- <input type="text" placeholder="B??squeda" class="busqueda" id="busqueda" name="busqueda">
                    <button type="submit" class="btn btn-primary">BUSCAR</button> -->
                    <a href="crear_proyecto.php" class="btn btn-secondary">CREAR</a>
                
                    </div>                                
                </form>
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
                        <th>Fecha de Iniciaci??n</th>
                        <th>Fecha de Terminaci??n</th>
                        <th>Fecha de Liquidaci??n</th>
                        <th>Supervisor</th>
                        <th>Direcci??n</th>
                        <th>Telefono Celular</th>
                        <th>Correo</th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    //Paginador
                    if(isset($_GET['anio'])){
                        $sql_register = pg_query("SELECT COUNT(*) as total_registros FROM proyecto WHERE anio = ".$_GET['anio']);
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
                        LEFT JOIN contratista b ON a.contratista_fk = b.id
                        WHERE a.anio = '.$_GET['anio'].'
                        ORDER BY a.id ASC';
                        $query = $query." LIMIT $por_pagina OFFSET $desde";
                        $result = pg_query($query) or die ('La consulta fallo: '. preg_last_error());
                        
                }
                else{
                    $sql_register = pg_query("SELECT COUNT(*) as total_registros FROM proyecto");
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
                    LEFT JOIN contratista b ON a.contratista_fk = b.id
                    ORDER BY a.id ASC';
                    $query = $query." LIMIT $por_pagina OFFSET $desde";
                    $result = pg_query($query) or die ('La consulta fallo: '. preg_last_error());
                    
                }
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
                                <i class="bi bi-pen"></i> Editar 
                            </a>
                            <a href="../controllers/proyectos/delete.php?id=<?php echo $line['id']?>" class="btn-danger">
                            <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </table>
                </div>
            </div>
    </div>
    <div class="m-2">
        <ul class="pagination">
            <?php
            if(isset($_GET['anio'])){
                for ($i=1; $i <= $total_paginas ; $i++) { 
                    if(isset($_GET['pagina'])){
                        if($_GET['pagina']==$i)
                        {
                            echo '<li class="current"><strong>'.$i.'</strong></li>';
                        }
                        else{
                            echo "<li class='page-item'><a class='page-link' href='?pagina=$i&frame=list_proyectos.php&anio=".$_GET['anio']."'>$i</a></li>";
                        }
                    }
                    else{
                        if($i==1){
                            echo '<li class="current"><strong>1</strong></li>';
                        }else{
                            echo "<li class='page-item'><a class='page-link' href='?pagina=$i&frame=list_proyectos.php&anio=".$_GET['anio']."' >$i</a></li>";
                        }
                }}
            }else
            {
                if(!isset($_GET['pagina'])){
            ?>
                    <li class="page-item"><a class="page-link not-active" href="?pagina=<?=$prev?>&frame=list_proyectos.php" >Anterior</a></li>
                    <li class="current"><strong>1</strong></li>
                    <li class="page-item"><a class="page-link not-active" href="#" disabled>...</a></li>
                <?php
                    for ($i=2; $i <= 10 ; $i++) { 
                ?>
                    <li class="page-item"><a class="page-link" href="?pagina=<?=$i?>&frame=list_proyectos.php" ><?=$i?></a></li>    
                <?php
                    }
                ?>
                    <li class="page-item"><a class="page-link not-active" href="?pagina=<?=$total_paginas?>&frame=list_proyectos.php" >...</a></li>
                    <li class="page-item"><a class="page-link" href="?pagina=<?=$total_paginas?>&frame=list_proyectos.php" ><?=$total_paginas?></a></li>
                    <li class="page-item"><a class="page-link" href="?pagina=<?=2?>&frame=list_proyectos.php" >Siguiente</a></li>
                <?php
            }else{
                $pag = $_GET['pagina'];
                if($pag!=1){
                    echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag-1).'&frame=list_proyectos.php">Anterior</a></li>';
                }
                else{
                    echo "<li class='page-item'><a class='page-link not-active' href='?pagina=$pag&frame=list_proyectos.php'>Anterior</a></li>";
                }
                if($pag!=1)
                {
                    echo '<li class="page-item"><a class="page-link" href="?pagina=1&frame=list_proyectos.php">1</a></li>';
                    echo '<li class="page-item"><a class="page-link not-active" href="#" disabled>...</a></li>';
                }
                if($pag<=5 AND $pag>=2){
                    $init = $pag-2;
                }
                else{
                    $init = 4;
                }
                for ($i=$init;$i>=1;$i--) { 
                    if($pag>=2)
                    {
                        echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag-$i).'&frame=list_proyectos.php" >'.($pag-$i).'</a></li>';
                    }}

                    echo '<li class="current"><strong>'.$pag.'</strong></li>';

                if($pag>=($total_paginas-4) AND $pag<=($total_paginas-1)){
                    $end = $pag+1;
                    $end = $total_paginas - $end;
                }
                else{
                    $end = 4;
                }
                for ($i=1; $i <= $end; $i++) { 
                    if($pag<=($total_paginas-2))
                    {
                        echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag+$i).'&frame=list_proyectos.php" >'.($pag+$i).'</a></li>';           
                    }
                }
                if($pag!=$total_paginas){
                    echo '<li class="page-item"><a class="page-link not-active" href="?pagina='.$total_paginas.'&frame=list_proyectos.php" >...</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?pagina='.$total_paginas.'&frame=list_proyectos.php" >'.$total_paginas.'</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag+1).'&frame=list_proyectos.php" >Siguiente</a></li>';
                }else{
                    echo '<li class="page-item"><a class="page-link not-active" href="?pagina='.($pag+1).'&frame=list_proyectos.php">Siguiente</a></li>';     
                }
            }
            }
            ?>
        </ul>
    </div>
</div>
    <!-- <script>
        $(function(){
            $("p").click(function(event){
                alert("evento click")
            });
        });
    </script> -->

<!-- Paginador -->

</div>
</tbody>
<?php 
    include('footer.php');
    ?>
<script type="text/javascript" src="../functions.js"></script>