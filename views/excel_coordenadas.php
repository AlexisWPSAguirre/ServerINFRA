<?php 
header("Pragma: public");
header("Expires: 0");
$filename = "nombreArchivoQueDescarga.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
?>
<table>
<tbody>
<tr>
ID_BPIN|NOMBRE_PROYECTO|UNIDAD_FUNCIONAL_ACUERDO_OBRA |NUM_CONTRATO |LATITUD|LONGITUD|LATITUD_INICIAL|LATITUD_FINAL|LONGITUD_INICIAL|LONGITUD_FINAL
</tr>
<tr>
    <?php
        include('../config/db.php');
        $query ="
        SELECT 
        b.no_contrato,
        c.no_proyecto,
        a.hito,
        a.fecha_hito,
        a.detalle_hito,
        a.valor_adiciones_hito,
        a.dias_hito
        FROM hitos a
        INNER JOIN contrato b ON b.id = a.contrato_fk
        INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
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