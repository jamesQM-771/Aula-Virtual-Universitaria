<?php
include_once "conexion.php"; // Incluye el archivo de conexión a la base de datos
include_once "header.php";   // Incluye la cabecera común del sitio

$resultado = $mysqli->query("SELECT * FROM cursos"); // Consulta para obtener todos los cursos de la base de datos
?>

<div class="container mt-4">
    <h2>Listado de Cursos</h2>
    <a href="nuevo_cursos.php" class="btn btn-primary mb-3">➕ Nuevo Curso</a> <!-- Botón para agregar un nuevo curso -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th> <!-- Columna para mostrar el ID del curso -->
                <th>Nombre del Curso</th> <!-- Columna para mostrar el nombre del curso -->
                <th>Acciones</th> <!-- Columna para las acciones disponibles (editar, eliminar) -->
            </tr>
        </thead>
        <tbody>
            <?php while ($curso = $resultado->fetch_assoc()): ?> <!-- Recorre cada curso obtenido de la consulta -->
            <tr>
                <td><?= $curso['id_curso'] ?></td> <!-- Muestra el ID del curso -->
                <td><?= htmlspecialchars($curso['nombre_curso']) ?></td> <!-- Muestra el nombre del curso con protección contra HTML -->
                <td>
                    <a href="editar_cursos.php?id=<?= $curso['id_curso'] ?>" class="btn btn-warning btn-sm">Editar</a> <!-- Botón para editar el curso -->
                    <a href="eliminar_cursos.php?id=<?= $curso['id_curso'] ?>" 
                       class="btn btn-danger btn-sm" 
                       onclick="return confirm('¿Seguro que deseas eliminar este curso?')">Eliminar</a> <!-- Botón para eliminar el curso con confirmación -->
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include_once "footer.php"; ?> <!-- Incluye el pie de página común -->
