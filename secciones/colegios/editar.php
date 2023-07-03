<?php
include('../../bd.php');

if (isset($_GET['txtID'])) {

    // Editar
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : '';

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_colegios` WHERE id=:id;");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $nombredecolegio = $registro['nombre'];
    $foto = $registro['foto'];
    $address = $registro['address'];
    $idsede = $registro['idsede'];
    $fechaderegistro = $registro['fechaderegistro'];

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_sedes`");
    $sentencia->execute();
    $lista_tbl_sedes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    //header('Location: index.php');
}

if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : '';
    $nombredecolegio = (isset($_POST['nombredecolegio'])) ? $_POST['nombredecolegio'] : '';

    $address = (isset($_POST['address'])) ? $_POST['address'] : '';
    $idsede = (isset($_POST['idsede'])) ? $_POST['idsede'] : '';
    $fechaderegistro = (isset($_POST['fechaderegistro'])) ? $_POST['fechaderegistro'] : '';

    $sentencia = $conexion->prepare("UPDATE `tbl_colegios` SET nombre=:nombre, address=:address, idsede=:idsede, fechaderegistro=:fechaderegistro WHERE id=:id;");

    $sentencia->bindParam(':nombre', $nombredecolegio);

    $sentencia->bindParam(':address', $address);
    $sentencia->bindParam(':idsede', $idsede);
    $sentencia->bindParam(':fechaderegistro', $fechaderegistro);
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();

    $foto = (isset($_FILES['foto']['name'])) ? $_FILES['foto']['name'] : '';

    $fecha_foto = new DateTime();
    $nombreArchivo_foto = ($foto != "") ? $fecha_foto->getTimestamp() . "_" . $_FILES["foto"]["name"] : "";
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if ($tmp_foto != "") {
        move_uploaded_file($tmp_foto, "../../img/" . $nombreArchivo_foto);
        $sentencia = $conexion->prepare("SELECT foto FROM `tbl_colegios` WHERE id=:id;");
        $sentencia->bindParam(':id', $txtID);
        $sentencia->execute();
        $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);

        print_r($registro_recuperado);

        if (isset($registro_recuperado['foto']) && $registro_recuperado['foto'] != '') {
            if (file_exists('../../img/' . $registro_recuperado['foto'])) {
                unlink('../../img/' . $registro_recuperado['foto']);
            }
        }
        $sentencia = $conexion->prepare("UPDATE `tbl_colegios` SET foto=:foto WHERE id=:id;");
        $sentencia->bindParam(':foto', $nombreArchivo_foto);
        $sentencia->bindParam(':id', $txtID);
        $sentencia->execute();
    }

    $mensaje = "Registro actualizado";
    header('Location: index.php?mensaje='. $mensaje);
}

?>

<?php
include_once '..\..\templates\header.php';

?>

<h2 class="m-4 text-center">Editar colegio</h2>

<div class="card">
    <div class="card-header bg-info fw-semibold">
        Datos del colegio
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="nombredecolegio" class="form-label">Nombre de la institución:</label>
                <input type="text" value="<?php echo $nombredecolegio; ?>" class="form-control" name="nombredecolegio"
                    id="nombredecolegio" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label>
                <br />

                <img width="100" src="../../img/<?php echo $foto; ?>" class="img-fluid rounded m-2" alt="">
                <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Dirección:</label>
                <input type="text" value="<?php echo $address; ?>" class="form-control" name="address" id="address"
                    aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="idsede" class="form-label">Sede:</label>
                <select class="form-select form-select-sm" name="idsede" id="idsede">
                    <?php foreach ($lista_tbl_sedes as $registro) { ?>
                        <option <?php echo ($idsede == $registro['id']) ? "selected" : ""; ?>
                            value="<?php echo $registro['id'] ?>"><?php echo $registro['nombre_sede'] ?></option>
                    <?php } ?>
                </select>

            </div>

            <div class="mb-3">
                <label for="fechaderegistro" class="form-label">Fecha de registro:</label>
                <input type="Date" value="<?php echo $fechaderegistro; ?>" class="form-control" name="fechaderegistro"
                    id="fechaderegistro" aria-describedby="" placeholder="Fecha de registro">
            </div>

            <button type="submit" class="btn btn-success">Agregar registro</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php
include_once '..\..\templates\footer.php';

?>