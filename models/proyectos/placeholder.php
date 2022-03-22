<?php
    include ('../../config/db.php')
    $query = 'SELECT
    a.id,
    a.no_proyecto,
    a.proceso,
    a.fecha_iniciacion,
    a.fecha_terminacion,
    a.fecha_liquidacion,
    a.supervision_interventoria,
    b.nombre,
    b.nit
    FROM proyecto a 
    INNER JOIN contratista b ON b.id = a.contratista_fk
    WHERE a.id = $id';
    $result = pg_query($query) or die ('La consulta fallo: '. preg_last_error());
?>