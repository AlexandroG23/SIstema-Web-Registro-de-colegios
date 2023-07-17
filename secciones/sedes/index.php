<?php
include('..\..\bd.php');

if (isset($_GET['txtID'])) {

    // Borrado
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : '';
    $sentencia = $conexion->prepare("DELETE FROM `tbl_sedes` WHERE id=:id;");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header('Location: index.php?mensaje='. $mensaje);
}


$sentencia = $conexion->prepare("SELECT * FROM `tbl_sedes`");
$sentencia->execute();
$lista_tbl_sedes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php
include_once '..\..\templates\header.php';
?>
<?php if (isset($_GET['mensaje'])) { ?>
    <script>
        Swal.fire({
            title: '<?php echo $_GET['mensaje']; ?>',
            icon: 'success'
        });
    </script>
<?php } ?>


<h2 class="m-4 text-center ">Sedes Registradas</h2>

<div class="card bg-info bg-opacity-25">
    <div class="card-header">
        <a name="" id="" class="btn btn-dark" href="crear.php" role="button">Agregar Sedes</a>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm ">
            <table class="table " id="tabla_id">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Nombre de la institución</th>
                        <th class="text-center" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($lista_tbl_sedes as $registro) { ?>

                        <tr class="text-center">
                            <td scope="row">
                                <?php echo $registro['id']; ?>
                            </td>
                            <td>
                                <?php echo $registro['nombre_sede']; ?>
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
