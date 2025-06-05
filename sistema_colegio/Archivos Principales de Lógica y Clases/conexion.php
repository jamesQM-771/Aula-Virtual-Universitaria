<?php 
// Habilita el reporte de errores y excepciones de MySQLi para detectar problemas en la conexión y consultas
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// conexion.php
// Datos para la conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasenia = "";
$base_de_datos = "sistema_colegio";

// Creación del objeto mysqli para establecer la conexión con la base de datos
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);

// Verifica si ocurrió un error en la conexión
if ($mysqli->connect_errno) {
    // Muestra un mensaje de error con el código y descripción del fallo de conexión
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// Establece el conjunto de caracteres a UTF-8 para evitar problemas con caracteres especiales
$mysqli->set_charset("utf8");
