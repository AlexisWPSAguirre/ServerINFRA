<?php 
include("../config/db.php"); 
include("includes/header.php");
include('includes/styles.php');
if(isset($_POST['crear'])){
        $id = $_GET["id"];
        $query = "INSERT INTO certificado_disponibilidad(rubro,valor,fuente_recursos,anticipo,contrato_fk)
        VALUES('".$_POST['rubro']."','".$_POST['valor']."','".$_POST['fuente_recursos']."',
        '".$_POST['anticipo']."','".$_POST['contrato_fk']."')";
        pg_query($query);
        header('Location:list_certificaedo.php');
    }

?>
<div class="container p-4">
    <div class="card card-body">
        <div class="row">
            <div class="col">
                <form action="crear_certificado.php" method="POST">
                    <div class="mb-3">  
                        <label for="" class="form-label">No. contrato</label>
                        <select name="contrato_fk" id="" class="form-select">
                            <?php
                                $query = "SELECT * FROM contrato";
                                $result = pg_query($query);
                                while($line = pg_fetch_assoc($result)){
                            ?>
                            <option value="<?= $line['id'] ?>"><?= $line['no_contrato']?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Rubro</label>
                        <input type="text" name="rubro" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Valor</label>
                        <input type="text" name="valor" class="form-control">
                    </div>
                    <div class="mb-1 abs-center">
                        <button type="submit" class="btn btn-secondary" name="crear">
                            GUARDAR
                        </button>
                    </div>
            </div>
            <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Fuente Recursos</label>
                            <input type="text" name="fuente_recursos" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Anticipo</label>
                            <input type="text" name="anticipo" class="form-control">
                        </div>
                        <div class="mb-1 abs-center">
                            <a href="list_certificado.php" class="btn btn-danger">
                                CANCELAR
                            </a>
                        </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>