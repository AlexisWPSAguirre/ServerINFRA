<?php
include('../config/db.php');
include_once "full-width.php";

?>
<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
          <div class="sectiontitle">
              <h6 class="heading">Matriz Seguimiento</h6>
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
                    <a href="crear_seguimiento.php" class="btn btn-secondary">AÑADIR</a>
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
                <th>ID_BPIN</th>
                <th>ID_CONTRATO</th>
                <th>SECTOR</th>
                <th>MUNICIPIO_OBRA</th>
                <th>DEPARTAMENTO_OBRA</th>
                <th>NOMBRE_PROYECTO</th>
                <th>CODIGO_DIVIPOLA_MUNICIPIO</th>
                <th>OBJETO_PROYECTO</th>
                <th>UNIDAD_FUNCIONAL_ACUERDO_OBRA</th>
                <th>FECHA_INICIO</th>
                <th>FECHA_INICIAL_TERMINACION</th>
                <th>FECHA_FINAL_TERMINACION</th>
                <th>VALOR_CONTRATO_INICIAL</th>
                <th>VALOR_CONTRATO_FINAL</th>
                <th>AVANCE_FISICO_INICIAL</th>
                <th>AVANCE_FISICO_EJECUTADO</th>
                <th>AVANCE_FINANCIERO_EJECUTADO</th>
                <th>NUM_CONTRATO</th>
                <th>CANTIDAD_SUSPENSIONES</th>
                <th>CANTIDAD_PRORROGAS</th>
                <th>TIEMPO_SUSPENSIONES</th>
                <th>TIEMPO_PRORROGAS</th>
                <th>CANTIDAD_ADICIONES</th>
                <th>VALOR_TOTAL_ADICIONES</th>
                <th>ORIGEN_RECURSOS</th>
                <th>VALOR_COMPROMETIDO</th>
                <th>VALOR_OBLIGADO</th>
                <th>VALOR_PAGADO</th>
                <th>VALOR_ANTICIPO</th>
                <th>LATITUD</th>
                <th>LONGITUD</th>
                <th>LATITUD_INICIAL</th>
                <th>LATITUD_FINAL</th>
                <th>LONGITUD_INICIAL</th>
                <th>LONGITUD_FINAL</th>
                <th>ESTADO</th>
                <th>NOMBRE_CONTRATISTA</th>
                <th>NIT_CONTRATISTA</th>
                <th>CESION</th>
                <th>NUEVO_CONTRATISTA</th>
                <th>OBSERVACIONES</th>
                <th>LINK_SECOP</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php 
            //Paginador
            if($_GET['group']!=''){
                $sql_register = pg_query("
                SELECT COUNT(*) as total_registros 
                FROM obras a
                LEFT JOIN contrato b ON b.id = a.obra_contrato_fk
                LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk
                LEFT JOIN contratista d ON d.id = c.contratista_fk
                LEFT JOIN coordenadas e ON e.id = a.se_coordenada_fk
                WHERE c.group_seguimiento_fk ='".$_GET['group']."'");
            }else{
                $sql_register = pg_query("
                SELECT COUNT(*) as total_registros 
                FROM obras a
                LEFT JOIN contrato b ON b.id = a.obra_contrato_fk
                LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk
                LEFT JOIN contratista d ON d.id = c.contratista_fk
                LEFT JOIN coordenadas e ON e.id = a.se_coordenada_fk
                WHERE c.group_seguimiento_fk is null");
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
                a.id,
                c.no_proyecto,
                b.no_contrato,
                a.sector,
                a.municipio_obra,
                a.departamento_obra,
                c.objeto,
                a.codigo_divipola_municipio,
                c.objeto,
                a.unidad_funcional_acuerdo_obra,
                a.fecha_inicio,
                a.fecha_inicial_terminacion,
                a.fecha_final_terminacion,
                a.valor_inicial,
                a.valor_final,
                a.avance_fisico_inicial,
                a.avance_fisico_ejecutado,
                a.avance_financiero_ejecutado,
                b.no_contrato,
                a.cantidad_suspensiones,
                a.cantidad_prorrogas,
                a.tiempo_suspensiones,
                a.tiempo_prorrogas,
                a.cantidad_adiciones,
                a.valor_total_adiciones,
                a.origen_recursos,
                a.valor_comprometido,
                a.valor_obligado,
                a.valor_pagado,
                a.valor_anticipo,
                e.latitud,
                e.longitud,
                a.latitud_inicial,
                a.latitud_final,
                e.longitud_inicial,
                a.longitud_final,
                a.estado,
                d.nombre,
                d.nit,
                a.cesion,
                a.nuevo_contratista,
                a.observaciones,
                a.link_secop
                FROM obras a
                LEFT JOIN contrato b ON b.id = a.obra_contrato_fk
                LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk
                LEFT JOIN contratista d ON d.id = c.contratista_fk
                LEFT JOIN coordenadas e ON e.id = a.se_coordenada_fk
                WHERE c.group_seguimiento_fk ='".$_GET['group']."'
                ORDER BY a.id ASC";
            }
            else
            {
                $query ="
                SELECT
                a.id,
                c.no_proyecto,
                b.no_contrato,
                a.sector,
                a.municipio_obra,
                a.departamento_obra,
                c.objeto,
                a.codigo_divipola_municipio,
                c.objeto,
                a.unidad_funcional_acuerdo_obra,
                a.fecha_inicio,
                a.fecha_inicial_terminacion,
                a.fecha_final_terminacion,
                a.valor_inicial,
                a.valor_final,
                a.avance_fisico_inicial,
                a.avance_fisico_ejecutado,
                a.avance_financiero_ejecutado,
                b.no_contrato,
                a.cantidad_suspensiones,
                a.cantidad_prorrogas,
                a.tiempo_suspensiones,
                a.tiempo_prorrogas,
                a.cantidad_adiciones,
                a.valor_total_adiciones,
                a.origen_recursos,
                a.valor_comprometido,
                a.valor_obligado,
                a.valor_pagado,
                a.valor_anticipo,
                e.latitud,
                e.longitud,
                a.latitud_inicial,
                a.latitud_final,
                e.longitud_inicial,
                a.longitud_final,
                a.estado,
                d.nombre,
                d.nit,
                a.cesion,
                a.nuevo_contratista,
                a.observaciones,
                a.link_secop
                FROM obras a
                LEFT JOIN contrato b ON b.id = a.obra_contrato_fk
                LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk
                LEFT JOIN contratista d ON d.id = c.contratista_fk
                LEFT JOIN coordenadas e ON e.id = a.se_coordenada_fk
                WHERE c.group_seguimiento_fk is null
                ORDER BY a.id ASC";
            }
            
            $query = $query." LIMIT $por_pagina OFFSET $desde";
            $result = pg_query($query);
            while($line=pg_fetch_row($result)){
        ?>
            <tr>
            <?php
            for ($i=0; $i < count($line)  ; $i++) { 
                echo "<td>".$line[$i]."</td>";
            }
        ?>
                <td>
                    <?php
                        $_SESSION['group_seguimiento'] = $_GET['group'] ;
                    ?>
                    <a href="edit_seguimiento.php?id=<?php echo $line[0]?>" class="btn btn-secondary mb-1">
                        Editar
                    </a>                    
                    <a href="../controllers/seguimiento/delete.php?id=<?php echo $line[0]?>" class="btn-danger">
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
                <li><a href="?pagina=<?=$i?>&group=<?= $_SESSION['group_seguimiento']?>" class="m-2"><?=$i?></a></li>
            <?php
                }
            ?>
        </ul>
    </nav>
</div>

</div>
</tbody>
<?php include('footer.php');?>