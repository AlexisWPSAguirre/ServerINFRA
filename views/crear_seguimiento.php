<?php
    include("../config/db.php"); 
    include('includes/styles.php');
    include_once '../config/user_session.php';
    include_once "full-width.php";
    
    if(isset($_POST['create'])){
        if($_POST['codigo_divipola_municipio']==''){
            $_POST['codigo_divipola_municipio']=0;
        }

        if(isset($_GET['gr_new'])){
            $query="INSERT INTO obras 
            (obra_contrato_fk,sector,municipio_obra,departamento_obra,codigo_divipola_municipio,unidad_funcional_acuerdo_obra,avance_fisico_ejecutado,
            cantidad_suspensiones,cantidad_prorrogas,tiempo_suspensiones,tiempo_prorrogas,cantidad_adiciones,valor_total_adiciones,origen_recursos,valor_comprometido,valor_obligado,valor_pagado,
            valor_anticipo,latitud_inicial,latitud_final,longitud_final,estado,cesion,nuevo_contratista,observaciones,link_secop,fecha_inicio,fecha_inicial_terminacion,fecha_final_terminacion,
            valor_inicial,valor_final)
            VALUES ('".$_GET['id']."','".$_POST['sector']."','".$_POST['municipio_obra']."','".$_POST['departamento_obra']."','".$_POST['codigo_divipola_municipio']."','"
            .$_POST['unidad_funcional_acuerdo_obra']."','".$_POST['avance_fisico_ejecutado']."','".$_POST['cantidad_suspensiones'].
            "','".$_POST['cantidad_prorrogas']."','".$_POST['tiempo_suspensiones']."','".$_POST['tiempo_prorrogas'].
            "','".$_POST['cantidad_adiciones']."','".$_POST['valor_total_adiciones']."','".$_POST['origen_recursos'].
            "','".$_POST['valor_comprometido']."','".$_POST['valor_obligado']."','".$_POST['valor_pagado'].
            "','".$_POST['valor_anticipo']."','".$_POST['latitud_inicial']."','".$_POST['latitud_final'].
            "','".$_POST['longitud_final']."','".$_POST['estado']."','".$_POST['cesion']."','".$_POST['nuevo_contratista'].
            "','".$_POST['observaciones']."','".$_POST['link_secop']."','".$_POST['fecha_inicio']."','".$_POST['fecha_inicial_terminacion'].
            "','".$_POST['fecha_final_terminacion']."','".$_POST['valor_inicial']."','".$_POST['valor_final'].
            "');
            INSERT INTO groups (cod,descripcion) VALUES('".$_POST['cod']."','".$_POST['descripcion']."');
            UPDATE proyecto SET group_seguimiento_fk = '".$_POST['cod']."' WHERE id =".$_GET['pro_id'];
            $result = pg_query($query);
            if(!$result)
            {
                die("Query Failed.");
            } 
            header('Location: list_seguimiento.php?group='.$_POST['cod']);
        }
        else
        {
            $query="INSERT INTO obras 
            (obra_contrato_fk,sector,municipio_obra,departamento_obra,codigo_divipola_municipio,unidad_funcional_acuerdo_obra,avance_fisico_ejecutado,
            cantidad_suspensiones,cantidad_prorrogas,tiempo_suspensiones,tiempo_prorrogas,cantidad_adiciones,valor_total_adiciones,origen_recursos,valor_comprometido,valor_obligado,valor_pagado,
            valor_anticipo,latitud_inicial,latitud_final,longitud_final,estado,cesion,nuevo_contratista,observaciones,link_secop,fecha_inicio,fecha_inicial_terminacion,fecha_final_terminacion,
            valor_inicial,valor_final)
            VALUES ('".$_GET['id']."','".$_POST['sector']."','".$_POST['municipio_obra']."','".$_POST['departamento_obra']."','".$_POST['codigo_divipola_municipio']."','"
            .$_POST['unidad_funcional_acuerdo_obra']."','".$_POST['avance_fisico_ejecutado']."','".$_POST['cantidad_suspensiones'].
            "','".$_POST['cantidad_prorrogas']."','".$_POST['tiempo_suspensiones']."','".$_POST['tiempo_prorrogas'].
            "','".$_POST['cantidad_adiciones']."','".$_POST['valor_total_adiciones']."','".$_POST['origen_recursos'].
            "','".$_POST['valor_comprometido']."','".$_POST['valor_obligado']."','".$_POST['valor_pagado'].
            "','".$_POST['valor_anticipo']."','".$_POST['latitud_inicial']."','".$_POST['latitud_final'].
            "','".$_POST['longitud_final']."','".$_POST['estado']."','".$_POST['cesion']."','".$_POST['nuevo_contratista'].
            "','".$_POST['observaciones']."','".$_POST['link_secop']."','".$_POST['fecha_inicio']."','".$_POST['fecha_inicial_terminacion'].
            "','".$_POST['fecha_final_terminacion']."','".$_POST['valor_inicial']."','".$_POST['valor_final'].
            "');
            UPDATE proyecto SET group_seguimiento_fk = '".$_SESSION['group_seguimiento']."' WHERE id =".$_GET['pro_id'];
            $result = pg_query($query);
            if(!$result)
            {
                die("Query Failed.");
            } 
            header('Location: list_seguimiento.php?group='.$_SESSION['group_seguimiento']);
        }
        
    }
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "
        SELECT 
        *
        FROM contrato a
        INNER JOIN proyecto b ON b.id = a.no_proyecto_fk
        WHERE a.id = $id";
        $result = pg_query($query);
        if(!$result) {
            die("Query Failed.");
        }
        while ($line = pg_fetch_assoc($result))
        {
?>

<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
          <div class="sectiontitle">
              <h6 class="heading">Crear Seguimiento</h6>
          </div>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content">
    <div class="row">
        <div class="col-5">
                    <?php
                        if(isset($_GET['gr_new']))
                        {
                    ?>
                    <form action="crear_seguimiento.php?id=<?php echo $_GET['id'];?>&pro_id=<?php echo $_GET['pro_id']?>&gr_new='TRUE'" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Código:</label>
                            <input type="text" name="cod" class="form-control" value="S">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Descripción de Grupo:</label>
                        <input type="text" name="descripcion" class="form-control">
                    </div>
                    <?php
                        }else{
                    ?>
                    <form action="crear_seguimiento.php?id=<?php echo $_GET['id'];?>&pro_id=<?php echo $_GET['pro_id']?>" method="POST">
                    <?php
                        }
                    ?>
                    <div class="mb-3">
                        <label for="" class="form-label">No. Proyecto:</label>
                        <input type="text" name="no_proyecto" class="form-control" value="<?php echo $line['no_proyecto'];?>" disabled>
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">No. contrato</label>
                        <input type="text" name="no_contrato" class="form-control" value="<?php echo $line["no_contrato"];?>" disabled>
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
                        <div class="mb-1 abs-center">
                            <button type="submit" class="btn btn-secondary" name="create">
                                GUARDAR
                            </button>
                        </div>
                    </div>
                    <div class="col">
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
                        <a href="list_seguimiento.php?group=<?= $_SESSION['group_seguimiento']?>" type="submit" class="btn-danger">
                            CANCELAR
                        </a>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
                    </div>
    <?php }} include('footer.php');?>
    