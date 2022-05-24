<?php
include('../config/db.php');
include('includes/header.php');
include('includes/styles.php');
include('includes/jquery.php');
include('includes/scripts.php');
include_once '../config/user_session.php';
$userSession = new UserSession();
if( !isset($_SESSION['user'])){
    header("Location: login.php");
}
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
                    <a href="crear_seguimiento.php" class="btn btn-secondary">AÑADIR</a>
                </div>
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
            if($_GET['group'] != null){
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
                INNER JOIN contrato b ON b.id = a.obra_contrato_fk
                INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
                INNER JOIN contratista d ON d.id = c.contratista_fk
                INNER JOIN coordenadas e ON e.id = a.se_coordenada_fk
                WHERE c.group_seguimiento ='".$_GET['group']."'";
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
                INNER JOIN contrato b ON b.id = a.obra_contrato_fk
                INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
                INNER JOIN contratista d ON d.id = c.contratista_fk
                INNER JOIN coordenadas e ON e.id = a.se_coordenada_fk
                WHERE c.group_seguimiento is null";
            }
            
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
                        <i class="bi bi-pen"></i>
                    </a>                    
                    <a href="../controllers/seguimiento/delete.php?id=<?php echo $line[0]?>" class="btn btn-danger">
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