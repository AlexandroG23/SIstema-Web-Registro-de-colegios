<?php 
include('..\..\bd.php');

if($_POST){
    // Recolectamos los datos del metodo POST
    $nombredelasede = (isset($_POST['nombredelasede'])) ? $_POST['nombredelasede'] : '';

    // Preparar la inserccion de los datos
    $sentencia = $conexion->prepare("INSERT INTO `tbl_sedes` (id,nombre_sede) VALUES (NULL, :nombredelasede);");

    // Asignar los valores a que vienen del metodo POST (Los que vienen del formulario)
    $sentencia->bindParam(':nombredelasede', $nombredelasede);
    $sentencia->execute();
    $mensaje = "Registro agregado";
    header('Location: index.php?mensaje='. $mensaje);
}



?>


<?php 
include_once '..\..\templates\header.php';
?>

<h2 class="m-4 text-center ">Agregar de sedes</h2>

<div class="card">
    <div class="card-header bg-success bg-opacity-25">
        Sedes
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="nombredelasede" class="form-label">Nombre de la sede:</label>
      <input type="text"
        class="form-control" name="nombredelasede" id="nombredelasede" aria-describedby="helpId" placeholder="Nombre de la sede">
    </div>

    <button type="submit" class="btn btn-success">Agregar</button>
    <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


    </form>

    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>


<?php 
include_once '..\..\templates\header.php';

?>