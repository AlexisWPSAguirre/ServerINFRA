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
    $inputFileName = 'prueba.xlsx';
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
        /* Las columnas de seguimiento 2021: 
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
                    $query = 'INSERT INTO hitos(hito,detalle_hito,valor_adiciones_hito,dias_hito,contrato_fk,
                    fecha_hito) VALUES(';
                    foreach($columns as $ki){
                        $count = 0;
                        if($ki=='0'){
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

?>
</body>
</html>