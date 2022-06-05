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
    /* $inputFileName = 'CONTRATOS 2007 a 2021/INF GRAL CONTR 2021.xlsx';  */
    /* $inputFileName = 'MATRIZ2021/MATRIZ COORDENADAS OBRAS 2021.xlsx';   */
    /* $inputFileName = 'MATRIZ2021/MATRIZ HITOS OBRA 2021.xlsx';      */
    /* $inputFileName = 'MATRIZ2021/MATRIZ SEGUIMIENTO OBRAS 2021.xlsx';  */
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
    import_hitos();
    import_contratos();
    import_contratistas();
    import_proyectos(); 
    import_rubros();
    import_coordenadas();
    */
    import_seguimiento();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php
    
    function import_contratos(){
        global $cantidad;
        /* Las columnas de la relación 2021: 
	    0 - no_contrato
	    subconsulta(no_proyecto_fk) 1 - no_proyecto
	    7 - no_certificado
	    11 - registro_presupuestal
	    14 - fecha_presupuestal
	    10 - fecha_firma
	    16 - f_aprob_polizas
	    8 - fecha_certificado

        /* Relacion 2007: 
	    0 - no_contrato
	    5 - no_certificado
	    6 - fecha_certificado
	    8 - fecha_firma
	    9 - no_presupuestal
	    10 - fecha_presupuestal
	    12 - f_aprob_polizas
	    Nullo - no_proyecto subconsulta(no_proyecto_fk) 
        $columns = array('0','5','6','8','9','10','12');
        $index_fechas= array(6,8,10,12);
        $query = 'INSERT INTO contrato(no_contrato,no_certificado,fecha_certificado,fecha_firma,no_presupuestal,
                    fecha_presupuestal,f_aprob_polizas) VALUES(';

        /* Relacion 2008: 
	    1 - no_contrato
	    6 - no_certificado
	    7 - fecha_certificado
	    9 - fecha_firma
	    10 - no_presupuestal
	    11 - fecha_presupuestal
	    13 - f_aprob_polizas
	    Nullo - no_proyecto subconsulta(no_proyecto_fk) 
        $columns = array('1','6','7','9','10','11','13');
        $index_fechas= array(7,9,10,11);
        $query = 'INSERT INTO contrato(no_contrato,no_certificado,fecha_certificado,fecha_firma,no_presupuestal,
                    fecha_presupuestal,f_aprob_polizas,no_proyecto_fk) VALUES(';

        /* Relacion 2009: 
	    1 - no_contrato
	    6 - no_certificado
	    7 - fecha_certificado
	    9 - fecha_firma
	    10 - no_presupuestal
	    11 - fecha_presupuestal
	    13 - f_aprob_polizas
	    Nullo - no_proyecto subconsulta(no_proyecto_fk) 
        $columns = array('1','6','7','9','10','11','13');
        $index_fechas= array(7,9,10,11);
        $query = 'INSERT INTO contrato(no_contrato,no_certificado,fecha_certificado,fecha_firma,no_presupuestal,
                    fecha_presupuestal,f_aprob_polizas,no_proyecto_fk) VALUES(';

        /* Relacion 2010: 
	    1 - no_contrato
	    6 - no_certificado
	    7 - fecha_certificado
	    9 - fecha_firma
	    10 - no_presupuestal
	    11 - fecha_presupuestal
	    13 - f_aprob_polizas
	    Nullo - no_proyecto subconsulta(no_proyecto_fk) 
        $columns = array('1','6','7','9','10','11','13');
        $index_fechas= array(7,9,10,11);
        $query = 'INSERT INTO contrato(no_contrato,no_certificado,fecha_certificado,fecha_firma,no_presupuestal,
                    fecha_presupuestal,f_aprob_polizas,no_proyecto_fk) VALUES(';
    
        /* Relacion 2011,2012
	    0 - no_contrato
	    5 - no_certificado
	    6 - fecha_certificado
	    8 - fecha_firma
	    9 - no_presupuestal
	    10 - fecha_presupuestal
	    12 - f_aprob_polizas
	    Nullo - no_proyecto subconsulta(no_proyecto_fk) 
        $columns = array('0','5','6','8','9','10','12');
        $index_fechas= array(6,8,10,12);
        $query = 'INSERT INTO contrato(no_contrato,no_certificado,fecha_certificado,fecha_firma,no_presupuestal,
                    fecha_presupuestal,f_aprob_polizas,no_proyecto_fk) VALUES(';
    
         /* Relacion 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021
	    0 - no_contrato
	    7 - no_certificado
	    8 - fecha_certificado
	    10 - fecha_firma
	    11 - no_presupuestal
	    14 - fecha_presupuestal
	    16 - f_aprob_polizas
	    1 - no_proyecto subconsulta(no_proyecto_fk) 
        $columns = array('0','7','8','10','11','14','16');
        $index_fechas= array(8,10,14,16);
        $query = 'INSERT INTO contrato(no_contrato,no_certificado,fecha_certificado,fecha_firma,no_presupuestal,
                    fecha_presupuestal,f_aprob_polizas,no_proyecto_fk) VALUES(';
        
	    */
        $anio = '2021';
        $columns = array('0','7','8','10','11','14','16');
        /* Carga los registros a la BD SQL */
        $index_fechas= array(8,10,14,16);
        for ($i=3; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                if($cantidad[$i][$key]!=''){
                    $query = 'INSERT INTO contrato(no_contrato,no_certificado,fecha_certificado,fecha_firma,no_presupuestal,
                    fecha_presupuestal,f_aprob_polizas,no_proyecto_fk) VALUES(';
                    foreach ($index_fechas as $key => $value) {
                        if(!strrpos($cantidad[$i][$value],'-') AND $cantidad[$i][$value]!=""){
                            if(date("Y-m-d",strtotime($cantidad[$i][$value]))!="1970-01-01"){
                                $cantidad[$i][$value] = date("Y-m-d",strtotime($cantidad[$i][$value]));
                            }   
                        }
                    }
                    $cantidad[$i][1] = str_nit($cantidad[$i][1]);
                    $cantidad[$i][1] = str_replace("-","",$cantidad[$i][1]);
                    foreach($columns as $ki){
                        $count = 0;
                        if($ki=='16'){
                            if($cantidad[$i][1]==''){
                                do {
                                    $count += 1;
                                } while ($cantidad[($i-$count)][1]=='');
                                $cantidad[$i][1]=$cantidad[($i-$count)][1];
                            }                            
                            $query = $query."'".$cantidad[$i][$ki]."',(SELECT id FROM proyecto WHERE (no_proyecto ='".$cantidad[$i][1]."' OR objeto = '".$cantidad[$i][2]."') AND anio =".$anio." LIMIT 1))"; 
                            /* $query = $query."'".$cantidad[$i][$ki]."')"; */ 
                            break;
                        }
                        $query = $query."'".$cantidad[$i][$ki]."',";
                    }
                    echo $query."<hr>";
                    $result = pg_query($query); 
                    break;
                }
            }
        }
    }

    function import_contratistas(){
        global $cantidad;
        /* 
        RELACION 2021,2020,2019,2018,2017,2016,2015,2014,2013,2010,2009,2008
        4 -> NOMBRE CONTRATISTA
        5 -> NIT
        RELACION 2012, 2011,2007
        3 -> NOMBRE 
        4 -> NIT
        */
        $anio = 2021;
        $j=4;
        /* El ciclo for indica desde que casilla empieza a importar */
        for ($i=5; $i < count($cantidad) ; $i++) {
                if(val_empty($i,$j)==1 OR val_empty($i,($j+1))==1)
                {   
                    $cantidad[$i][($j+1)] = str_nit($cantidad[$i][($j+1)]);
                    $query = "SELECT * FROM contratista WHERE nit ='".$cantidad[$i][($j+1)]."'";
                    $result = pg_query($query);
                    if(!$line=pg_fetch_assoc($result)){
                        $query = "INSERT INTO contratista(nombre,nit,anio) VALUES('".$cantidad[$i][$j]."','".$cantidad[$i][($j+1)]."',$anio)";
                        echo $query."<hr>";
                        pg_query($query);
                    }
                }
            }
    }

    function import_proyectos(){
        global $cantidad;
        
        /* RELACION 2021: 
        1 - No_proyecto
        3 - proceso
        17 - fecha_iniciacion
        25 - fecha_terminacion
        26 - fecha_liquidacion
        28 - supervision_interventoria
        52 - direccion
        53 - tel_cel
        54 - correo
        2 - objeto
        k - anio
        subconsulta - 5 - contratista_fk
        $columns = array('1','3','17','25','26','28','52','53','54','2');
        $query = 'INSERT INTO proyecto(no_proyecto,proceso,fecha_iniciacion,fecha_terminacion,fecha_liquidacion,
        supervision_interventoria,direccion,tel_cel,correo,objeto,anio,contratista_fk) VALUES(';
                    

        RELACION 2007,  
        Nullo - No-proyecto,
        Nullo - proceso,
        13 - fecha_iniciacion,
        19 - fecha_terminacion,
        20 - fecha_liquidacion,
        27 - supervision_interventoria,
        Nullo - direccion,
        Nullo - tel_cel,
        Nullo - correo,
        1 - objeto
        k - anio
        k - gh
        k - gc
        k - gs
        subconsulta - 4 - contratista_fk
        $columns = array('13','19','20','27','1');
        $query = 'INSERT INTO proyecto(fecha_iniciacion,fecha_terminacion,fecha_liquidacion,
        supervision_interventoria,objeto,anio,group_hito_fk,group_coordenadas_fk,group_seguimiento_fk,contratista_fk) VALUES(';
        
        RELACION 2009,  
        Nullo - No-proyecto,
        Nullo - proceso,
        14 - fecha_iniciacion,
        24 - fecha_terminacion,
        25 - fecha_liquidacion,
        35 - supervision_interventoria,
        38 - direccion,
        39 - tel_cel,
        Nullo - correo,
        2 - objeto
        k - anio
        k - gh
        k - gc
        k - gs
        subconsulta - 5 - contratista_fk
        $columns = array('14','24','25','35','38','39','2');
        $query = 'INSERT INTO proyecto(fecha_iniciacion,fecha_terminacion,fecha_liquidacion,
        supervision_interventoria,direccion,tel_cel,objeto,anio,group_hito_fk,group_coordenadas_fk,group_seguimiento_fk,contratista_fk) VALUES(';
        
        RELACION 2010,  
        Nullo - No-proyecto,
        Nullo - proceso,
        14 - fecha_iniciacion,
        24 - fecha_terminacion,
        25 - fecha_liquidacion,
        35 - supervision_interventoria,
        38 - direccion,
        39 - tel_cel,
        Nullo - correo,
        2 - objeto
        k - anio
        k - gh
        k - gc
        k - gs
        subconsulta - 5 - contratista_fk
        $columns = array('14','24','25','35','38','39','2');
        $query = 'INSERT INTO proyecto(fecha_iniciacion,fecha_terminacion,fecha_liquidacion,
        supervision_interventoria,direccion,tel_cel,objeto,anio,group_hito_fk,group_coordenadas_fk,group_seguimiento_fk,contratista_fk) VALUES(';

        RELACION 2011,  
        Nullo - No-proyecto,
        Nullo - proceso,
        13 - fecha_iniciacion,
        20 - fecha_terminacion,
        21 - fecha_liquidacion,
        23 - supervision_interventoria,
        Nullo - direccion,
        Nullo - tel_cel,
        Nullo - correo,
        1 - objeto
        k - anio
        k - gh
        k - gc
        k - gs
        subconsulta - 4 - contratista_fk
        $columns = array('13','20','21','23','2');
        $query = 'INSERT INTO proyecto(fecha_iniciacion,fecha_terminacion,fecha_liquidacion,
        supervision_interventoria,objeto,anio,group_hito_fk,group_coordenadas_fk,group_seguimiento_fk,contratista_fk) VALUES(';
        
        RELACION 2012,  
        Nullo - No-proyecto,
        2 - proceso,
        13 - fecha_iniciacion,
        19 - fecha_terminacion,
        20 - fecha_liquidacion,
        22 - supervision_interventoria,
        Nullo - direccion,
        Nullo - tel_cel,
        Nullo - correo,
        1 - objeto
        k - anio
        k - gh
        k - gc
        k - gs
        subconsulta - 4 - contratista_fk
        $columns = array('2','13','19','20','22','1');
        $query = 'INSERT INTO proyecto(proceso,fecha_iniciacion,fecha_terminacion,fecha_liquidacion,
        supervision_interventoria,objeto,anio,group_hito_fk,group_coordenadas_fk,group_seguimiento_fk,contratista_fk) VALUES(';
        
        RELACION 2013,  
        1 - no_proyecto,
        3 - proceso,
        15 - fecha_iniciacion,
        22 - fecha_terminacion,
        23 - fecha_liquidacion,
        25 - supervision_interventoria,
        Nullo - direccion,
        Nullo - tel_cel,
        Nullo - correo,
        2 - objeto
        k - anio
        k - gh
        k - gc
        k - gs
        subconsulta - 5 - contratista_fk
        $columns = array('1','3','15','22','23','25','2');
        $query = 'INSERT INTO proyecto(no_proyecto,proceso,fecha_iniciacion,fecha_terminacion,fecha_liquidacion,
        supervision_interventoria,objeto,anio,group_hito_fk,group_coordenadas_fk,group_seguimiento_fk,contratista_fk) VALUES(';

        RELACION 2015,  
        1 - no_proyecto,
        3 - proceso,
        17 - fecha_iniciacion,
        25 - fecha_terminacion,
        26 - fecha_liquidacion,
        28 - supervision_interventoria,
        Nullo - direccion,
        Nullo - tel_cel,
        Nullo - correo,
        2 - objeto
        k - anio
        k - gh
        k - gc
        k - gs
        subconsulta - 5 - contratista_fk
        $columns = array('1','3','17','25','26','28','2');
        $query = 'INSERT INTO proyecto(no_proyecto,proceso,fecha_iniciacion,fecha_terminacion,fecha_liquidacion,
        supervision_interventoria,objeto,anio,group_hito_fk,group_coordenadas_fk,group_seguimiento_fk,contratista_fk) VALUES(';

        RELACION 2016,2017,2018,2019,2020,2021
        1 - no_proyecto,
        3 - proceso,
        17 - fecha_iniciacion,
        25 - fecha_terminacion,
        26 - fecha_liquidacion,
        28 - supervision_interventoria,
        52 - direccion,
        53 - tel_cel,
        54 - correo,
        2 - objeto
        k - anio
        k - gh
        k - gc
        k - gs
        subconsulta - 5 - contratista_fk
        $columns = array('1','3','17','25','26','28','52','53','54','2');
        $query = 'INSERT INTO proyecto(no_proyecto,proceso,fecha_iniciacion,fecha_terminacion,fecha_liquidacion,
        supervision_interventoria,direccion,tel_cel,correo,objeto,anio,group_hito_fk,group_coordenadas_fk,group_seguimiento_fk,contratista_fk) VALUES(';
        */
        /* Carga los registros a la BD SQL */
        $anio = '2021';
        $gh = 'H2021';
        $gc = 'C2021';
        $gs = 'S2021';
        $columns = array('1','3','17','25','26','28','52','53','54','2');
        for ($i=5; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                if($cantidad[$i][$key]!=''){
                    $query = 'INSERT INTO proyecto(no_proyecto,proceso,fecha_iniciacion,fecha_terminacion,fecha_liquidacion,
        supervision_interventoria,direccion,tel_cel,correo,objeto,anio,group_hito_fk,group_coordenadas_fk,group_seguimiento_fk,contratista_fk) VALUES(';
                    if(!strrpos($cantidad[$i][17],'-') AND $cantidad[$i][17]!=""){
                        if(date("Y-m-d",strtotime($cantidad[$i][17]))!="1970-01-01"){
                            $cantidad[$i][17] = date("Y-m-d",strtotime($cantidad[$i][17]));
                        }   
                    }
                    if(!strrpos($cantidad[$i][25],'-') AND $cantidad[$i][25]!=""){
                        if(date("Y-m-d",strtotime($cantidad[$i][25]))!="1970-01-01"){
                            $cantidad[$i][25] = date("Y-m-d",strtotime($cantidad[$i][25]));
                        }   
                    }
                    if(!strrpos($cantidad[$i][26],'-') AND $cantidad[$i][26]!=""){
                        if(date("Y-m-d",strtotime($cantidad[$i][26]))!="1970-01-01"){
                            $cantidad[$i][26] = date("Y-m-d",strtotime($cantidad[$i][26]));
                        }   
                    }
                    
                    foreach($columns as $ki){
                        if($ki=='1')
                        {   
                            $cantidad[$i][$ki] = str_nit($cantidad[$i][$ki]);
                            $cantidad[$i][$ki] = str_replace("-","",$cantidad[$i][$ki]);
                        } 
                        if($ki=='2'){
                            $cantidad[$i][5] = str_nit($cantidad[$i][5]);
                            $query = $query."'".$cantidad[$i][$ki]."',$anio,'$gh','$gc','$gs',(SELECT id FROM contratista WHERE nit ='".$cantidad[$i][5]."' LIMIT 1))";
                            break;
                        }
                        $query = $query."'".$cantidad[$i][$ki]."',";
                    }
                    echo $query."<hr>";
                    $result = pg_query($query); 
                    break;
                }
            }
        }
    }

    function import_rubros(){
        global $cantidad;
        /* Las columnas de la relación 2021: 
	    6 - rubro
        9 - valor
        13 - fuentes
        29 - anticipo
        subconsulta(contrato_fk)  0 - contrato

        /* Las columnas de la relación 2014: 
	    6 - rubro
        9 - valor
        13 - fuentes
        29 - anticipo
        subconsulta(contrato_fk)  0 - contrato
	    */
        $anio = 2021;
        $columns = array('6','9','13','29','0'); 
        /* Carga los registros a la BD SQL */
        for ($i=4; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                $cantidad[$i][6] = str_nit($cantidad[$i][6]);
                $cantidad[$i][6] = str_replace("-","",$cantidad[$i][6]);
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
                            $query = $query."(
                            SELECT 
                            a.id FROM contrato a
                            INNER JOIN proyecto b ON b.id = a.no_proyecto_fk
                            WHERE a.no_contrato ='".$cantidad[$i][$ki]."' AND b.anio = $anio
                            LIMIT 1))";
                            break;
                        }
                        $query = $query."'".$cantidad[$i][$ki]."',";
                    }
                    echo $query."<hr>";
                    $result = pg_query($query); 
                    break;
                }
            }
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
        /* Carga los registros a la BD SQL */
        echo "<h1>".count($cantidad)."</h1>";
        for ($i=1; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                if(!strrpos($cantidad[$i][4],'-') AND $cantidad[$i][4]!=""){
                    if(date("Y-m-d",strtotime($cantidad[$i][4]))!="1970-01-01"){
                        $cantidad[$i][4] = date("Y-m-d",strtotime($cantidad[$i][4]));
                    }   
                }
                if($cantidad[$i][$key]!=''){                    
                    $query = 'INSERT INTO hitos(hito,fecha_hito,detalle_hito,valor_adiciones_hito,dias_hito,
                    contrato_fk) VALUES(';
                    foreach($columns as $ki){
                        if($ki=='7'){
                            if($cantidad[$i][$ki]=='')
                            {
                                $cantidad[$i][$ki] = 0;
                            }
                            $cantidad[$i][0] = str_replace("-","/",$cantidad[$i][0]);
                            $query = $query."'".$cantidad[$i][$ki]."',(SELECT a.id FROM contrato a INNER JOIN proyecto b ON a.no_proyecto_fk = b.id
                            WHERE a.no_contrato LIKE '%".$cantidad[$i][0]."%' AND b.no_proyecto = '".$cantidad[$i][1]."' LIMIT 1))";
                            break;
                        }
                        $query = $query."'".$cantidad[$i][$ki]."',";
                    }
                }
                echo $query."<hr>";
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
        for ($i=1; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                    if($cantidad[$i][0]!=''){
                        $query = 'INSERT INTO coordenadas(latitud,longitud,latitud_inicial,latitud_final,longitud_inicial,
                        longitud_final,coo_contrato_fk) VALUES(';
                        foreach($columns as $ki){
                            $cantidad[$i][$ki] = str_replace("'","`",$cantidad[$i][$ki]);
                            if($ki=='9'){
                                $cantidad[$i][3] = str_replace("-","/",$cantidad[$i][3]);
                                $query = $query."'".$cantidad[$i][$ki]."',(SELECT a.id FROM contrato a
                                INNER JOIN proyecto b ON b.id = a.no_proyecto_fk
                                WHERE a.no_contrato LIKE '%".$cantidad[$i][3]."%' AND b.no_proyecto = '".$cantidad[$i][0]."' LIMIT 1))";
                                break;
                            }
                            $query = $query."'".$cantidad[$i][$ki]."',";
                        }
                        echo $query."<hr>";
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
        9.fecha_inicio,
        10.fecha_inicial_terminacion,
        11.fecha_final_terminacion,
        12.valor_inicial,
        13.valor_final,
        14.avance_fisico_inicial,
        15.avance_fisico_ejecutado,
        16.avance_financiero_ejecutado,
        18.cantidad_suspensiones,
        19.cantidad_prorrogas,
        20.tiempo_suspensiones,
        21.tiempo_prorrogas,
        22.cantidad_adiciones,
        23.valor_total_adiciones,
        24.origen_recursos,
        25.valor_comprometido,
        26.valor_obligado,
        27.valor_pagado,
        28.valor_anticipo,
        31.latitud_inicial,
        33.latitud_final,
        34.longitud_final,
        35.estado,
        38.cesion,
        39.nuevo_contratista,
        40.observaciones,
        41.link_secop
	    */
        $columns = array('2','3','4','6','7','9','10','11','12','13','14','15','16','18','19','20',
        '21','22','23','24','25','26','27','28','31','33','34','35','38','39','40','41','1');
        /* Carga los registros a la BD SQL */
        for ($i=1; $i < count($cantidad) ; $i++) {
            foreach ($columns as $key) {
                    if($cantidad[$i][0]!=''){
                        $query = 'INSERT INTO obras(sector,municipio_obra,departamento_obra,codigo_divipola_municipio,
                        unidad_funcional_acuerdo_obra,fecha_inicio,fecha_inicial_terminacion,fecha_final_terminacion,valor_inicial,valor_final,
                        avance_fisico_inicial,avance_fisico_ejecutado,avance_financiero_ejecutado,cantidad_suspensiones,
                        cantidad_prorrogas,tiempo_suspensiones,tiempo_prorrogas,cantidad_adiciones,valor_total_adiciones,origen_recursos,valor_comprometido,
                        valor_obligado,valor_pagado,valor_anticipo,latitud_inicial,latitud_final,longitud_final,estado,cesion,
                        nuevo_contratista,observaciones,link_secop,obra_contrato_fk,se_coordenada_fk) 
                        VALUES(';
                        foreach($columns as $ki){
                            $cantidad[$i][$ki] = str_replace("'","`",$cantidad[$i][$ki]);
                            if($ki=='41'){
                                $cantidad[$i][1] = str_replace("-","/",$cantidad[$i][1]);
                                $query = $query."'".$cantidad[$i][$ki]."',(SELECT id FROM contrato WHERE no_contrato LIKE '%".$cantidad[$i][1]."%' LIMIT 1),
                                (SELECT id FROM coordenadas WHERE coo_contrato_fk = (SELECT id FROM contrato WHERE no_contrato LIKE '%".$cantidad[$i][1]."%' LIMIT 1) LIMIT 1))";
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

    function val_empty($a,$b){
        global $cantidad;
        if($cantidad[$a][$b]!='NULL' AND $cantidad[$a][$b]!=''){
            return true;
        }
        else{
            return false;
        }
    }

    function str_nit($string)
    {
        $chars = array(","," ",".","'");
        return str_replace($chars,"",$string);
    }

?>
</body>
</html>