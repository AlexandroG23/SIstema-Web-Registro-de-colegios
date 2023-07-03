<?php
session_start();

$url_base = "http://localhost/etersac/";

if (!isset($_SESSION['usuario'])) {
    header("Location:".$url_base."login.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../img/bus-ico.ico">
    <title>ETERSAC TRANSPORTES</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <!--  4:54:11 POR VER -->

</head>

<body class="bg-warning bg-opacity-10">
    <header>
        <!-- place navbar here -->
    </header>

    <nav class="navbar navbar-expand navbar-light bg-warning bg-opacity-10">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $url_base ?>" aria-current="page">Sistema Web <span
                        class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>secciones/colegios/">Colegios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>secciones/sedes/">Sedes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>secciones/usuarios/">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>cerrar.php">Logout</a>
            </li>
        </ul>
    </nav>

    <main class="container">
        <!-- SweetAlert2 funcion global -->
        <?php if (isset($_GET['mensaje'])) { ?>
            <script>
                Swal.fire({
                    title: '<?php echo $_GET['mensaje']; ?>',
                    icon: 'success'
                });
            </script>
        <?php } ?>