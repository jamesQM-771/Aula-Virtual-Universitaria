<?php
// Clase para manejar operaciones relacionadas con la entidad Curso
class Curso {
    // Propiedades privadas para almacenar el id y nombre del curso
    private $id, $nombre;

    // Constructor que recibe el nombre del curso y opcionalmente el id
    public function __construct($nombre, $id = null) {
        $this->nombre = $nombre;
        $this->id = $id;
    }

    // Método para guardar un nuevo curso en la base de datos
    public function guardar() {
        global $mysqli;
        // Preparar la consulta para insertar un nuevo registro en la tabla cursos
        $stmt = $mysqli->prepare("INSERT INTO cursos (nombre_curso) VALUES (?)");
        // Vincular el parámetro nombre al statement
        $stmt->bind_param("s", $this->nombre);
        // Ejecutar la consulta
        $stmt->execute();
    }

    // Método estático para obtener todos los cursos registrados en la base de datos
    public static function obtenerTodos() {
        global $mysqli;
        // Ejecutar la consulta que selecciona id y nombre de todos los cursos
        $resultado = $mysqli->query("SELECT id_Curso, nombre_curso FROM cursos");
        // Retornar todos los resultados como un arreglo asociativo
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}

