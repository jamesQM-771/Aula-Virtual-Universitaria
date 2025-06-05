<?php
include_once "conexion.php"; // Incluir archivo de conexión a la base de datos
include_once "header.php";   // Incluir cabecera común del sitio

// Consulta para obtener alumnos junto con el nombre del curso al que pertenecen
$sql = "SELECT a.id_Alumno, a.Nombre, a.Apellido, c.id_curso, c.Nombre_curso
        FROM alumnos a
        INNER JOIN cursos c ON a.id_curso = c.id_curso
        ORDER BY c.Nombre_curso, a.Apellido, a.Nombre";

$resultado = $mysqli->query($sql); // Ejecutar la consulta
$alumnos_por_curso = []; // Inicializar arreglo para agrupar alumnos por curso

if ($resultado && $resultado->num_rows > 0) {
    // Agrupar los alumnos por nombre del curso
    while ($row = $resultado->fetch_assoc()) {
        $curso = $row['Nombre_curso'];
        $alumnos_por_curso[$curso][] = $row;
    }
}
?>

<div class="container mb-4">
    <h2>Gestión de Notas</h2>
    <p>Selecciona un alumno para ver o registrar sus notas por materia y periodo.</p>

    <?php if (empty($alumnos_por_curso)): ?>
        <!-- Mostrar mensaje si no hay alumnos registrados -->
        <div class="alert alert-warning">No hay alumnos registrados.</div>
    <?php else: ?>
        <div class="accordion" id="acordeonCursos">
            <?php $index = 0; ?>
            <?php foreach ($alumnos_por_curso as $nombre_curso => $alumnos): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $index ?>">
                        <!-- Botón para desplegar o colapsar la lista de alumnos por curso -->
                        <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $index ?>">
                            <?= htmlspecialchars($nombre_curso) ?> <!-- Mostrar nombre del curso -->
                        </button>
                    </h2>
                    <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $index ?>" data-bs-parent="#acordeonCursos">
                        <div class="accordion-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th> <!-- ID del alumno -->
                                        <th>Nombre completo</th> <!-- Nombre y apellido del alumno -->
                                        <th>Acción</th> <!-- Botón para ver o editar notas -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alumnos as $alumno): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($alumno["id_Alumno"]) ?></td> <!-- Mostrar ID alumno -->
                                            <td><?= htmlspecialchars($alumno["Nombre"] . " " . $alumno["Apellido"]) ?></td> <!-- Mostrar nombre completo -->
                                            <td>
                                                <a href="obtener_notas.php?id=<?= $alumno["id_Alumno"] ?>" class="btn btn-primary btn-sm">
                                                    Ver / Editar Notas
                                                </a> <!-- Enlace para gestionar las notas del alumno -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php $index++; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include_once "footer.php"; ?> <!-- Incluir pie de página común -->




