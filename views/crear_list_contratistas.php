<?php
    include("../config/db.php"); 
    if(isset($_POST['create'])){
        $query="INSERT INTO contratista
        (nombre,nit)
        VALUES ('".$_POST['nombre']."','".$_POST['nit']."')";
        $result = pg_query($query);
        if(!$result)
        {
            die("Query Failed.");
        }   
    }
?>
<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
          <div class="sectiontitle">
              <h6 class="heading">Matriz Contratistas</h6>
          </div>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<div class="wrapper row2">
        <div class="row">
            <select name="" id="search_anio_contratista" class="form-select" style="margin-left:50%">
                <?php
                    $query="SELECT count(*), anio FROM contratista GROUP BY anio ORDER BY anio DESC";
                    $result = pg_query($query);
                    
                    if(isset($_GET['anio'])){
                        while($anios=pg_fetch_assoc($result)){
                            if($_GET['anio']==$anios['anio']){
                ?>
                    <option value="<?= $anios['anio']?>" selected><?=$anios['anio']?></option>
                <?php
                        }else{
                ?>
                    <option value="<?= $anios['anio']?>"><?=$anios['anio']?></option>
                <?php
                        }
                    }
                    }else{
                    ?>
                    <option value="" selected>Seleccionar</option>
                    <?php
                        while($anios=pg_fetch_assoc($result)){
                ?>
                    <option value="<?= $anios['anio']?>"><?=$anios['anio']?></option>
                <?php
                    }}
                ?>
            </select>
        </div>
    </div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content">
        <div class="scrollable">
    <div class="row">
        <div class="col-5">
            <form action="" method="POST">
                    <div class="mb-3">  
                        <label for="" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="busqueda">
                    </div>
                    <div class="mb-3">  
                        <label for="" class="form-label">NIT</label>
                        <input type="text" name="nit" class="busqueda">
                    </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary m-2" name="create">
                            GUARDAR
                        </button>
                    </div>
            </form>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>NIT</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //Paginador
                    if(isset($_GET['anio'])){
                        $sql_register = pg_query("SELECT COUNT(*) as total_registros FROM contratista WHERE anio =".$_GET['anio']);
                        $result_register = pg_fetch_assoc($sql_register);
                        $total_register = $result_register['total_registros'];
                        $por_pagina = 10;
                        if(empty($_GET['pagina']))
                        {
                            $pagina = 1;
                            $desde = 0;
                        }else
                        {
                            $pagina = $_GET['pagina'];
                            $desde = ($pagina-1) * $por_pagina;
                        }
                        $total_paginas = ceil($total_register/$por_pagina);

                        $query = "SELECT * FROM contratista WHERE anio =".$_GET['anio']." ORDER BY id ASC";
                        $query = $query." LIMIT $por_pagina OFFSET $desde";
                    }
                    else{
                        $sql_register = pg_query("SELECT COUNT(*) as total_registros FROM contratista");
                        $result_register = pg_fetch_assoc($sql_register);
                        $total_register = $result_register['total_registros'];
                        $por_pagina = 10;
                        if(empty($_GET['pagina']))
                        {
                            $pagina = 1;
                            $desde = 0;
                        }else
                        {
                            $pagina = $_GET['pagina'];
                            $desde = ($pagina-1) * $por_pagina;
                        }
                        $total_paginas = ceil($total_register/$por_pagina);

                        $query = "SELECT * FROM contratista ORDER BY id ASC";
                        $query = $query." LIMIT $por_pagina OFFSET $desde";
                    }
                    $result = pg_query($query) or die ('La consulta fallo: '. preg_last_error());
                    while ($line = pg_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?= $line['id'] ?></td>
                    <td><?= $line['nombre'] ?></td>
                    <td><?= $line['nit'] ?></td>
                    <td>
                        <a class="btn btn-primary mb-1" href="edit_contratista.php?id=<?= $line['id']?>">EDITAR</a>
                        <a class="btn-danger" href="../controllers/contratista/delete.php?id=<?= $line['id']?>">ELIMINAR</a>
                    </td>
                    <?php
                        }
                    ?>
                    
                </tr>
            </tbody>
            
        </table>
    </div>
</div>
</div>  
<div class="container">
    <nav class="pagination">
        <ul>
            <?php
            if(isset($_GET['anio'])){
                for ($i=1; $i <= $total_paginas ; $i++) { 
            ?>
                <li><a href="?pagina=<?=$i?>&frame=crear_list_contratistas.php&anio=<?=$_GET['anio']?>" class="m-2"><?=$i?></a></li>
            <?php
                }}else{
                    for ($i=1; $i <= $total_paginas ; $i++) { 
            ?>
                <li><a href="?pagina=<?=$i?>&frame=crear_list_contratistas.php" class="m-2"><?=$i?></a></li>
            <?php
                    }}
            ?>
        </ul>
    </nav>
</div>
</div>
<?php include('footer.php');?>
<script type="text/javascript" src="../functions.js"></script>