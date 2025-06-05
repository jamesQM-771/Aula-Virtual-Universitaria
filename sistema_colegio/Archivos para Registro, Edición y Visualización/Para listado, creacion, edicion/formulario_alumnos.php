<?php
// ------------------------------------------------------------
// Inclusión de archivos necesarios (conexión, encabezado y clase)
// ------------------------------------------------------------
require_once "conexion.php";
require_once "header.php";
require_once "alumnos.php";

// ------------------------------------------------------------
// 1. Obtener lista de cursos para el <select>
// ------------------------------------------------------------
// Consulta los cursos desde la base de datos para llenar el select del formulario
$cursos_query = $mysqli->query("SELECT id_curso, nombre_curso FROM cursos");
$cursos       = $cursos_query ? $cursos_query->fetch_all(MYSQLI_ASSOC) : [];

// ------------------------------------------------------------
// 2. Procesar el formulario cuando se envía (POST)
// ------------------------------------------------------------
$mensaje      = '';       // Almacena el mensaje de resultado del registro
$tipo_alerta  = '';       // Tipo de alerta (Bootstrap): success, danger, warning

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --------------------------------------------------------
    // Limpieza y obtención de los datos enviados por el formulario
    // --------------------------------------------------------
    $identidad  = trim($_POST['identidad']  ?? '');
    $nombre     = trim($_POST['nombre']     ?? '');
    $apellido   = trim($_POST['apellido']   ?? '');
    $nacimiento =        $_POST['nacimiento'] ?? null; // Puede ser nulo
    $sexo       =        $_POST['sexo']       ?? '';
    $curso      =        $_POST['curso']      ?? '';
    $direccion  = trim($_POST['direccion']  ?? '');
    $telefono   = trim($_POST['telefono']   ?? '');

    // --------------------------------------------------------
    // Validación mínima de campos obligatorios
    // --------------------------------------------------------
    if ($identidad && $nombre && $apellido && $curso) {
        // ----------------------------------------------------
        // Crear objeto alumno y guardar los datos
        // ----------------------------------------------------
        $alumno = new alumnos(
            $identidad,
            $nombre,
            $apellido,
            $nacimiento,
            $sexo,
            $curso,
            $direccion,
            $telefono
        );

        // ----------------------------------------------------
        // Intentar guardar el alumno y manejar el resultado
        // ----------------------------------------------------
        if ($alumno->guardar()) {
            $mensaje     = 'Alumno registrado exitosamente.';
            $tipo_alerta = 'success';
            // Redireccionar después de 2 segundos para evitar reenviar el formulario
            echo "<script>setTimeout(()=>location.href='mostrar_alumnos.php',2000);</script>";
        } else {
            $mensaje     = 'Error al registrar el alumno.';
            $tipo_alerta = 'danger';
        }
    } else {
        $mensaje     = 'Faltan datos obligatorios para registrar al alumno.';
        $tipo_alerta = 'warning';
    }
}
?>

<!-- =========================================================
     Sección del contenedor principal con formulario de registro
     ========================================================= -->
<div class="container mb-4">
    <!-- Mostrar mensaje si existe -->
    <?php if ($mensaje): ?>
        <div class="alert alert-<?= $tipo_alerta ?> text-center">
            <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Registrar Nuevo Alumno</h3>
                </div>
                <div class="card-body">
                    <!-- Formulario para registrar nuevo alumno -->
                    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                        <div class="row">
                            <!-- ================= DATOS PERSONALES ================= -->
                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">Datos Personales</h5>

                                <div class="mb-3">
                                    <label for="identidad" class="form-label">Número de Identidad *</label>
                                    <input type="text" id="identidad" name="identidad" class="form-control" placeholder="C.C: 1.099.999.999" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombres *</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre del alumno" required>
                                </div>

                                <div class="mb-3">
                                    <label for="apellido" class="form-label">Apellidos *</label>
                                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido del alumno" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nacimiento" class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" id="nacimiento" name="nacimiento" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select id="sexo" name="sexo" class="form-control">
                                        <option value="">Seleccionar...</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                </div>
                            </div>

                            <!-- ============ DATOS ACADÉMICOS & CONTACTO ============ -->
                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">Datos Académicos</h5>

                                <div class="mb-3">
                                    <label for="curso" class="form-label">Curso *</label>
                                    <select id="curso" name="curso" class="form-control" required>
                                        <option value="">Seleccione un curso</option>
                                        <!-- Carga dinámica de cursos desde la base de datos -->
                                        <?php foreach ($cursos as $c): ?>
                                            <option value="<?= $c['id_curso'] ?>"><?= htmlspecialchars($c['nombre_curso']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <h5 class="text-primary mb-3 mt-4">Información de Contacto</h5>

                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Dirección *</label>
                                    <textarea id="direccion" name="direccion" rows="3" class="form-control" placeholder="Dirección completa del alumno" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono *</label>
                                    <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Ej: +57 310 999-9999" required>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Botones de acción -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-save"></i> Registrar Alumno
                            </button>
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

<!-- Inclusión del pie de página -->
<?php include_once "footer.php"; ?>

