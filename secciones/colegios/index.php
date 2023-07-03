<?php
include('../../bd.php');

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : '';

    // Buscar el archivo relacionado con el colegio
    $sentencia = $conexion->prepare("SELECT foto FROM `tbl_colegios` WHERE id=:id;");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);

    print_r($registro_recuperado);

    if(isset($registro_recuperado['foto']) && $registro_recuperado['foto'] != ''){
        if(file_exists('../../img/'.$registro_recuperado['foto'])){
            unlink('../../img/'.$registro_recuperado['foto']);
        }
    }

    // Borrado
    $sentencia = $conexion->prepare("DELETE FROM `tbl_colegios` WHERE id=:id;");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $mensaje = "Registro Eliminado";
    header('Location: index.php?mensaje='. $mensaje);
}

$sentencia = $conexion->prepare("SELECT *,
(SELECT nombre_sede 
FROM `tbl_sedes` 
WHERE tbl_sedes.id=tbl_colegios.idsede limit 1) as sedes
FROM `tbl_colegios`");
$sentencia->execute();
$lista_tbl_colegios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
include_once '..\..\templates\header.php';

?>
<h2 class="m-4 text-center ">Colegios registrados</h2>

<div class="card bg-warning bg-opacity-50">
    <div class="card-header">
        <a name="" id="" class="btn btn-dark" href="crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table fw-lighter " id="tabla_id">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Nombre</th>
                        <th class="text-center" scope="col">Imagen</th>
                        <th class="text-center" scope="col">Sede</th>
                        <th class="text-center" scope="col">Dirección</th>
                        <th class="text-center" scope="col">Fecha de registro</th>
                        <th class="text-center" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($lista_tbl_colegios as $registro) { ?>
                        <tr class="text-center">
                            <td>
                                <?php echo $registro['id']; ?>
                            </td>
                            <td scope="row">
                                <?php echo $registro['nombre']; ?>
                            </td>
                            <td>
                                <img width="70" src="../../img/<?php echo $registro['foto']; ?>" class="img-fluid rounded"
                                    alt="">
                            </td>
                            <td>
                                <?php echo $registro['sedes']; ?>
                            </td>
                            <td>
                                <?php echo $registro['address']; ?>
                            </td>
                            <td>
                                <?php echo $registro['fechaderegistro']; ?>
                            </td>
                            <td>
                                <a class="btn btn-success" href="editar.php?txtID=<?php echo $registro['id']; ?>"
                                    role="button">Editar</a>
                                <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>)"
                                    role="button">Eliminar</a>
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