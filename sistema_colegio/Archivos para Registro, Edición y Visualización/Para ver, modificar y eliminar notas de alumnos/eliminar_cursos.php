<?php
// Incluir el archivo que contiene la conexión a la base de datos
include_once "conexion.php";

// Verificar si se ha recibido un parámetro 'id' por la URL (método GET)
if (!isset($_GET['id'])) {
    // Si no se recibe un ID, redirigir al listado de cursos
    header("Location: mostrar_cursos.php");
    exit;
}

// Convertir el valor del parámetro 'id' a un entero para mayor seguridad
$id = intval($_GET['id']);

// Preparar la consulta SQL para eliminar el curso con el ID recibido
$stmt = $mysqli->prepare("DELETE FROM cursos WHERE id_curso = ?");

// Asignar el valor del ID al parámetro de la consulta preparada
$stmt->bind_param("i", $id);

// Ejecutar la consulta
$stmt->execute();

// Redirigir al usuario nuevamente al listado de cursos después de eliminar
header("Location: mostrar_cursos.php");
exit;
