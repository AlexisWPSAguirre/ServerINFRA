<?php
include('../config/db.php');
include('includes/jquery.php');
?>
<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
          <div class="sectiontitle">
              <h6 class="heading">Matriz Contratos</h6>
          </div>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<div class="wrapper row2">
        <div class="row">
            <select name="" id="search_anio" class="form-select" style="margin-left:50%">
                <?php
                    $query="SELECT count(*), b.anio FROM contrato a 
                    INNER JOIN proyecto b ON b.id = a.no_proyecto_fk
                    GROUP BY anio ORDER BY anio DESC";
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
                        }}
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
                    <button type="submit" class="btn btn-primary">BUSCAR</button> -->
                    <?php
                        if(!isset($_GET['gr_sel']) AND !isset($_GET['select'])){
                    ?>
                    <a href="crear_contratos.php" class="btn btn-secondary">CREAR</a>
                    <?php
                        }
                    ?>
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
            if(isset($_GET['anio'])){
                $sql_register = pg_query("SELECT COUNT(*) as total_registros 
                FROM contrato a
                INNER JOIN proyecto b ON b.id = a.no_proyecto_fk
                WHERE b.anio = ".$_GET['anio']);
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
                LEFT JOIN proyecto b ON b.id = a.no_proyecto_fk
                WHERE b.anio ='.$_GET['anio'].'
                ORDER BY a.id ASC';
                $query = $query." LIMIT $por_pagina OFFSET $desde";
                $result = pg_query($query) or die ('La consulta fallo: '. preg_last_error());
            }else{
                $sql_register = pg_query("SELECT COUNT(*) as total_registros FROM contrato");
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
                LEFT JOIN proyecto b ON b.id = a.no_proyecto_fk
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
                    if(isset($_GET['select'])){
                        switch ($_GET['select']) {
                            case 'hito':
                                echo '<a href="crear_hito.php?id='.$line['id'].'&pro_id='.$line['proyecto_id'].'&gr_new=TRUE" class="btn">
                                Seleccionar 
                                </a>';
                                break;
                            case 'coordenada':
                                echo '<a href="crear_coordenadas.php?id= '.$line['id'].'&pro_id='.$line['proyecto_id'].'&gr_new=TRUE" class="btn btn-secondary mb-1">
                                Seleccionar 
                                </a>';
                                break;
                            case 'seguimiento':
                                echo '<a href="crear_seguimiento.php?id= '.$line['id'].'&pro_id='.$line['proyecto_id'].'&gr_new=TRUE" class="btn btn-secondary mb-1">
                                Seleccionar 
                                </a>';
                                break;
                            }
                    }
                    else {
                        
                        if(isset($_GET['gr_sel'])){
                            switch($_GET['gr_sel']){
                                case 'hito':
                                    
                                ?>
                                <a href="crear_hito.php?id=<?php echo $line['id']?>&pro_id=<?php echo $line['proyecto_id']?>" class="btn btn-secondary mb-1">
                                Seleccionar 
                                </a>
                                <?php
                                    break;
                                case 'coordenada':  
                                ?>
                                <a href="crear_coordenadas.php?id=<?php echo $line['id']?>&pro_id=<?php echo $line['proyecto_id']?>" class="btn btn-secondary mb-1">
                                Seleccionar 
                                </a>
                                <?php
                                    break;
                                case 'seguimiento':
                                ?>
                                <a href="crear_seguimiento.php?id=<?php echo $line['id']?>&pro_id=<?php echo $line['proyecto_id']?>" class="btn btn-secondary mb-1">
                                Seleccionar 
                                </a>
                                <?php
                                    break;
                            }
                    ?>
                    <?php
                            }else{
                    ?>
                            <a href="edit_contratos.php?id=<?php echo $line['id']?>" class="btn btn-secondary mb-1">
                                Editar
                            </a>
                            <a href="../controllers/contratos/delete.php?id=<?php echo $line['id']?>" class="btn-danger">
                                Eliminar
                            </a>
                    <?php                               
                        }
                    }
                    ?>
                    </td>
            </tr>
        <?php } ?>
        </table>
        </div>
    </div>
</div>

</tbody>
<!-- Paginador -->
<div class="container">
    <nav class="pagination">
        <ul>
            <?php
            if(isset($_GET['anio'])){
                for ($i=1; $i <= $total_paginas ; $i++) { 
                $prev = $i-1;
                if(isset($_GET['select'])){
                    switch ($_GET['select']) {
                        case 'hito':
                            echo '<li><a href="?pagina='.$i.'&select=hito&frame=list_contratos.php&anio='.$_GET['anio'].' class="m-2">'.$i.'                            
                            </a></li>';
                            break;
                        case 'coordenada':
                            echo '<li><a href="?pagina='.$i.'&select=coordenada&frame=list_contratos.php&anio='.$_GET['anio'].'" class="m-2">'.$i.'                            
                            </a></li>';
                            break;
                        case 'seguimiento':
                            echo '<li><a href="?pagina='.$i.'&select=seguimiento&frame=list_contratos.php&anio='.$_GET['anio'].'" class="m-2">'.$i.'                            
                            </a></li>';
                            break;
                        }
                }
                else
                {
            ?>
                <li><a href="?pagina=<?=$i?>&frame=list_contratos.php" class="m-2"><?=$i?></a></li>
            <?php
                }
                }
            }else{
                for ($i=1; $i <= $total_paginas ; $i++) { 
                    $prev = $i-1;
                    if(isset($_GET['select'])){
                        switch ($_GET['select']) {
                            case 'hito':
                                echo '<li><a href="?pagina='.$i.'&select=hito&frame=list_contratos.php" class="m-2">'.$i.'                            
                                </a></li>';
                                break;
                            case 'coordenada':
                                echo '<li><a href="?pagina='.$i.'&select=coordenada&frame=list_contratos.php" class="m-2">'.$i.'                            
                                </a></li>';
                                break;
                            case 'seguimiento':
                                echo '<li><a href="?pagina='.$i.'&select=seguimiento&frame=list_contratos.php" class="m-2">'.$i.'                            
                                </a></li>';
                                break;
                            }
                    }
                    else{
                ?>
                    <li><a href="?pagina=<?=$i?>&frame=list_contratos.php" class="m-2"><?=$i?></a></li>
                <?php
                    }
                    }
            }
            ?>
        </ul>
    </nav>
</div>
</div>
<script type="text/javascript" src="../functions.js"></script>
<?php include('footer.php');?>