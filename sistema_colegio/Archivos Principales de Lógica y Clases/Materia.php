<?php
class Materia
{
    // Propiedades privadas para los atributos de la materia
    private $nombre, $id_docente, $id_curso, $id;

    // Constructor para inicializar la materia, el id es opcional para nuevos registros
    public function __construct($nombre, $id_docente, $id_curso, $id = null)
    {
        $this->nombre = $nombre;
        $this->id_docente = $id_docente;
        $this->id_curso = $id_curso;
        if ($id) {
            $this->id = $id;
        }
    }

    // Método para guardar una nueva materia en la base de datos
    public function guardar()
    {
        global $mysqli; // Usamos la conexión global a la base de datos
        $stmt = $mysqli->prepare("INSERT INTO materias (nombre, id_docente, id_curso) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Error en prepare: " . $mysqli->error);
        }
        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("sii", $this->nombre, $this->id_docente, $this->id_curso);
        $stmt->execute();
        $stmt->close();
    }

    // Método estático para obtener todas las materias con datos de docente y curso
    public static function obtener()
    {
        global $mysqli;
        $sql = "SELECT m.id_materia, m.nombre, d.nombre AS docente, c.nombre_curso 
                FROM materias m
                INNER JOIN docentes d ON m.id_docente = d.id_docente
                INNER JOIN cursos c ON m.id_curso = c.id_curso";
        $resultado = $mysqli->query($sql);
        if (!$resultado) {
            die("Error en query: " . $mysqli->error);
        }
        // Retorna un arreglo asociativo con todos los registros
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Método estático para obtener una materia específica por su id
    public static function obtenerUna($id)
    {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT * FROM materias WHERE id_materia = ?");
        if (!$stmt) {
            die("Error en prepare: " . $mysqli->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $materia = $resultado->fetch_object(); // Retorna un objeto con los datos de la materia
        $stmt->close();
        return $materia;
    }

    // Método estático para obtener materias filtradas por curso
    public static function obtenerPorCurso($id_curso) {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT * FROM materias WHERE id_curso = ?");
        $stmt->bind_param("i", $id_curso);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Método para actualizar los datos de una materia existente
    public function actualizar()
    {
        global $mysqli;
        $stmt = $mysqli->prepare("UPDATE materias SET nombre = ?, id_docente = ?, id_curso = ? WHERE id_materia = ?");
        if (!$stmt) {
            die("Error en prepare: " . $mysqli->error);
        }
        $stmt->bind_param("siii", $this->nombre, $this->id_docente, $this->id_curso, $this->id);
        $stmt->execute();
        $stmt->close();
    }

    // Método estático para eliminar una materia por su id
    public static function eliminar($id)
    {
        global $mysqli;
        $stmt = $mysqli->prepare("DELETE FROM materias WHERE id_materia = ?");
        if (!$stmt) {
            die("Error en prepare: " . $mysqli->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
// Fin de la clase Materia
?>

