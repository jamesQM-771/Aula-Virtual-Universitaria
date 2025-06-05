<?php
require_once "conexion.php"; // Incluir conexión a la base de datos
require_once "Materia.php";  // Incluir clase Materia (si se usa en este archivo)
include_once "header.php";   // Incluir encabezado común de la página

// Archivo: nueva_materia.php

// Obtener la lista de cursos desde la base de datos para llenar el <select>
$cursos_result = $mysqli->query("SELECT id_curso, Nombre_curso FROM cursos");
$cursos = $cursos_result->fetch_all(MYSQLI_ASSOC);

// Obtener la lista de docentes para el <select>
$docentes_result = $mysqli->query("SELECT id_Docente, Nombre FROM docentes");
$docentes = $docentes_result->fetch_all(MYSQLI_ASSOC);

// Variables para edición: obtener id de materia si está presente en la URL
$id_materia = $_GET['id'] ?? null;
$materia = null;

// Si se proporciona un id, se cargan los datos de la materia para editar
if ($id_materia) {
    $stmt = $mysqli->prepare("SELECT * FROM materias WHERE id_Materia = ?");
    $stmt->bind_param("i", $id_materia);
    $stmt->execute();
    // Obtener resultado como objeto para acceder a propiedades más fácilmente
    $materia = $stmt->get_result()->fetch_object();
}
?>

<div class="container mt-4">
    <!-- Mostrar título dinámico según si es edición o creación -->
    <h2><?= $id_materia ? "Editar Materia" : "Nueva Materia" ?></h2>
    <!-- Formulario que apunta a actualizar o guardar según la acción -->
    <form action="<?= $id_materia ? 'actualizar_materia.php' : 'guardar_materia.php' ?>" method="post">
        <?php if ($id_materia): ?>
            <!-- Campo oculto para enviar el id en caso de edición -->
            <input type="hidden" name="id_Materia" value="<?= $materia->id_Materia ?>">
        <?php endif; ?>

        <!-- Campo para el nombre de la materia -->
        <div class="form-group">
            <label for="nombre">Nombre de la Materia</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required
                value="<?= $materia ? htmlspecialchars($materia->Nombre) : '' ?>">
        </div>

        <!-- Selector de curso -->
        <div class="form-group">
            <label for="id_curso">Curso</label>
            <select class="form-control" id="id_curso" name="id_curso" required>
                <option value="">-- Seleccione un curso --</option>
                <?php foreach ($cursos as $curso): ?>
                    <option value="<?= $curso['id_curso'] ?>"
                        <?= $materia && $materia->id_curso == $curso['id_curso'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($curso['Nombre_curso']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Selector de docente -->
        <div class="form-group">
            <label for="id_docente">Docente</label>
            <select class="form-control" id="id_docente" name="id_docente" required>
                <option value="">-- Seleccione un docente --</option>
                <?php foreach ($docentes as $docente): ?>
                    <option value="<?= $docente['id_Docente'] ?>"
                        <?= $materia && $materia->id_Docente == $docente['id_Docente'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($docente['Nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Botones para enviar formulario o cancelar -->
        <button type="submit" class="btn btn-primary"><?= $id_materia ? 'Actualizar' : 'Guardar' ?></button>
        <a href="gestion_de_materias.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include_once "footer.php"; // Incluir pie de página ?>
