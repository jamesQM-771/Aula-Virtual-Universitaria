<?php
// Incluir archivo de conexión a la base de datos
include_once "conexion.php";
// Incluir la clase alumnos para usar sus métodos
include_once "alumnos.php";

// Verificar que se haya enviado el parámetro 'id' por GET
if (!isset($_GET["id"])) {
    echo "ID de alumno no especificado.";
    exit;
}

// Obtener la información del alumno correspondiente al ID recibido
$alumno = alumnos::obtenerUno($_GET["id"]);

// Obtener la lista de cursos disponibles para llenar el select
$resultado = $mysqli->query("SELECT id_curso, nombre_curso FROM cursos");
$cursos = $resultado->fetch_all(MYSQLI_ASSOC);

// Incluir la cabecera HTML
include_once "header.php";
?>

<!-- Contenedor principal del formulario de edición -->
<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Editar Alumno</h3>
                </div>
                <div class="card-body">
                    <!-- Formulario para actualizar datos del alumno -->
                    <form method="POST" action="actualizar_alumnos.php">
                        <!-- Campo oculto para enviar el ID del alumno -->
                        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

                        <div class="row">
                            <!-- Sección de datos personales -->
                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">Datos Personales</h5>

                                <div class="form-group mb-3">
                                    <label for="identidad" class="form-label">Número de Identidad</label>
                                    <input type="text" class="form-control" name="identidad" id="identidad"
                                        value="<?= $alumno->n_identidad ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nombre" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        value="<?= $alumno->nombre ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="apellido" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" name="apellido" id="apellido"
                                        value="<?= $alumno->apellido ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nacimiento" class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" name="nacimiento" id="nacimiento"
                                        value="<?= $alumno->f_nacimiento ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select class="form-control" name="sexo" id="sexo" required>
                                        <option value="Masculino" <?= $alumno->sexo === "Masculino" ? "selected" : "" ?>>Masculino</option>
                                        <option value="Femenino" <?= $alumno->sexo === "Femenino" ? "selected" : "" ?>>Femenino</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Sección de datos académicos y contacto -->
                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">Datos Académicos</h5>

                                <div class="form-group mb-3">
                                    <label for="curso" class="form-label">Curso</label>
                                    <select class="form-control" name="curso" id="curso" required>
                                        <!-- Mostrar opciones de cursos disponibles y seleccionar el actual -->
                                        <?php foreach ($cursos as $curso): ?>
                                            <option value="<?= $curso["id_curso"] ?>" <?= $alumno->id_curso == $curso["id_curso"] ? "selected" : "" ?>>
                                                <?= $curso["nombre_curso"] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <h5 class="text-primary mb-3 mt-4">Información de Contacto</h5>

                                <div class="form-group mb-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <textarea class="form-control" name="direccion" id="direccion" rows="3"
                                        required><?= $alumno->direccion ?></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono"
                                        value="<?= $alumno->telefono ?>" required>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <!-- Botón para enviar el formulario y actualizar los datos -->
                            <button type="submit" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-save"></i> Actualizar
                            </button>
                            <!-- Botón para cancelar y regresar a la lista de alumnos -->
                            <a href="mostrar_alumnos.php" class="btn btn-secondary btn-lg">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir el pie de página -->
<?php include_once "footer.php"; ?>
