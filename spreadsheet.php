<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<?php
    $dbconn = pg_connect('host=localhost dbname=inf_contra user=postgres password=21372') or die ('No se ha podido conectar '. preg_last_error());  
    require 'vendor/autoload.php';
    class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
    {
        public function readCell($column, $row, $worksheetName = '') {
            if ($row>0) {
                return true;
            }
            return false;
        }
    }
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    $inputFileName = 'SEGUIMIENTO2021.xlsx';
    /**  Identify the type of $inputFileName  **/
    $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
    /**  Create a new Reader of the type that has been identified  **/
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    /**  Load $inputFileName to a Spreadsheet Object  **/
    $reader->setReadFilter(new MyReadFilter());

    $spreadsheet = $reader->load($inputFileName);
    $cantidad = $spreadsheet->getActiveSheet()->toArray();
?>


<body>

<?php
    /*
    import_seguimiento();
    import_coordenadas();
    import_hitos();
    import_rubros();
    import_contratos();
    import_proyectos(); 
    import_contratistas();
     */
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php
    function import_rubros(){
        global $cantidad;
        /* Las columnas de la relación 2021: 
	    6 - rubro
        9 - valor
        13 - fuentes
        29 - anticipo
        subconsulta(contrato_fk)  0 - contrato
	    */
        $columns = array('6','9','13','29','0');
        echo '<table class="table table-striped">';
        for ($i=4; $i < count($cantidad) ; $i++) {
            echo '<tr>';
            foreach ($columns as $key) {
                if($cantidad[$i][$key]!=''){
                    foreach($columns as $ki){
                        $count = 0;
                        if($ki=='0' AND $cantidad[$i][$ki]==''){
                            do {
                                $count += 1;
                            } while ($cantidad[($i-$count)][$ki]=='');
                            echo '<td>'.$cantidad[($i-$count)][$ki].'</td>';
                        }
                            echo '<td>'.$cantidad[$i][$ki].'</td>';
                    }
                    break;
                }
            }
            echo '</tr>';
        }
        echo '</table>';  
        /* ------------------------------------------------------------- */
        /* Carga los registros a la BD SQL */
        for ($i=4; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                if($cantidad[$i][$key]!=''){
                    $query = 'INSERT INTO certificado_disponibilidad(rubro,valor,fuente_recursos,anticipo,contrato_fk) VALUES(';
                    foreach($columns as $ki){
                        $count = 0;
                        if($ki=='0'){
                            if($cantidad[$i][$ki]==''){
                                do {
                                    $count += 1;
                                } while ($cantidad[($i-$count)][$ki]=='');
                                $cantidad[$i][$ki]=$cantidad[($i-$count)][$ki];
                            }
                            $query = $query."(SELECT id FROM contrato WHERE no_contrato ='".$cantidad[$i][$ki]."' LIMIT 1))";
                            break;
                        }
                        $query = $query."'".$cantidad[$i][$ki]."',";
                    }
                    echo '<p>'.$query.'</p>';
                    /* $result = pg_query($query);  */
                    break;
                }
            }
        }
    }
    
    function import_contratos(){
        global $cantidad;
        /* Las columnas de la relación 2021: 
	    0 - no_contrato
        19 - valor_contrato
	    subconsulta(no_proyecto_fk) 1 - no_proyecto
	    7 - no_certificado
	    11 - registro_presupuestal
	    14 - fecha_presupuestal
	    10 - fecha_firma
	    16 - f_aprob_polizas
	    8 - fecha_certificado
	    */
        $columns = array('0','7','8','10','11','14','16','1');
        /* Muestra en página html */
        echo '<table class="table table-striped">';
        for ($i=4; $i < count($cantidad) ; $i++) {
            echo '<tr>';
            foreach ($columns as $key) {
                if($cantidad[$i][$key]!=''){
                    foreach($columns as $ki){
                        $count = 0;
                        /* if($ki=='1' AND $cantidad[$i][$ki]==''){
                            do {
                                $count += 1;
                            } while ($cantidad[($i-$count)][$ki]=='');
                            echo '<td>'.$cantidad[($i-$count)][$ki].'</td>';
                        }
                        else{   
                            echo '<td>'.$cantidad[$i][$ki].'</td>';
                        } */
                    }
                    break;
                }
            }
            echo '</tr>';
        }
        echo '</table>'; 
        /* ------------------------------------------------------------- */
        /* Carga los registros a la BD SQL */
        for ($i=4; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                if($cantidad[$i][$key]!=''){
                    $query = 'INSERT INTO contrato(no_contrato,no_certificado,fecha_certificado,fecha_firma,no_presupuestal,
                    fecha_presupuestal,f_aprob_polizas,no_proyecto_fk) VALUES(';
                    foreach($columns as $ki){
                        $count = 0;
                        if($ki=='16'){
                            if($cantidad[$i][1]==''){
                                do {
                                    $count += 1;
                                } while ($cantidad[($i-$count)][1]=='');
                                $cantidad[$i][1]=$cantidad[($i-$count)][1];
                            }
                            $query = $query."'".$cantidad[$i][$ki]."',(SELECT id FROM proyecto WHERE no_proyecto ='".$cantidad[$i][1]."' LIMIT 1))";
                            break;
                        }
                        $query = $query."'".$cantidad[$i][$ki]."',";
                    }
                    /* $result = pg_query($query); */
                    break;
                }
            }
        }
    }

    function import_contratistas(){
        //IMPRIME
        global $cantidad;
        echo '<table class="table table-striped">';
        /* Columnas 4 y 5 de RELACION 2021
        4 -> NOMBRE CONTRATISTA
        5 -> NIT
        */
        $j = 4;
        for ($i=4; $i < count($cantidad) ; $i++) {
            echo '<tr>';
            if(val_empty($i,$j)==1 OR val_empty($i,($j+1))==1)
            {
                    echo
                    '<td>'.$cantidad[$i][$j].
                    '</td>';
                    echo 
                    '<td>'.$cantidad[$i][($j+1)].
                    '</td>';
            }
            echo '</tr>';
        }
        echo '</table>'; 
        $j=4;
        $count = 0;

        /*
        for ($i=4; $i < count($cantidad) ; $i++) {
                if(val_empty($i,$j)==1 OR val_empty($i,($j+1))==1)
                {
                    COMPROBAR EL TIPO DE ERROR (UNIQUE) 
                    $query = "SELECT * FROM contratista WHERE nit ='".$cantidad[$i][($j+1)]."'";
                    $result = pg_query($query);
                    $line = pg_fetch_row($result);
                    $query = "INSERT INTO contratista(nombre,nit) VALUES('".$cantidad[$i][$j]."','".$cantidad[$i][($j+1)]."')";
                    $result = pg_query($query);
                }
            }
            */
    };

    function import_proyectos(){
        global $cantidad;
        $index = 0;
        $columns = array('1','3','17','25','26','28','2');
        /* Las columnas de la relación 2021: 
        1 - No_proyecto
        3 - proceso
        17 - fecha_iniciacion
        25 - fecha_terminacion
        26 - fecha_liquidacion
        28 - supervision_interventoria
        2 - objeto
        k - anio
        subconsulta - 5 - contratista_fk
        */

        /* Muestra en página html */
        echo '<table class="table table-striped">';
        for ($i=4; $i < count($cantidad) ; $i++) {
            echo '<tr>';
            foreach ($columns as $key) {
                if($cantidad[$i][$key]!=''){
                    foreach($columns as $key){
                        echo '<td>'.$cantidad[$i][$key].'</td>';
                    }
                    break;
                }
            }
            echo '</tr>';
        }
        echo '</table>'; 
        /* ------------------------------------------------------------- */
        /* Carga los registros a la BD SQL */
        $anio = '2021';
        for ($i=4; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                if($cantidad[$i][$key]!=''){
                    $query = 'INSERT INTO proyecto(no_proyecto,proceso,fecha_iniciacion,fecha_terminacion,fecha_liquidacion,
                    supervision_interventoria,objeto,anio,contratista_fk) VALUES(';
                    foreach($columns as $ki){
                        if($ki=='2'){
                            $query = $query."'".$cantidad[$i][$ki]."',$anio,(SELECT id FROM contratista WHERE nit ='".$cantidad[$i][5]."' LIMIT 1))";
                            break;
                        }
                        /* if($ki=='17' OR $ki=='25' OR $ki=='26'){
                            $cantidad[$i][$ki] = str_replace("/","-",$cantidad[$i][$ki]);
                            $cantidad[$i][$ki] = date("Y-m-d",strtotime($cantidad[$i][$ki]));
                            print $cantidad[$i][$ki];
                        } */
                        $query = $query."'".$cantidad[$i][$ki]."',";
                    }
                    $result = pg_query($query); 
                    break;
                }
            }
        }
    }

    function val_empty($a,$b){
        global $cantidad;
        if($cantidad[$a][$b]!='NULL' AND $cantidad[$a][$b]!=''){
            return true;
        }
        else{
            return false;
        }
    }

    function import_hitos(){
        global $cantidad;
        /* Las columnas de hitos 2021: 
        subconsulta(id contrato) 0 - contrato_fk
        3 - hito
        4 - fecha_hito
        5 - detalle_hito
        6 - valor_adiciones_hito
        7 - dias_hito
	    */
        $columns = array('3','4','5','6','7','0');
        /* Muestra en página html */
        echo '<table class="table table-striped">';
        for ($i=4; $i < count($cantidad) ; $i++) {
            echo '<tr>';
            foreach ($columns as $key) {
                if($cantidad[$i][$key]!=''){
                    foreach($columns as $ki){
                        $count = 0;
                        /* if($ki=='1' AND $cantidad[$i][$ki]==''){
                            do {
                                $count += 1;
                            } while ($cantidad[($i-$count)][$ki]=='');
                            echo '<td>'.$cantidad[($i-$count)][$ki].'</td>';
                        }
                        else{   
                            echo '<td>'.$cantidad[$i][$ki].'</td>';
                        } */
                    }
                    break;
                }
            }
            echo '</tr>';
        }
        echo '</table>'; 
        /* ------------------------------------------------------------- */
        /* Carga los registros a la BD SQL */
        for ($i=4; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                if($cantidad[$i][$key]!=''){
                    $query = 'INSERT INTO hitos(hito,fecha_hito,detalle_hito,valor_adiciones_hito,dias_hito,
                    contrato_fk) VALUES(';
                    foreach($columns as $ki){
                        if($ki=='7'){
                            $cantidad[$i][0] = str_replace("-","/",$cantidad[$i][0]);
                            $query = $query."'".$cantidad[$i][$ki]."',(SELECT id FROM contrato WHERE no_contrato LIKE '%".$cantidad[$i][0]."%' LIMIT 1))";
                            break;
                        }
                        $query = $query."'".$cantidad[$i][$ki]."',";
                    }
                }
                PRINT($query);
                $result = pg_query($query);
                break;
            }
        }
        
    }

    function import_coordenadas(){
        global $cantidad;
        /* Las columnas de coordenadas 2021: 
        subconsulta(id contrato) 3 - contrato_fk
        4 - latitud
        5 - longitud    
        6 - latitud_inicial
        7 - latitud_final
        8 - longitud_inicial
        9 - longitud_final
	    */
        $columns = array('4','5','6','7','8','9','3');
        /* Carga los registros a la BD SQL */
        for ($i=4; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                    if($cantidad[$i][0]!=''){
                        $query = 'INSERT INTO coordenadas(latitud,longitud,latitud_inicial,latitud_final,longitud_inicial,
                        longitud_final,coo_contrato_fk) VALUES(';
                        foreach($columns as $ki){
                            $cantidad[$i][$ki] = str_replace("'","`",$cantidad[$i][$ki]);
                            if($ki=='9'){
                                $cantidad[$i][3] = str_replace("-","/",$cantidad[$i][3]);
                                $query = $query."'".$cantidad[$i][$ki]."',(SELECT id FROM contrato WHERE no_contrato LIKE '%".$cantidad[$i][3]."%' LIMIT 1))";
                                break;
                            }
                            $query = $query."'".$cantidad[$i][$ki]."',";
                        }
                        PRINT($query);
                        echo "<hr>";
                        $result = pg_query($query);
                        break;
                    }
            }
        }
        
    }
    
    function import_seguimiento(){
        global $cantidad;
        /* Las columnas de coordenadas 2021: 
        subconsulta(id contrato) 1 - contrato_fk
        2 - sector
        3 - municipio_obra
        4 - departamento_obra
        6.codigo_divipola_municipio
        7.unidad_funcional_acuerdo_obra,
        8.fecha_inicio,
        9.fecha_inicial_terminacion,
        10.fecha_final_terminacion,
        11.valor_inicial,
        12.valor_final,
        13.avance_fisico_inicial,
        14.avance_fisico_ejecutado,
        15.avance_financiero_ejecutado,
        17.cantidad_suspensiones,
        18.cantidad_prorrogas,
        19.tiempo_suspensiones,
        20.tiempo_prorrogas,
        21.cantidad_adiciones,
        22.valor_total_adiciones,
        23.origen_recursos,
        24.valor_comprometido,
        25.valor_obligado,
        26.valor_pagado,
        27.valor_anticipo,
        30.latitud_inicial,
        31.latitud_final,
        33.longitud_final,
        34.estado,
        37.cesion,
        38.nuevo_contratista,
        39.observaciones,
        40.link_secop
	    */
        $columns = array('2','3','4','6','7','8','9','10','11','12','13','14','15','17','18','19','20',
        '21','22','23','24','25','26','27','30','31','33','34','37','38','39','40','1');
        /* Carga los registros a la BD SQL */
        for ($i=4; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                    if($cantidad[$i][0]!=''){
                        $query = 'INSERT INTO obras(sector,municipio_obra,departamento_obra,codigo_divipola_municipio,
                        unidad_funcional_acuerdo_obra,fecha_inicio,fecha_inicial_terminacion,fecha_final_terminacion,valor_inicial,valor_final,
                        avance_fisico_inicial,avance_fisico_ejecutado,avance_financiero_ejecutado,cantidad_suspensiones,
                        cantidad_prorrogas,tiempo_suspensiones,tiempo_prorrogas,cantidad_adiciones,valor_total_adiciones,origen_recursos,valor_comprometido,
                        valor_obligado,valor_pagado,valor_anticipo,latitud_inicial,latitud_final,longitud_final,estado,cesion,
                        nuevo_contratista,observaciones,link_secop,obra_contrato_fk) 
                        VALUES(';
                        foreach($columns as $ki){
                            $cantidad[$i][$ki] = str_replace("'","`",$cantidad[$i][$ki]);
                            if($ki=='40'){
                                $cantidad[$i][1] = str_replace("-","/",$cantidad[$i][1]);
                                $query = $query."'".$cantidad[$i][$ki]."',(SELECT id FROM contrato WHERE no_contrato LIKE '%".$cantidad[$i][1]."%' LIMIT 1))";
                                break;
                            }
                            $query = $query."'".$cantidad[$i][$ki]."',";
                        }
                        PRINT($query);
                        $result = pg_query($query);
                        echo "<hr>";
                        break;
                    }
            }
        }
        
    }

?>
</body>
</html>