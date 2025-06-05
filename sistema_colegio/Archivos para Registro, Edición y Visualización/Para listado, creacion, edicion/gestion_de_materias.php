<?php
// Incluye la conexión a la base de datos
include_once "conexion.php";

// Incluye la clase Materia, donde se encuentra la lógica para manejar materias
include_once "Materia.php";

// Incluye el encabezado HTML (header)
include_once "header.php";

// Obtiene todas las materias usando el método estático de la clase Materia
$materias = Materia::obtener();

// Organiza las materias agrupándolas por nombre del curso
$materiasPorCurso = [];
foreach ($materias as $materia) {
    $materiasPorCurso[$materia["nombre_curso"]][] = $materia;
}
?>

<div class="container mb-4">
    <h2 class="mb-4 text-center">📚 Listado de Materias por Curso</h2>

    <!-- Botón para agregar una nueva materia -->
    <div class="d-flex justify-content-end mb-3">
        <a href="nueva_materia.php" class="btn btn-primary shadow-sm">➕ Nueva materia</a>
    </div>

    <!-- Inicio del acordeón de cursos -->
    <div class="accordion" id="acordeonCursos">
        <?php $i = 0; foreach ($materiasPorCurso as $curso => $materias): ?>
            <div class="accordion-item mb-3 shadow-sm rounded border">
                <h2 class="accordion-header" id="heading<?= $i ?>">
                    <button class="accordion-button fw-semibold <?= $i !== 0 ? 'collapsed' : '' ?> bg-light text-dark"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapse<?= $i ?>"
                            aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>"
                            aria-controls="collapse<?= $i ?>">
                        🎓 <?= htmlspecialchars($curso) ?>
                        <span class="accordion-icon ms-auto"></span>
                    </button>
                </h2>

                <!-- Cuerpo del acordeón, muestra la tabla de materias del curso -->
                <div id="collapse<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>"
                     aria-labelledby="heading<?= $i ?>" data-bs-parent="#acordeonCursos">
                    <div class="accordion-body bg-white p-3">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Materia</th>
                                        <th>Docente</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Recorre y muestra cada materia del curso actual -->
                                    <?php foreach ($materias as $materia): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($materia["id_materia"]) ?></td>
                                            <td><?= htmlspecialchars($materia["nombre"]) ?></td>
                                            <td><?= htmlspecialchars($materia["docente"]) ?></td>
                                            <td class="text-end">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                                    <!-- Botón para editar la materia -->
                                                    <a href="editar_materias.php?id=<?= htmlspecialchars($materia["id_materia"]) ?>"
                                                       class="btn btn-outline-warning" title="Editar">
                                                        ✏️ Editar
                                                    </a>
                                                    <!-- Botón para eliminar la materia, con confirmación -->
                                                    <a href="eliminar_materias.php?id=<?= htmlspecialchars($materia["id_materia"]) ?>"
                                                       class="btn btn-outline-danger" title="Eliminar"
                                                       onclick="return confirm('¿Seguro que deseas eliminar esta materia?')">
                                                        🗑️ Eliminar
                                                    </a>
                                                </div>
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

    <!-- Inclusión de Bootstrap JS para que funcione el acordeón -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include_once "footer.php"; ?>
