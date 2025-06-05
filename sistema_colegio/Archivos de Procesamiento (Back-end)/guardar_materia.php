<?php
// Incluye la conexión a la base de datos
include_once "conexion.php";

// Incluye la clase Materia para manipular objetos de tipo Materia
include_once "Materia.php";

// Verifica si el método de la solicitud es POST (formulario enviado)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtiene los valores enviados por el formulario, o cadena vacía si no existen
    $nombre = $_POST['nombre'] ?? '';
    $id_docente = $_POST['id_docente'] ?? '';
    $id_curso = $_POST['id_curso'] ?? '';

    // Verifica que los tres campos tengan valores
    if ($nombre && $id_docente && $id_curso) {
        // Crea un objeto Materia con los valores recibidos (convierte IDs a enteros)
        $materia = new Materia($nombre, (int)$id_docente, (int)$id_curso);

        // Llama al método para guardar la materia en la base de datos
        $materia->guardar();

        // Redirige a la página de gestión de materias para ver el listado actualizado
        header("Location: gestion_de_materias.php");
        exit;
    } else {
        // Muestra mensaje de error si faltan campos
        echo "<div class='alert alert-danger'>Todos los campos son obligatorios.</div>";
    }
} else {
    // Muestra mensaje de acceso inválido si se accede por otro método que no sea POST
    echo "<div class='alert alert-danger'>Acceso inválido.</div>";
}
// Finaliza el script para evitar ejecución adicional
exit;
