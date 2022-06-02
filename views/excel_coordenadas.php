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
ID_BPIN|NOMBRE_PROYECTO|UNIDAD_FUNCIONAL_ACUERDO_OBRA |NUM_CONTRATO |LATITUD|LONGITUD|LATITUD_INICIAL|LATITUD_FINAL|LONGITUD_INICIAL|LONGITUD_FINAL
</tr>
<tr>
    <?php
        include('../config/db.php');
        if(!empty($_GET['group'])){
            $query ="
            SELECT
            c.no_proyecto,
            c.objeto,
            c.objeto,
            b.no_contrato,
            a.latitud,
            a.longitud,
            a.latitud_inicial,
            a.latitud_final,
            a.longitud_inicial,
            a.longitud_final
            FROM coordenadas a
            LEFT JOIN contrato b ON b.id = a.coo_contrato_fk
            LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk
            WHERE c.group_coordenadas_fk ='".$_GET['group']."'";
        }
        else{
            $query ="
            SELECT
            c.no_proyecto,
            c.objeto,
            c.objeto,
            b.no_contrato,
            a.latitud,
            a.longitud,
            a.latitud_inicial,
            a.latitud_final,
            a.longitud_inicial,
            a.longitud_final
            FROM coordenadas a
            LEFT JOIN contrato b ON b.id = a.coo_contrato_fk
            LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk
            WHERE c.group_coordenadas_fk is null";
        }
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