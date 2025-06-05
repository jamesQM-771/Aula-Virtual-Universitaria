<?php
// Incluir conexión a la base de datos
include_once "conexion.php";
// Incluir encabezado HTML común
include_once "header.php";

// Obtener el ID de la materia desde la URL, o null si no está definido
$id_materia = $_GET['id'] ?? null;

// Validar que se haya proporcionado un ID de materia
if (!$id_materia) {
    echo "<div class='alert alert-danger'>ID de materia no proporcionado.</div>";
    exit;
}

// Usamos la variable global $mysqli que viene de conexion.php
global $mysqli;

// Preparar consulta para obtener datos actuales de la materia
$stmt = $mysqli->prepare("SELECT * FROM materias WHERE id_materia = ?");
if (!$stmt) {
    die("Error en prepare: " . $mysqli->error);
}
// Asociar parámetro y ejecutar consulta
$stmt->bind_param("i", $id_materia);
$stmt->execute();
$resultado = $stmt->get_result();
// Obtener datos de la materia como arreglo asociativo
$materia = $resultado->fetch_assoc();
$stmt->close();

// Validar que la materia exista en la base de datos
if (!$materia) {
    echo "<div class='alert alert-danger'>Materia no encontrada.</div>";
    exit;
}

// Consultar la lista completa de docentes para el select
$result_docentes = $mysqli->query("SELECT id_docente, nombre, apellido FROM docentes");
if (!$result_docentes) {
    die("Error en consulta docentes: " . $mysqli->error);
}
// Guardar docentes en arreglo asociativo
$docentes = $result_docentes->fetch_all(MYSQLI_ASSOC);

// Consultar la lista completa de cursos para el select
$result_cursos = $mysqli->query("SELECT id_curso, nombre_curso FROM cursos");
if (!$result_cursos) {
    die("Error en consulta cursos: " . $mysqli->error);
}
// Guardar cursos en arreglo asociativo
$cursos = $result_cursos->fetch_all(MYSQLI_ASSOC);

// Procesar el formulario si fue enviado vía POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibir y validar campos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $id_docente = $_POST['id_docente'] ?? '';
    $id_curso = $_POST['id_curso'] ?? '';

    // Verificar que no estén vacíos
    if ($nombre && $id_docente && $id_curso) {
        // Preparar consulta para actualizar materia
        $stmt = $mysqli->prepare("UPDATE materias SET nombre = ?, id_docente = ?, id_curso = ? WHERE id_materia = ?");
        if (!$stmt) {
            die("Error en prepare update: " . $mysqli->error);
        }
        // Asociar parámetros y ejecutar
        $stmt->bind_param("siii", $nombre, $id_docente, $id_curso, $id_materia);
        $stmt->execute();
        $stmt->close();

        // Redirigir a la página de gestión de materias tras actualizar
        header("Location: gestion_de_materias.php");
        exit;
    } else {
        // Mostrar mensaje de error si faltan campos
        echo "<div class='alert alert-danger'>Todos los campos son obligatorios.</div>";
    }
}
?>

<!-- Formulario para editar materia -->
<div class="container mt-4">
    <h2>Editar Materia</h2>
    <form method="POST">
        <div class="form-group mb-3">
            <label>ID Materia</label>
            <!-- Mostrar ID sin posibilidad de editar -->
            <input type="text" class="form-control" value="<?= htmlspecialchars($materia['id_materia']) ?>" disabled>
        </div>
        <div class="form-group mb-3">
            <label>Nombre de la Materia</label>
            <!-- Campo para editar nombre de la materia -->
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($materia['nombre']) ?>" required>
        </div>
        <div class="form-group mb-3">
            <label>Docente</label>
            <!-- Select para elegir docente asignado -->
            <select name="id_docente" class="form-control" required>
                <option value="">Seleccione un docente</option>
                <?php foreach ($docentes as $docente): ?>
                    <option value="<?= $docente['id_docente'] ?>" <?= ($docente['id_docente'] == $materia['id_docente']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($docente['nombre'] . ' ' . $docente['apellido']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label>Curso</label>
            <!-- Select para elegir curso al que pertenece la materia -->
            <select name="id_curso" class="form-control" required>
                <option value="">Seleccione un curso</option>
                <?php foreach ($cursos as $curso): ?>
                    <option value="<?= $curso['id_curso'] ?>" <?= ($curso['id_curso'] == $materia['id_curso']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($curso['nombre_curso']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Botones para enviar formulario o cancelar -->
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="gestion_de_materias.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include_once "footer.php"; ?>

