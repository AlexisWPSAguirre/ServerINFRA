<?php 
include("../config/db.php"); 
include("includes/header.php");
include('includes/styles.php');
include_once '../config/user_session.php';
$userSession = new UserSession();
if( !isset($_SESSION['user'])){
    header("Location: login.php");
}
if(isset($_POST['editar'])){
    #No habia visto que el post se almacenará con el name del button D:
        $id = $_GET["id"];
        $query = "UPDATE obras SET sector='".$_POST['sector']."', municipio_obra='".$_POST['municipio_obra']."',
        departamento_obra='".$_POST['departamento_obra']."', codigo_divipola_municipio='".$_POST['codigo_divipola_municipio']."',
        unidad_funcional_acuerdo_obra='".$_POST['unidad_funcional_acuerdo_obra']."',avance_fisico_ejecutado='".$_POST['avance_fisico_ejecutado']."',
        cantidad_suspensiones='".$_POST['cantidad_suspensiones']."',cantidad_prorrogas='".$_POST['cantidad_prorrogas']."',
        tiempo_suspensiones='".$_POST['tiempo_suspensiones']."',tiempo_prorrogas='".$_POST['tiempo_prorrogas']."',
        cantidad_adiciones='".$_POST['cantidad_adiciones']."',valor_total_adiciones='".$_POST['valor_total_adiciones']."',
        origen_recursos='".$_POST['origen_recursos']."',valor_comprometido='".$_POST['valor_comprometido']."',
        valor_obligado='".$_POST['valor_obligado']."',valor_pagado='".$_POST['valor_pagado']."',
        valor_anticipo='".$_POST['valor_anticipo']."',latitud_inicial='".$_POST['latitud_inicial']."',
        latitud_final='".$_POST['latitud_final']."',longitud_final='".$_POST['longitud_final']."',
        estado='".$_POST['estado']."',cesion='".$_POST['cesion']."',
        nuevo_contratista='".$_POST['nuevo_contratista']."',observaciones='".$_POST['observaciones']."',
        link_secop='".$_POST['link_secop']."',fecha_inicio='".$_POST['fecha_inicio']."',
        fecha_inicial_terminacion='".$_POST['fecha_inicial_terminacion']."',fecha_final_terminacion='".$_POST['fecha_final_terminacion']."',
        valor_inicial='".$_POST['valor_inicial']."',valor_final='".$_POST['valor_final']."'
        WHERE id=$id";
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }
        header("Location:list_seguimiento.php?group=".$_SESSION['group_seguimiento']);
    }
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
    SELECT 
    *
    FROM obras a
    INNER JOIN contrato b ON b.id = a.obra_contrato_fk
    INNER JOIN proyecto c ON c.id = b.no_proyecto_fk
    WHERE a.id = $id";
    $result = pg_query($query);
    if(!$result) {
        die("Query Failed.");
    }
    while ($line = pg_fetch_assoc($result))
    {
?>
<div class="container p-4">
    <div class="card card-body">
        <div class="row">
            <div class="col">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Proyecto:</label>
                        <input type="text" name="no_proyecto" class="form-control" value="<?= $line['no_proyecto'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">No. Contrato:</label>
                        <input type="text" name="no_contrato"class="form-control" value="<?= $line['no_contrato'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Sector</label>
                        <input type="text" name="sector" class="form-control" value="<?= $line['sector'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Municipio Obra</label>
                        <input type="text" name="municipio_obra" class="form-control" value="<?= $line['municipio_obra'] ?>">
                    </div> 
                    <div class="mb-3">  
                        <label for="" class="form-label">Departamento Obra</label>
                        <input type="text" name="departamento_obra" class="form-control" value="<?= $line['departamento_obra'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Codigo Divipola Municipio</label>
                        <input type="text" name="codigo_divipola_municipio" class="form-control" value="<?= $line['codigo_divipola_municipio'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Unidad Funcional Acuerdo Obra</label>
                        <input type="text" name="unidad_funcional_acuerdo_obra" class="form-control" value="<?= $line['unidad_funcional_acuerdo_obra'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Avance Fisico Inicial</label>
                        <input type="text" name="avance_fisico_inicial" class="form-control" value="<?= $line['avance_fisico_inicial'] ?>">
                    </div>  
                    <div class="mb-3">  
                        <label for="" class="form-label">Avance Fisico Ejecutado</label>
                        <input type="text" name="avance_fisico_ejecutado" class="form-control" value="<?= $line['avance_fisico_ejecutado'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Cantidad Suspensiones</label>
                        <input type="text" name="cantidad_suspensiones" class="form-control" value="<?= $line['cantidad_suspensiones'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Cantidad Prorrogas</label>
                        <input type="text" name="cantidad_prorrogas" class="form-control" value="<?= $line['cantidad_prorrogas'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Tiempo Suspensiones</label>
                        <input type="text" name="tiempo_suspensiones" class="form-control" value="<?= $line['tiempo_suspensiones'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Tiempo Prorrogas</label>
                        <input type="text" name="tiempo_prorrogas" class="form-control" value="<?= $line['tiempo_prorrogas'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Cantidad Adiciones</label>
                        <input type="text" name="cantidad_adiciones" class="form-control" value="<?= $line['cantidad_adiciones'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Total Adiciones</label>
                        <input type="text" name="valor_total_adiciones" class="form-control" value="<?= $line['valor_total_adiciones'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Origen Recursos</label>
                        <input type="text" name="origen_recursos" class="form-control" value="<?= $line['origen_recursos'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Comprometido</label>
                        <input type="text" name="valor_comprometido" class="form-control" value="<?= $line['valor_comprometido'] ?>">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-secondary" name="editar">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Obligado</label>
                        <input type="text" name="valor_obligado" class="form-control" value="<?= $line['valor_obligado'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Pagado</label>
                        <input type="text" name="valor_pagado" class="form-control" value="<?= $line['valor_pagado'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Anticipo</label>
                        <input type="text" name="valor_anticipo" class="form-control" value="<?= $line['valor_anticipo'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Latitud Inicial</label>
                        <input type="text" name="latitud_inicial" class="form-control" value="<?= $line['latitud_inicial'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Latitud Final</label>
                        <input type="text" name="latitud_final" class="form-control" value="<?= $line['latitud_final'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Longitud Final</label>
                        <input type="text" name="longitud_final" class="form-control" value="<?= $line['longitud_final'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Estado</label>
                        <input type="text" name="estado" class="form-control" value="<?= $line['estado'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Cesion</label>
                        <input type="text" name="cesion" class="form-control" value="<?= $line['cesion'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Nuevo Contratista</label>
                        <input type="text" name="nuevo_contratista" class="form-control" value="<?= $line['nuevo_contratista'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Observaciones</label>
                        <input type="text" name="observaciones" class="form-control" value="<?= $line['observaciones'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Link Secop</label>
                        <input type="text" name="link_secop" class="form-control" value="<?= $line['link_secop'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Fecha Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="<?= $line['fecha_inicio'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Fecha Inicial Terminacion</label>
                        <input type="text" name="fecha_inicial_terminacion" class="form-control" value="<?= $line['fecha_inicial_terminacion'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Fecha Final Terminacion</label>
                        <input type="text" name="fecha_final_terminacion" class="form-control" value="<?= $line['fecha_final_terminacion'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Inicial</label>
                        <input type="text" name="valor_inicial" class="form-control" value="<?= $line['valor_inicial'] ?>">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">Valor Final</label>
                        <input type="text" name="valor_final" class="form-control" value="<?= $line['valor_final'] ?>">
                    </div>
                    <div class="mb-1 abs-center">
                        <a href="list_seguimiento.php?group=<?= $_SESSION['group_seguimiento']?>" type="submit" class="btn btn-danger">
                            CANCELAR
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }}
?>
<?php include('includes/footer.php');?>