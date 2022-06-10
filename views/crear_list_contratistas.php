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
                    if(isset($_GET['pagina'])){
                        if($_GET['pagina']==$i)
                        {
                            echo '<li class="current"><strong>'.$i.'</strong></li>';
                        }
                        else{
                            echo "<li class='page-item'><a class='page-link' href='?pagina=$i&frame=crear_list_contratistas.php&anio=".$_GET['anio']."'>$i</a></li>";
                        }
                    }
                    else{
                        if($i==1){
                            echo '<li class="current"><strong>1</strong></li>';
                        }else{
                            echo "<li class='page-item'><a class='page-link' href='?pagina=$i&frame=crear_list_contratistas.php&anio=".$_GET['anio']."' >$i</a></li>";
                        }
                }}
            }else
            {
                if(!isset($_GET['pagina'])){
            ?>
                <li class="page-item"><a class="page-link not-active" href="?pagina=<?=$prev?>&frame=crear_list_contratistas.php" >Anterior</a></li>
                <li class="current"><strong>1</strong></li>
                <li class="page-item"><a class="page-link not-active" href="#" disabled>...</a></li>
            <?php
                for ($i=2; $i <= 10 ; $i++) { 
            ?>
                <li class="page-item"><a class="page-link" href="?pagina=<?=$i?>&frame=crear_list_contratistas.php" ><?=$i?></a></li>    
            <?php
                }
            ?>
                <li class="page-item"><a class="page-link not-active" href="?pagina=<?=$total_paginas?>&frame=crear_list_contratistas.php" >...</a></li>
                <li class="page-item"><a class="page-link" href="?pagina=<?=$total_paginas?>&frame=crear_list_contratistas.php" ><?=$total_paginas?></a></li>
                <li class="page-item"><a class="page-link" href="?pagina=<?=2?>&frame=crear_list_contratistas.php" >Siguiente</a></li>
            <?php
            }else{
                $pag = $_GET['pagina'];
                if($pag!=1){
                    echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag-1).'&frame=crear_list_contratistas.php">Anterior</a></li>';
                }
                else{
                    echo "<li class='page-item'><a class='page-link not-active' href='?pagina=$pag&frame=crear_list_contratistas.php'>Anterior</a></li>";
                }
                if($pag!=1)
                {
                    echo '<li class="page-item"><a class="page-link" href="?pagina=1&frame=crear_list_contratistas.php">1</a></li>';
                    echo '<li class="page-item"><a class="page-link not-active" href="#" disabled>...</a></li>';
                }
                if($pag<=5 AND $pag>=2){
                    $init = $pag-2;
                }
                else{
                    $init = 4;
                }
                for ($i=$init;$i>=1;$i--) { 
                    if($pag>=2)
                    {
                        echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag-$i).'&frame=crear_list_contratistas.php" >'.($pag-$i).'</a></li>';
                    }}

                    echo '<li class="current"><strong>'.$pag.'</strong></li>';

                if($pag>=($total_paginas-4) AND $pag<=($total_paginas-1)){
                    $end = $pag+1;
                    $end = $total_paginas - $end;
                }
                else{
                    $end = 4;
                }
                for ($i=1; $i <= $end; $i++) { 
                    if($pag<=($total_paginas-2))
                    {
                        echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag+$i).'&frame=crear_list_contratistas.php" >'.($pag+$i).'</a></li>';           
                    }
                }
                if($pag!=$total_paginas){
                    echo '<li class="page-item"><a class="page-link not-active" href="?pagina='.$total_paginas.'&frame=crear_list_contratistas.php" >...</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?pagina='.$total_paginas.'&frame=crear_list_contratistas.php" >'.$total_paginas.'</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?pagina='.($pag+1).'&frame=crear_list_contratistas.php" >Siguiente</a></li>';
                }else{
                    echo '<li class="page-item"><a class="page-link not-active" href="?pagina='.($pag+1).'&frame=crear_list_contratistas.php">Siguiente</a></li>';     
                }
            }
            }
            ?>
        </ul>
    </nav>
</div>
</div>
<?php include('footer.php');?>
<script type="text/javascript" src="../functions.js"></script>