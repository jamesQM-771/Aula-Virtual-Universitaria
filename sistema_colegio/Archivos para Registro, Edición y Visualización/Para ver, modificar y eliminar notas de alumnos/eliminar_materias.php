<?php
// Incluir el archivo de conexión a la base de datos
include_once "conexion.php";

// Incluir la clase Materia que contiene métodos relacionados con la gestión de materias
include_once "Materia.php";

// Verificar que se haya recibido un ID de materia por el método GET
$id_materia = $_GET['id'] ?? null;

if (!$id_materia) {
    // Si no se recibe el ID, mostrar un mensaje de error y detener la ejecución
    echo "<div class='alert alert-danger'>ID de materia no proporcionado.</div>";
    exit;
}

try {
    // Intentar eliminar la materia utilizando el método estático eliminar() de la clase Materia
    Materia::eliminar($id_materia);

    // Si la eliminación fue exitosa, redirigir al usuario al listado de materias
    header("Location: gestion_de_materias.php");
    exit;
} catch (Exception $e) {
    // En caso de error, mostrar un mensaje informando el problema
    echo "<div class='alert alert-danger'>Error al eliminar la materia: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>
