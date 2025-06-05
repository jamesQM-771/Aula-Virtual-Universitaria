<?php
// Incluir el archivo de conexión a la base de datos
include_once "conexion.php";

// Incluir el archivo que contiene la clase alumnos y sus métodos
include_once "alumnos.php";

// Verificar si se ha pasado un ID por la URL (por método GET)
if (isset($_GET["id"])) {
    // Llamar al método estático 'eliminar' de la clase alumnos, pasando el ID recibido
    alumnos::eliminar($_GET["id"]);
}

// Redirigir al usuario a la página donde se muestran todos los alumnos después de eliminar
header("Location: mostrar_alumnos.php");

// Finalizar el script para evitar ejecución adicional
exit;

