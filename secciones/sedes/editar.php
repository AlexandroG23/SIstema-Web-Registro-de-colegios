<?php
include("../../bd.php");

if(isset($_GET['txtID'])){

    // Editar
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : '';

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_sedes` WHERE id=:id;");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombredelasede = $registro['nombre_sede'];

    //header('Location: index.php');
}

if($_POST){
    print_r($_POST);
    // Recolectamos los datos del metodo POST
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : '';
    $nombredelasede = (isset($_POST['nombredelasede'])) ? $_POST['nombredelasede'] : '';

    // Preparar la inserccion de los datos
    $sentencia = $conexion->prepare("UPDATE `tbl_sedes` SET nombre_sede=:nombredelasede WHERE id=:id;");

    // Asignar los valores a que vienen del metodo POST (Los que vienen del formulario)
    $sentencia->bindParam(':nombredelasede', $nombredelasede);
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $mensaje = "Registro actualizado";
    header('Location: index.php?mensaje='. $mensaje);
}

?>


<?php 
include_once '..\..\templates\header.php';

?>

<h2 class="m-4 text-center ">Editar sedes</h2>

<div class="card">
    <div class="card-header bg-success bg-opacity-25">
        Sedes
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="txtID" class="form-label">ID:</label>
      <input type="text" value="<?php echo $txtID; ?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    </div>

    <div class="mb-3">
      <label for="nombredelasede" class="form-label">Nombre de la sede:</label>
      <input type="text" value="<?php echo $nombredelasede; ?>"
        class="form-control" name="nombredelasede" id="nombredelasede" aria-describedby="helpId" placeholder="Ingrese el nombre de la sede">
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