<?php 
header("Pragma: public");
header("Expires: 0");
$filename = "MATRIZ SEGUIMIENTO OBRA 2021.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
?>
<table>
<tbody>
<tr>
ID_BPIN|ID|SECTOR|MUNICIPIO_OBRA|DEPARTAMENTO_OBRA|NOMBRE_PROYECTO|CODIGO_DIVIPOLA_MUNICIPIO|OBJETO_PROYECTO|
UNIDAD_FUNCIONAL_ACUERDO_OBRA|FECHA_INICIO|FECHA_INICIAL_TERMINACION|FECHA_FINAL_TERMINACION
|VALOR_CONTRATO_INICIAL|VALOR_CONTRATO_FINAL|AVANCE_FISICO_INICIAL|AVANCE_FISICO_EJECUTADO|
AVANCE_FINANCIERO_EJECUTADO|NUM_CONTRATO|CANTIDAD_SUSPENSIONES|CANTIDAD_PRORROGAS|TIEMPO_SUSPENSIONES
|TIEMPO_PRORROGAS|CANTIDAD_ADICIONES|VALOR_TOTAL_ADICIONES|ORIGEN_RECURSOS|VALOR_COMPROMETIDO|VALOR_OBLIGADO
|VALOR_PAGADO|VALOR_ANTICIPO|LATITUD|LONGITUD|LATITUD_INICIAL|LATITUD_FINAL|LONGITUD_INICIAL|LONGITUD_FINAL
|ESTADO|NOMBRE_CONTRATISTA|NIT_CONTRATISTA|CESION|NUEVO_CONTRATISTA|OBSERVACIONES|LINK_SECOP
</tr>
<tr>
    <?php
        include('../config/db.php');
        $query ="
        SELECT
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
        LEFT JOIN coordenadas e ON e.coo_contrato_fk = b.id
        WHERE c.group_entrada ='".$_GET['group']."'";
        $result = pg_query($query);
        while($line=pg_fetch_row($result)){
    ?>
    <tr>
        <?php
            for ($i=0; $i < count($line)  ; $i++) { 
                echo $line[$i]."|";
            }
        }
        ?>
    </tr>
</tbody>
</table>