<?php
// Incluir archivo de conexión a la base de datos
include_once "conexion.php";
// Incluir encabezado HTML común
include_once "header.php";

// Verificar que se haya recibido el parámetro 'id' por GET
if (!isset($_GET['id'])) {
    // Redirigir a la página de mostrar cursos si no hay ID
    header("Location: mostrar_cursos.php");
    exit;
}

// Convertir el parámetro 'id' a entero para mayor seguridad
$id = intval($_GET['id']);

// Preparar consulta para obtener el nombre del curso según el ID
$stmt = $mysqli->prepare("SELECT nombre_curso FROM cursos WHERE id_curso = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontró el curso con el ID proporcionado
if ($result->num_rows === 0) {
    echo "<p>Curso no encontrado.</p>";
    exit;
}

// Obtener datos del curso en forma asociativa
$curso = $result->fetch_assoc();

// Procesar el formulario solo si se envió vía POST y el campo nombre_curso no está vacío
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["nombre_curso"])) {
    // Limpiar espacios en blanco al inicio y final del nombre nuevo
    $nuevo_nombre = trim($_POST["nombre_curso"]);

    // Preparar consulta para actualizar el nombre del curso
    $stmt = $mysqli->prepare("UPDATE cursos SET nombre_curso = ? WHERE id_curso = ?");
    $stmt->bind_param("si", $nuevo_nombre, $id);
    $stmt->execute();

    // Redirigir a la página para mostrar cursos luego de la actualización
    header("Location: mostrar_cursos.php");
    exit;
}
?>

<!-- Contenedor principal del formulario -->
<div class="container mt-5">
    <h2>Editar Curso</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nombre_curso" class="form-label">Nombre del Curso</label>
            <!-- Mostrar el nombre actual del curso en el campo input -->
            <input type="text" name="nombre_curso" id="nombre_curso" class="form-control" 
                   value="<?= htmlspecialchars($curso['nombre_curso']) ?>" required>
        </div>
        <!-- Botón para enviar el formulario y actualizar el curso -->
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <!-- Botón para cancelar y volver a la lista de cursos -->
        <a href="mostrar_cursos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include_once "footer.php"; ?>

