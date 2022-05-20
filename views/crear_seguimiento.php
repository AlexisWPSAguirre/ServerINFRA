<?php
    session_start();
    include("../config/db.php"); 
    include("includes/header.php");
    include('includes/styles.php');
    
    if(isset($_POST['create'])){
        if($_POST['codigo_divipola_municipio']==''){
            $_POST['codigo_divipola_municipio']=0;
        }
        $query="
        SELECT 
        b.id as pro_id,
        * FROM contrato a
        INNER JOIN proyecto b ON a.no_proyecto_fk = b.id
        WHERE a.id = ".$_POST['no_contrato']." LIMIT 1";
        $result = pg_query($query);
        $pro_id = $line=pg_fetch_assoc($result);
        $query="INSERT INTO obras 
        (obra_contrato_fk,sector,municipio_obra,departamento_obra,codigo_divipola_municipio,unidad_funcional_acuerdo_obra,avance_fisico_ejecutado,
        cantidad_suspensiones,cantidad_prorrogas,tiempo_suspensiones,tiempo_prorrogas,cantidad_adiciones,valor_total_adiciones,origen_recursos,valor_comprometido,valor_obligado,valor_pagado,
        valor_anticipo,latitud_inicial,latitud_final,longitud_final,estado,cesion,nuevo_contratista,observaciones,link_secop,fecha_inicio,fecha_inicial_terminacion,fecha_final_terminacion,
        valor_inicial,valor_final)
        VALUES ('".$_POST['no_contrato']."','".$_POST['sector']."','".$_POST['municipio_obra']."','".$_POST['departamento_obra']."','".$_POST['codigo_divipola_municipio']."','"
        .$_POST['unidad_funcional_acuerdo_obra']."','".$_POST['avance_fisico_ejecutado']."','".$_POST['cantidad_suspensiones'].
        "','".$_POST['cantidad_prorrogas']."','".$_POST['tiempo_suspensiones']."','".$_POST['tiempo_prorrogas'].
        "','".$_POST['cantidad_adiciones']."','".$_POST['valor_total_adiciones']."','".$_POST['origen_recursos'].
        "','".$_POST['valor_comprometido']."','".$_POST['valor_obligado']."','".$_POST['valor_pagado'].
        "','".$_POST['valor_anticipo']."','".$_POST['latitud_inicial']."','".$_POST['latitud_final'].
        "','".$_POST['longitud_final']."','".$_POST['estado']."','".$_POST['cesion']."','".$_POST['nuevo_contratista'].
        "','".$_POST['observaciones']."','".$_POST['link_secop']."','".$_POST['fecha_inicio']."','".$_POST['fecha_inicial_terminacion'].
        "','".$_POST['fecha_final_terminacion']."','".$_POST['valor_inicial']."','".$_POST['valor_final'].
        "');
        UPDATE proyecto SET group_seguimiento = '".$_SESSION['group_seguimiento']."' WHERE id =".$pro_id['pro_id'];
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        } 
        header('Location: groups_seguimiento.php?group='.$_SESSION['group_seguimiento']);
    }
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-5">
            <form action="crear_seguimiento.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Contrato:</label>
                        <select name="no_contrato" id="" class="form-select">
                            <?php
                                $query = "SELECT id,no_contrato from contrato";
                                $result = pg_query($query);
                                while ($line = pg_fetch_assoc($result)) {
                                echo "<option value='".$line["id"]."'>".$line["no_contrato"]."</option>";}
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Sector</label>
                        <input type="text" name="sector" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Municipio Obra</label>
                        <input type="text" name="municipio_obra" class="form-control">
                    </div> 
                    <div class="mb-3">  
                        <label for="" class="form-label">Departamento Obra</label>
                        <input type="text" name="departamento_obra" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Codigo Divipola Municipio</label>
                        <input type="text" name="codigo_divipola_municipio" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Unidad Funcional Acuerdo Obra</label>
                        <input type="text" name="unidad_funcional_acuerdo_obra" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Avance Fisico Inicial</label>
                        <input type="text" name="avance_fisico_inicial" class="form-control">
                    </div>  
                    <div class="mb-3">  
                        <label for="" class="form-label">Avance Fisico Ejecutado</label>
                        <input type="text" name="avance_fisico_ejecutado" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Cantidad Suspensiones</label>
                        <input type="text" name="cantidad_suspensiones" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Cantidad Prorrogas</label>
                        <input type="text" name="cantidad_prorrogas" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Tiempo Suspensiones</label>
                        <input type="text" name="tiempo_suspensiones" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Tiempo Prorrogas</label>
                        <input type="text" name="tiempo_prorrogas" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Cantidad Adiciones</label>
                        <input type="text" name="cantidad_adiciones" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Total Adiciones</label>
                        <input type="text" name="valor_total_adiciones" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Origen Recursos</label>
                        <input type="text" name="origen_recursos" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Comprometido</label>
                        <input type="text" name="valor_comprometido" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Obligado</label>
                        <input type="text" name="valor_obligado" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Pagado</label>
                        <input type="text" name="valor_pagado" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Anticipo</label>
                        <input type="text" name="valor_anticipo" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Latitud Inicial</label>
                        <input type="text" name="latitud_inicial" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Latitud Final</label>
                        <input type="text" name="latitud_final" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Longitud Final</label>
                        <input type="text" name="longitud_final" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Estado</label>
                        <input type="text" name="estado" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Cesion</label>
                        <input type="text" name="cesion" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Nuevo Contratista</label>
                        <input type="text" name="nuevo_contratista" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Observaciones</label>
                        <input type="text" name="observaciones" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Link Secop</label>
                        <input type="text" name="link_secop" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Fecha Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Fecha Inicial Terminacion</label>
                        <input type="text" name="fecha_inicial_terminacion" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Fecha Final Terminacion</label>
                        <input type="text" name="fecha_final_terminacion" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Inicial</label>
                        <input type="text" name="valor_inicial" class="form-control">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Final</label>
                        <input type="text" name="valor_final" class="form-control">
                    </div>

                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="create">
                            GUARDAR
                        </button>
                        <a href="list_seguimiento.php?group=<?= $_SESSION['group_seguimiento']?>" type="submit" class="btn btn-danger">
                            CANCELAR
                        </a>
                    </div>
                
            </form>
        </div>
    </div>
</div>
    