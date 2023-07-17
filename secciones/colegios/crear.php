<?php 
include('..\..\bd.php');

if($_POST){
    
    $nombredecolegio = (isset($_POST['nombredecolegio'])) ? $_POST['nombredecolegio'] : '';
    $foto = (isset($_FILES['foto']['name'])) ? $_FILES['foto']['name']: '';
    $address = (isset($_POST['address'])) ? $_POST['address'] : '';
    $idsede = (isset($_POST['idsede'])) ? $_POST['idsede'] : '';
    $fechaderegistro = (isset($_POST['fechaderegistro'])) ? $_POST['fechaderegistro'] : '';

    $sentencia = $conexion->prepare("INSERT INTO `tbl_colegios` (`id`, `nombre`, `foto`,`address`, `idsede`, `fechaderegistro`) VALUES (NULL, :nombre, :foto,  :address, :idsede, :fechaderegistro);");

    $sentencia->bindParam(':nombre', $nombredecolegio);

    $fecha_foto = new DateTime();   
    $nombreArchivo_foto = ($foto!="")?$fecha_foto->getTimestamp()."_".$_FILES["foto"]["name"]:"";
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if($tmp_foto!=""){
        move_uploaded_file($tmp_foto,"../../img/".$nombreArchivo_foto);
    }

    $sentencia->bindParam(':foto', $nombreArchivo_foto);
    $sentencia->bindParam(':address', $address);
    $sentencia->bindParam(':idsede', $idsede);
    $sentencia->bindParam(':fechaderegistro', $fechaderegistro);
    $sentencia->execute();
    $mensaje = "Registro agregado";
    header('Location: index.php?mensaje='. $mensaje);

}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_sedes`");
$sentencia->execute();
$lista_tbl_sedes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>


<?php 
include_once '..\..\templates\header.php';

?>

<h2 class="m-4 text-center">Agregar colegio</h2>

<div class="card">
    <div class="card-header bg-info fw-semibold">
        Datos del colegio
    </div>
    <div class="card-body">
       
    <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
          <label for="nombredecolegio" class="form-label">Nombre de la institución:</label>
          <input type="text"
            class="form-control" name="nombredecolegio" id="nombredecolegio" aria-describedby="helpId" placeholder="">
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto:</label>
            <input type="file"
                class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Dirección:</label>
            <input type="text"
                class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="">
        </div>

        <div class="mb-3">
            <label for="idsede" class="form-label">Sede:</label>

            <select class="form-select form-select-sm" name="idsede" id="idsede">
            <?php foreach($lista_tbl_sedes as $registro){ ?>
                <option value="<?php echo $registro['id'] ?>"><?php echo $registro['nombre_sede'] ?></option>
            <?php }?>
            </select>

        </div>

        <div class="mb-3">
          <label for="fechaderegistro" class="form-label">Fecha de registro:</label>
          <input type="Date" class="form-control" name="fechaderegistro" id="fechaderegistro" aria-describedby="" placeholder="Fecha de registro">
        </div>

    <button type="submit" class="btn btn-success">Agregar colegio</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    
    </form>

    </div>
    <div class="card-footer text-muted">
       
    </div>
</div>



<?php 
include_once '..\..\templates\footer.php';

?>
