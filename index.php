<?php include('config/db.php')?>
<?php include('includes/header.php')?>
<div class="col-md-8">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th></th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php 
    $query = 'SELECT
    a.id,
    a.no_proyecto,
    a.proceso,
    a.fecha_iniciacion,
    a.fecha_terminacion,
    a.fecha_liquidacion,
    a.supervision_interventoria,
    b.nombre,
    a.proceso,
    b.nit
    FROM proyecto a 
    INNER JOIN contratista b ON b.id = a.contratista_fk';
    $result = pg_query($query) or die ('La consulta fallo: '. preg_last_error());
    while ($line = pg_fetch_assoc($result)) {
?>
    <tr>
        <td>
            <?php echo $line['id'] ?>
        </td>
        <td>
            <?php echo $line['no_proyecto'] ?>
        </td>
        <td>
            <?php echo $line['proceso'] ?>
        </td>
        <td>
            <?php echo $line['fecha_iniciacion'] ?>
        </td>
        <td>
            <?php echo $line['fecha_terminacion'] ?>
        </td>
        <td>
            <?php echo $line['fecha_liquidacion'] ?>
        </td>
        <td>
            <?php echo $line['supervision_interventoria'] ?>
        </td>
        <td>
            <?php echo $line['nombre'] ?>
        </td>
        <td>
            <?php echo $line['proceso'] ?>
        </td>
        <td>
            <?php echo $line['nit'] ?>
        </td>
        <td>
            <a href="controllers/proyectos/edit.php?id=<?php echo $line['id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
            </a>
            <a href="controllers/proyectos/delete.php?id=<?php echo $line['id']?>" class="btn btn-danger">
            <i class="far fa-trash-alt"></i>
            </a>
            </td>
    </tr>
    <?php } ?>
        </tbody>
    </table>
</div>
    <!-- <div class="container p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-body">
                    <form action="controllers/proyectos.php">
                        <div class="form-group">
                            <input type="text" name="" class="form-control" autofocus>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
<?php include('includes/footer.php');?>