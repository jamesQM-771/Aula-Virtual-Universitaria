<?php
include_once "conexion.php";  // Incluir conexión a la base de datos
include_once "header.php";    // Incluir encabezado común de la página

// Procesar el formulario cuando se envía (método POST) y el campo no está vacío
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["nombre_curso"])) {
    // Limpiar el nombre del curso recibido desde el formulario
    $nombre = trim($_POST["nombre_curso"]);

    // Preparar la sentencia SQL para insertar el nuevo curso
    $stmt = $mysqli->prepare("INSERT INTO cursos (nombre_curso) VALUES (?)");
    $stmt->bind_param("s", $nombre);  // Asociar el parámetro

    // Ejecutar la consulta para insertar el curso
    $stmt->execute();

    // Redireccionar a la página que muestra todos los cursos
    header("Location: mostrar_cursos.php");
    exit; // Terminar ejecución después de la redirección
}
?>

<div class="container mt-5">
    <h2>Nuevo Curso</h2>
    <!-- Formulario para ingresar nuevo curso -->
    <form method="POST" action="nuevo_cursos.php">
        <div class="mb-3">
            <label for="nombre_curso" class="form-label">Nombre del Curso</label>
            <input type="text" name="nombre_curso" id="nombre_curso" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="mostrar_cursos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include_once "footer.php"; // Incluir pie de página ?>

