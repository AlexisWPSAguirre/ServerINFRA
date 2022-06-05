<?php
include('../config/db.php');
include('includes/jquery.php');
include('includes/scripts.php');
/* include_once '../config/user_session.php';
$userSession = new UserSession();
if( !isset($_SESSION['user'])){
    header("Location: login.php");
} */
?>
<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
          <div class="sectiontitle">
              <h6 class="heading">Grupos de Coordenadas</h6>
          </div>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content">
        <div class="scrollable">
        <div class="row mb-3">
            <div class="col-3">
                <a href="../views/full-width.php?frame=list_contratos_anio.php&select=coordenada" class="btn btn-secondary">AÑADIR</a>   
            </div>
        </div>
    <div class="row">
        <div class="col">
        <table class="table">
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>No. Agrupación</th>
                <th>Descripción</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php 
            //Paginador
            /* $sql_register = pg_query("SELECT COUNT(*) as total_registros FROM proyecto");
            $result_register = pg_fetch_assoc($sql_register);
            $total_register = $result_register['total_registros'];
            $por_pagina = 5;
            if(empty($_GET['pagina']))
            {
                $pagina = 1;
                $desde = 0;
            }else
            {
                $pagina = $_GET['pagina'];
                $desde = ($pagina-1) * $por_pagina;
            }
            $total_paginas = ceil($total_register/$por_pagina); */            
            $query = "
            SELECT count(*),c.group_coordenadas_fk,string_agg(d.descripcion,', ') AS descripcion
            FROM coordenadas a
            LEFT JOIN contrato b ON b.id = a.coo_contrato_fk
            LEFT JOIN proyecto c ON c.id = b.no_proyecto_fk            
            LEFT JOIN groups d ON d.cod = c.group_coordenadas_fk
            GROUP BY c.group_coordenadas_fk
            ORDER BY c.group_coordenadas_fk ASC";
            /* $query = $query." LIMIT $por_pagina OFFSET $desde"; */
            $result = pg_query($query) or die ('La consulta fallo: '. preg_last_error());
            while ($line = pg_fetch_assoc($result)) {
        ?>
            <tr>
                <td>
                    <a href="list_coordenadas.php?group=<?php echo $line['group_coordenadas_fk'] ?>">
                    <?php
                        echo $line['count'];
                    ?>
                    </a>
                </td>
                <td>
                    <?php   
                        if(!is_null($line['group_coordenadas_fk'])){
                            echo $line['group_coordenadas_fk'];
                        }
                        else
                        {
                            echo "No fueron relacionados con un Proyecto";
                        }
                    ?>
                </td>
                </td>
                <td>
                    <?php
                        $line['descripcion']=stristr($line['descripcion'],",",true);
                        echo $line['descripcion']
                    ?>
                </td>
                <td>
                    <a href="excel_coordenadas.php?group=<?php echo $line['group_coordenadas_fk']?>" class="btn btn-dark mb-1">
                        <i class="fas fa-file-excel"></i>
                    </a>
                    <a href="edit_group.php?group=<?php echo $line['group_coordenadas_fk']?>" class="btn btn-dark">
                    Editar
                    </a>
                    <a href="../controllers/groups/delete_group.php?cod=<?php echo $line['group_coordenadas_fk']?>&gr_sel=coordenada" class="btn-danger">
                    Eliminar
                    </a>
                    <!-- 
                    <a href="form_edit.php?id=<?php echo $line['id']?>" class="btn btn-secondary mb-1">
                        <i class="bi bi-pen"></i>
                    </a>
                    <a href="../controllers/proyectos/delete.php?id=<?php echo $line['id']?>" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                    </a> -->
                    </td>
            </tr>
        <?php } ?>
        </table>
        </div>
    </div>
</div>
    <!-- <script>
        $(function(){
            $("p").click(function(event){
                alert("evento click")
            });
        });
    </script> -->
</div>
</div>
</tbody>
<!-- Paginador -->
<!-- <div class="container">
    <div class="row">
        <?php
            for ($i=1; $i <= $total_paginas ; $i++) { 
                if ($i==$pagina) {
                    echo '<div class="col-1">
                    <a href="?pagina='.$i.'" class="list-group-item list-group-item-action active">'.$i.'</a>
                    </div>';
                }
                else{
                    echo '<div class="col-1">
                    <a href="?pagina='.$i.'" class="list-group-item list-group-item-action">'.$i.'</a>
                    </div>';
                }
            }
        ?>
    </div>
</div> -->
<?php include('footer.php');?>