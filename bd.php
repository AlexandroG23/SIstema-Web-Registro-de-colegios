<?php  
$servidor = 'localhost';
$usuario = 'root';
$password = '';
$bd = 'etersac';

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>