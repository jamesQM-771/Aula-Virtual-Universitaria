<?php
class alumnos {
    // Propiedades privadas para almacenar los datos del alumno
    private $identidad;
    private $nombre;
    private $apellido;
    private $nacimiento;
    private $sexo;
    private $curso;
    private $direccion;
    private $telefono;

    // Constructor que recibe todos los datos para inicializar el objeto alumno
    public function __construct($identidad, $nombre, $apellido, $nacimiento, $sexo, $curso, $direccion, $telefono) {
        $this->identidad = $identidad;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nacimiento = $nacimiento;
        $this->sexo = $sexo;
        $this->curso = $curso;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }

    // Método para guardar un nuevo alumno en la base de datos
    public function guardar() {
        global $mysqli;
        $stmt = $mysqli->prepare("INSERT INTO alumnos (N_identidad, Nombre, Apellido, F_Nacimiento, Sexo, id_Curso, Direccion, Telefono) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", 
            $this->identidad, 
            $this->nombre, 
            $this->apellido, 
            $this->nacimiento, 
            $this->sexo, 
            $this->curso, 
            $this->direccion, 
            $this->telefono
        );
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;  // Devuelve true si se guardó correctamente
    }

    // Método para actualizar los datos de un alumno existente identificado por $id
    public function actualizar($id)
    {
        global $mysqli;
        $stmt = $mysqli->prepare("UPDATE alumnos SET Nombre = ?, Apellido = ?, F_Nacimiento = ?, Sexo = ?, id_Curso = ?, Direccion = ?, Telefono = ? WHERE id_Alumno = ?");
        $stmt->bind_param("sssssssi",
            $this->nombre,
            $this->apellido,
            $this->nacimiento,
            $this->sexo,
            $this->curso,
            $this->direccion,
            $this->telefono,
            $id
        );
        $stmt->execute();
        $stmt->close();
    }

    // Método estático para eliminar un alumno de la base de datos por su $id
    public static function eliminar($id) {
        global $mysqli;
        $stmt = $mysqli->prepare("DELETE FROM alumnos WHERE id_Alumno = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    // Método estático para obtener todos los alumnos con su información y el nombre del curso
    public static function obtener() {
        global $mysqli;
        $resultado = $mysqli->query("SELECT a.id_Alumno, a.N_identidad, a.Nombre, a.Apellido, a.F_Nacimiento, a.Sexo, c.Nombre AS Curso, a.Direccion, a.Telefono
                                      FROM alumnos a
                                      INNER JOIN cursos c ON a.id_Curso = c.id_Curso");
        return $resultado->fetch_all(MYSQLI_ASSOC);  // Devuelve un arreglo asociativo con todos los alumnos
    }

    // Método estático para obtener un solo alumno por su $id (usado, por ejemplo, en obtener_notas.php)
    public static function obtenerUno($id) {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT * FROM alumnos WHERE id_Alumno = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_object();  // Devuelve un objeto con los datos del alumno
    }
}
// Fin de la clase alumnos
