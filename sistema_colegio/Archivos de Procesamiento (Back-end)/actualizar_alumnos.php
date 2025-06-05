<?php
require_once "conexion.php";   // Incluye la conexión a la base de datos
require_once "Alumnos.php";    // Incluye la clase alumnos para manipular datos

// Verifica que todos los datos necesarios hayan sido enviados vía POST
if (isset($_POST["identidad"], $_POST["nombre"], $_POST["apellido"], $_POST["nacimiento"], $_POST["sexo"],
          $_POST["curso"], $_POST["direccion"], $_POST["telefono"], $_POST["id"])) {

    // Crea un nuevo objeto alumnos con los datos recibidos del formulario
    $alumno = new alumnos(
        $_POST["identidad"],
        $_POST["nombre"],
        $_POST["apellido"],
        $_POST["nacimiento"],
        $_POST["sexo"],
        $_POST["curso"],
        $_POST["direccion"],
        $_POST["telefono"]
    );

    // Llama al método actualizar para modificar el registro del alumno en la base de datos
    $alumno->actualizar($_POST["id"]);

    // Redirige al usuario a la página que muestra la lista de alumnos después de actualizar
    header("Location: mostrar_alumnos.php");
    exit;  // Termina la ejecución del script para evitar más código
} else {
    // Muestra un mensaje de error si faltan datos necesarios para actualizar
    echo "Datos incompletos para actualizar el alumno.";
}


