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
    <div class="wrapper row2">
        <div class="row">
            <select name="" id="search_anio_certificado" class="form-select" style="margin-left:50%">
                <?php
                    $query="SELECT count(*), c.anio 
                    FROM certificado_disponibilidad a 
                    INNER JOIN contrato b ON b.id = a.contrato_fk
                    INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
                    GROUP BY c.anio ORDER BY c.anio DESC";
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
                <form action="buscar.php" method="GET">
                    <!-- <input type="text" placeholder="Búsqueda" class="busqueda" id="busqueda" name="busqueda">
                    <button type="submit" class="btn btn-primary">Buscar</button> -->
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
            if(isset($_GET['anio'])){
                $sql_register = pg_query("
                SELECT COUNT(*) as total_registros 
                FROM certificado_disponibilidad a 
                INNER JOIN contrato b ON b.id = a.contrato_fk
                INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
                WHERE c.anio = ".$_GET['anio']);
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
                    WHERE c.anio = ".$_GET['anio']."
                    ORDER BY a.id ASC";
                $query = $query." LIMIT $por_pagina OFFSET $desde";
            }else{
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
            }
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
            if(isset($_GET['anio'])){
                for ($i=1; $i <= $total_paginas ; $i++) { 
                    if(isset($_GET['pagina'])){
                        if($_GET['pagina']==$i)
                        {
                            echo '<li class="current"><strong>'.$i.'</strong></li>';
                        }
                        else{
                            echo "<li class='page-item'><a class='page-link' href='?pagina=$i&frame=list_certificado.php&anio=".$_GET['anio']."'>$i</a></li>";
                        }
                    }
                    else{
                        if($i==1){
                            echo '<li class="current"><strong>1</strong></li>';
                        }else{
                            echo "<li class='page-item'><a class='page-link' href='?pagina=$i&frame=list_certificado.php&anio=".$_GET['anio']."' >$i</a></li>";
                        }
                }}
            }else
            {
                if(!isset($_GET['pagina'])){
            ?>
                <li class="page-item"><a class="page-link not-active" href="?pagina=<?=$prev?>&frame=list_certificado.php" >Anterior</a></li>
                <li class="current"><strong>1</strong></li>
                <li class="page-item"><a class="page-link not-active" href="#" disabled>...</a></li>
            <?php
                for ($i=2; $i <= 10 ; $i++) { 
            ?>
                <li class="page-item"><a class="page-link" href="?pagina=<?=$i?>&frame=list_certificado.php" ><?=$i?></a></li>    
            <?php
                }
            ?>
                <li class="page-item"><a class="page-link not-active" href="?pagina=<?=$total_paginas?>&frame=list_certificado.php" >...</a></li>
                <li class="page-item"><a class="page-link" href="?pagina=<?=$total_paginas?>&frame=list_certificado.php" ><?=$total_paginas?></a></li>
                <li class="page-item"><a class="page-link" href="?pagina=<?=2?>&frame=list_certificado.php" >Siguiente</a></li>
            <?php
            }else{
                $pag = $_GET['pagina'];
                if($pag!=1){
                    echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag-1).'&frame=list_certificado.php">Anterior</a></li>';
                }
                else{
                    echo "<li class='page-item'><a class='page-link not-active' href='?pagina=$pag&frame=list_certificado.php'>Anterior</a></li>";
                }
                if($pag!=1)
                {
                    echo '<li class="page-item"><a class="page-link" href="?pagina=1&frame=list_certificado.php">1</a></li>';
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
                        echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag-$i).'&frame=list_certificado.php" >'.($pag-$i).'</a></li>';
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
                        echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag+$i).'&frame=list_certificado.php" >'.($pag+$i).'</a></li>';           
                    }
                }
                if($pag!=$total_paginas){
                    echo '<li class="page-item"><a class="page-link not-active" href="?pagina='.$total_paginas.'&frame=list_certificado.php" >...</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?pagina='.$total_paginas.'&frame=list_certificado.php" >'.$total_paginas.'</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag+1).'&frame=list_certificado.php" >Siguiente</a></li>';
                }else{
                    echo '<li class="page-item"><a class="page-link not-active" href="?pagina='.($pag+1).'&frame=list_certificado.php">Siguiente</a></li>';     
                }
            }
            }
            ?>
            
        </ul>
    </nav>
</div>
</div>
</div>
</tbody>
<?php include('footer.php');?>
<script type="text/javascript" src="../functions.js"></script>