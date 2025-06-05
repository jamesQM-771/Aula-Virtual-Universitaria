<?php
include_once "conexion.php";
include_once "alumnos.php";
include_once "Materia.php";

$id_alumno = intval($_GET["id"] ?? 0);
if ($id_alumno <= 0) {
    die("ID de alumno inválido.");
}

$alumno = alumnos::obtenerUno($id_alumno);
if (!$alumno) {
    die("Alumno no encontrado.");
}

// Obtener todas las materias del curso del alumno
$materias = Materia::obtenerPorCurso($alumno->id_curso);
if (!$materias || !is_array($materias)) {
    die("Error al obtener las materias: " . $mysqli->error);
}

// Obtener las notas del alumno
$stmt = $mysqli->prepare("SELECT id_materia, total FROM notas WHERE id_alumno = ?");
$stmt->bind_param("i", $id_alumno);
$stmt->execute();
$resultado = $stmt->get_result();
$notas = [];
while ($fila = $resultado->fetch_assoc()) {
    $notas[$fila["id_materia"]] = $fila["total"];
}
?>
<?php include_once "header.php"; ?>

<div class="container mt-4">

    <!-- Mostrar mensaje de éxito -->
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'success'): ?>
        <div class="alert alert-success" role="alert">
            Nota guardada con éxito.
        </div>
    <?php endif; ?>

    <h1>Notas de <?= htmlspecialchars($alumno->nombre . ' ' . $alumno->apellido) ?></h1>
    <table class="table">
        <thead>
            <tr>
                <th>Materia</th>
                <th>Nota</th>
                <th>Guardar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $suma = 0;
            $contador = 0;
            foreach ($materias as $materia):
                $puntaje = $notas[$materia["id_materia"]] ?? 0;
                $suma += $puntaje;
                $contador++;
            ?>
            <tr>
                <td><?= htmlspecialchars($materia["nombre"]) ?></td>

                <td>
                    <!-- Formulario para actualizar nota -->
                    <form action="modificar_notas.php" method="POST" class="form-inline d-flex align-items-center" style="gap:0.5rem;">
                        <input type="hidden" name="id_alumno" value="<?= $id_alumno ?>">
                        <input type="hidden" name="id_materia" value="<?= intval($materia["id_materia"]) ?>">
                        <input type="number" name="puntaje" class="form-control" value="<?= intval($puntaje) ?>" min="0" max="100" required style="width:5rem;">
                </td>
                <td>
                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                    </form>
                </td>

                <td>
                    <!-- Formulario para eliminar nota -->
                    <form action="eliminar_nota.php" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta nota?');">
                        <input type="hidden" name="id_alumno" value="<?= $id_alumno ?>">
                        <input type="hidden" name="id_materia" value="<?= intval($materia["id_materia"]) ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td><strong>Promedio</strong></td>
                <td><strong><?= $contador > 0 ? round($suma / $contador, 2) : 0 ?></strong></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>

<?php include_once "footer.php"; ?>




