<?php
class Nota
{
    // Propiedades privadas para almacenar los datos de la nota
    private $alumno, $materia, $periodo, $acumulativo, $examen;

    // Constructor para inicializar las propiedades al crear un objeto Nota
    public function __construct($alumno, $materia, $periodo, $acumulativo, $examen)
    {
        $this->alumno = $alumno;
        $this->materia = $materia;
        $this->periodo = $periodo;
        $this->acumulativo = $acumulativo;
        $this->examen = $examen;
    }

    // Método para guardar la nota en la base de datos
    public function guardar()
    {
        global $mysqli;
        $this->eliminar(); // Primero elimina cualquier registro previo para evitar duplicados
        // Preparar la consulta para insertar una nueva nota
        $stmt = $mysqli->prepare("INSERT INTO notas (id_alumno, id_materia, periodo, acumulativo, examen) VALUES (?, ?, ?, ?, ?)");
        // Vincular parámetros: alumno, materia, periodo (string), acumulativo, examen (enteros)
        $stmt->bind_param("iisii", $this->alumno, $this->materia, $this->periodo, $this->acumulativo, $this->examen);
        $stmt->execute(); // Ejecutar la consulta
    }

    // Método para eliminar la nota existente del alumno, materia y periodo indicados
    public function eliminar()
    {
        global $mysqli;
        // Preparar consulta para eliminar la nota correspondiente
        $stmt = $mysqli->prepare("DELETE FROM notas WHERE id_alumno = ? AND id_materia = ? AND periodo = ?");
        // Vincular parámetros
        $stmt->bind_param("iis", $this->alumno, $this->materia, $this->periodo);
        $stmt->execute(); // Ejecutar eliminación
    }

    // Método estático para obtener todas las notas de un alumno específico
    public static function obtenerPorAlumno($alumno)
    {
        global $mysqli;
        // Preparar consulta para seleccionar todas las notas del alumno
        $stmt = $mysqli->prepare("SELECT * FROM notas WHERE id_alumno = ?");
        $stmt->bind_param("i", $alumno);
        $stmt->execute(); // Ejecutar consulta
        // Devolver todas las filas como arreglo asociativo
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

