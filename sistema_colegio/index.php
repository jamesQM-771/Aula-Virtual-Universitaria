<?php 
// Incluir el archivo header.php que contiene la cabecera común y las importaciones de estilos/scripts
include 'header.php'; 
?>

<div class="container mt-4">
    <!-- Título principal de la página -->
    <h1 class="mb-4">Bienvenido al Sistema de Gestión Universitaria</h1>

    <!-- Lista de enlaces para la navegación dentro del sistema -->
    <div class="list-group">
        <!-- Enlace para registrar un nuevo alumno -->
        <a href="formulario_alumnos.php" class="list-group-item list-group-item-action">
            ➕ Registrar nuevo alumno
        </a>

        <!-- Enlace para ver la lista completa de alumnos -->
        <a href="mostrar_alumnos.php" class="list-group-item list-group-item-action">
            📋 Ver lista de alumnos
        </a>

        <!-- Enlace para gestionar materias: crear, editar o eliminar -->
        <a href="gestion_de_materias.php" class="list-group-item list-group-item-action">
            📚 Gestionar materias (crear/editar/eliminar)
        </a>

        <!-- Enlace para registrar o consultar las notas de los alumnos -->
        <a href="notas_alumnos.php" class="list-group-item list-group-item-action">
            📝 Registrar o ver notas de los alumnos
        </a>
    </div>
</div>

<?php 
// Incluir el archivo footer.php que contiene el pie de página común
include 'footer.php'; 
?>

