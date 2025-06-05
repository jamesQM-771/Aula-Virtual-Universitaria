<?php
include_once "conexion.php"; // Incluye el archivo de conexión a la base de datos
include_once "header.php";  // Incluye la cabecera común del sitio

/* obtener todos los cursos con sus nombres */
$curso_nombres = [  1 => "Diseño Gráfico",
    2 => "Diseño y Administración de Modas",
    3 => "Administración Turística y Hotelera",
    4 => "Ingeniería de Software",
    5 => "Administración de Negocios Internacionales",
    6 => "Administración Financiera",
    7 => "Administración de Negocios Internacionales (Distancia)",
    8 => "Gestión Logística Empresarial"]; // Array con nombres de cursos por defecto (por si no hay en BD)

$resultado_cursos = $mysqli->query("SELECT id_curso, nombre_curso FROM cursos"); // Consulta para obtener cursos de la base de datos
if ($resultado_cursos && $resultado_cursos->num_rows > 0) {
    while ($fila_curso = $resultado_cursos->fetch_assoc()) {
        $curso_nombres[$fila_curso['id_curso']] = $fila_curso['nombre_curso']; // Actualiza el array con los nombres reales de la BD
    }
}

/* obtener todos los alumnos y ordenarlos por curso */
$resultado = $mysqli->query("SELECT * FROM alumnos ORDER BY id_curso, id_alumno"); // Consulta para obtener todos los alumnos ordenados

$alumnos_por_curso = []; // Array para agrupar alumnos por curso

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $curso = $fila['id_curso'];
        $alumnos_por_curso[$curso][] = $fila; // Agrupa cada alumno dentro del curso correspondiente
    }
}
?>

<div class="container mt-4">
    <h2>Listado de alumnos</h2>
    <a href="formulario_alumnos.php" class="btn btn-primary mb-3">➕ Nuevo</a> <!-- Botón para agregar nuevo alumno -->

    <?php if (empty($alumnos_por_curso)): ?>
        <div class="alert alert-warning">No hay alumnos registrados.</div> <!-- Mensaje si no hay alumnos -->
    <?php else: ?>
        <div class="accordion" id="acordeon_cursos"> <!-- Acordeón para mostrar cursos con sus alumnos -->
            <?php $i = 0; foreach ($alumnos_por_curso as $curso => $grupo): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $i ?>">
                        <button class="accordion-button <?= $i !== 0 ? 'collapsed' : '' ?>"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse<?= $i ?>"
                                aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>"
                                aria-controls="collapse<?= $i ?>">
                            Curso: <?= htmlspecialchars($curso_nombres[$curso] ?? "Desconocido") ?> <!-- Título del curso -->
                        </button>
                    </h2>

                    <div id="collapse<?= $i ?>"
                         class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>"
                         aria-labelledby="heading<?= $i ?>"
                         data-bs-parent="#acordeon_cursos">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped mb-0">
                                    <thead class="table-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Identidad</th>
                                            <th>Nombre completo</th>
                                            <th>Curso</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                            <th>Nacimiento</th>
                                            <th>Sexo</th>
                                            <th>Notas</th>
                                            <th>Datos completos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($grupo as $alumno): ?>
                                            <tr>
                                                <td><?= $alumno['id_alumno'] ?></td> <!-- ID del alumno -->
                                                <td><?= $alumno['n_identidad'] ?></td> <!-- Número de identidad -->
                                                <td><?= $alumno['nombre'] . ' ' . $alumno['apellido'] ?></td> <!-- Nombre completo -->
                                                <td><?= htmlspecialchars($curso_nombres[$alumno['id_curso']] ?? $alumno['id_curso']) ?></td> <!-- Nombre del curso -->
                                                <td><?= $alumno['telefono'] ?></td> <!-- Teléfono -->
                                                <td><?= $alumno['direccion'] ?></td> <!-- Dirección -->
                                                <td><?= $alumno['f_nacimiento'] ?></td> <!-- Fecha de nacimiento -->
                                                <td><?= $alumno['sexo'] ?></td> <!-- Sexo -->
                                                <td>
                                                    <a href="obtener_notas.php?id=<?= $alumno['id_alumno'] ?>" class="btn btn-info btn-sm">Ver</a> <!-- Botón para ver notas -->
                                                </td>
                                                <td>
                                                    <a href="editar_alumnos.php?id=<?= $alumno['id_alumno'] ?>" class="btn btn-warning btn-sm">Editar</a> <!-- Botón para editar alumno -->
                                                    <a href="eliminar_alumnos.php?id=<?= $alumno['id_alumno'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este alumno?')">Eliminar</a> <!-- Botón para eliminar alumno con confirmación -->
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++; endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include_once "footer.php"; ?> <!-- Incluye el pie de página común -->






