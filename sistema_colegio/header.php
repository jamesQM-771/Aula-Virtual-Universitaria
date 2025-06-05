<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metadatos importantes para el correcto funcionamiento y visualización -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Aula Virtual Universitaria</title>

    <!-- Importación de estilos CSS de Bootstrap versión 4.6.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <!-- Iconos de Font Awesome para usar en el menú y otros elementos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        /* Padding superior para que el contenido no quede oculto debajo de la navbar fija */
        body { padding-top: 70px; }
    </style>
    <!-- Otra versión de Bootstrap (5.3.3) incluida pero no recomendable mezclar versiones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Barra de navegación fija en la parte superior -->
<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
    <!-- Marca del sitio, con un margen a la izquierda para separarla del borde -->
    <a class="navbar-brand ml-4" href="#">Aula Virtual Universitaria</a>

    <!-- Botón para colapsar el menú en dispositivos móviles -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu"
        aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menú colapsable que muestra opciones según el rol del usuario -->
    <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav mr-auto">
            <!-- Opción de inicio visible para todos -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="fa fa-hands-helping"></i> inicio</a>
            </li>

            <!-- Verificar si hay una sesión iniciada y mostrar menús según rol -->
            <?php if (isset($_SESSION['rol'])): ?>

                <!-- Menú para administradores y profesores -->
                <?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'profesor'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="mostrar_alumnos.php"><i class="fa fa-user-graduate"></i> Alumnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gestion_de_materias.php"><i class="fa fa-book"></i> Materias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mostrar_cursos.php"><i class="fa fa-book"></i> Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notas_alumnos.php"><i class="fa fa-pen"></i> Notas</a>
                    </li>
                <!-- Menú para estudiantes -->
                <?php elseif ($_SESSION['rol'] === 'estudiante'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="mis_notas.php"><i class="fa fa-pen"></i> Mis Notas</a>
                    </li>
                <?php endif; ?>

            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- Cuerpo de la página con diseño flexible para que el footer se quede abajo -->
<body class="d-flex flex-column min-vh-100">
<!-- Contenedor principal para el contenido -->
<main class="flex-fill container mt-4">

 



        
