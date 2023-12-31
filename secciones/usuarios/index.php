<?php
include('../../bd.php');

if(isset($_GET['txtID'])){

    // Borrado
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : '';
    $sentencia = $conexion->prepare("DELETE FROM `tbl_usuarios` WHERE id=:id;");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $mensaje = "Registro Eliminado";
    header('Location: index.php?mensaje='. $mensaje);
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_tbl_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>


<?php 
include_once '..\..\templates\header.php';


?>

<h2 class="m-4 text-center ">Usuarios Registrados</h2>

<div class="card bg-success bg-opacity-25">
    <div class="card-header">
        <a name="" id="" class="btn btn-dark" href="crear.php" role="button">Agregar usuario</a>
    </div>
    <div class="card-body">
       
    <div class="table-responsive-sm">
        <table class="table " id="tabla_id">
            <thead>
                <tr>
                    <th class="text-center" scope="col">ID</th>
                    <th class="text-center" scope="col">Nombre del usuario</th>
                    <th class="text-center" scope="col">Contraseña</th>
                    <th class="text-center" scope="col">Correo</th>
                    <th class="text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($lista_tbl_usuarios as $registro){ ?>

                    <tr class="text-center">
                        <td scope="row"><?php echo $registro['id']; ?></td>
                        <td><?php echo $registro['usuario']; ?></td>
                        <td><?php echo $registro['password']; ?></td>
                        <td><?php echo $registro['correo']; ?></td>
                        <td>
                        <a class="btn btn-success" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                        <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>)" role="button">Eliminar</a>
                        </td>
                    </tr>
                    
                <?php } ?>

            </tbody>
        </table>
    </div>

    </div>
   
</div>





<?php 
include_once '..\..\templates\footer.php';

?>
