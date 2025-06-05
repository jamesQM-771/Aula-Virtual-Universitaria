<?php
// Incluir archivo de conexión a la base de datos
include_once "conexion.php";

// Obtener el ID del alumno desde la URL (GET) y convertirlo a entero
$id_alumno = isset($_GET["id_alumno"]) ? intval($_GET["id_alumno"]) : 0;

// Obtener el ID de la materia desde la URL (GET) y convertirlo a entero
$id_materia = isset($_GET["id_materia"]) ? intval($_GET["id_materia"]) : 0;

// Verificar que ambos ID sean válidos (distintos de 0)
if (!$id_alumno || !$id_materia) {
    die("ID de alumno o materia no especificado o inválido.");
}

// Preparar la consulta SQL para eliminar la nota específica del alumno en la materia
$stmt = $mysqli->prepare("DELETE FROM notas WHERE id_alumno = ? AND id_materia = ?");
$stmt->bind_param("ii", $id_alumno, $id_materia);
$stmt->execute();
$stmt->close();

// Redirigir al usuario a la página que muestra las notas del alumno
header("Location: obtener_notas.php?id=$id_alumno");
exit;
?>

<?php
// Comentario duplicado y fuera de lugar, puede eliminarse o integrarse en la sección superior correctamente
// Redirigir al usuario después de eliminar la nota
?>
