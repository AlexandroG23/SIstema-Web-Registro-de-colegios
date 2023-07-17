<?php
include('..\..\bd.php');

if ($_POST) {

  // Recolectamos los datos del metodo POST
  $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
  // Recolectamos los datos del metodo POST
  $password = (isset($_POST['password'])) ? $_POST['password'] : '';
  // Recolectamos los datos del metodo POST
  $correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';

  // Preparar la inserccion de los datos
  $sentencia = $conexion->prepare("INSERT INTO `tbl_usuarios` (id,usuario,password,correo) VALUES (NULL, :usuario, :password, :correo);");

  // Asigna valores que tienen uso de :variable
  $sentencia->bindParam(':usuario', $usuario);
  $sentencia->bindParam(':password', $password);
  $sentencia->bindParam(':correo', $correo);
  $sentencia->execute();
  $mensaje = "Usuario agregado";
  header('Location: index.php?mensaje=' . $mensaje);

}

?>


<?php
include_once '..\..\templates\header.php';

?>

<h2 class="m-4 text-center ">Agregar de usuarios</h2>

<div class="card">
  <div class="card-header bg-warning">
    Datos del usuario
  </div>
  <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

      <div class="mb-3">
        <label for="usuario" class="form-label">Nombre del usuario:</label>
        <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId"
          placeholder="Nombre del usuario">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId"
          placeholder="Escriba su contraseña">
      </div>

      <div class="mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId"
          placeholder="Escriba su correo">
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
