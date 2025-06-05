<?php
include_once "conexion.php";

// Verificamos que la petición sea POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtenemos y validamos los datos del formulario, convirtiendo a entero
    $id_alumno = intval($_POST["id_alumno"] ?? 0);
    $id_materia = intval($_POST["id_materia"] ?? 0);
    $puntaje = intval($_POST["puntaje"] ?? 0);

    // Validamos que los datos sean válidos: id_alumno y id_materia deben ser > 0,
    // y puntaje debe estar entre 0 y 100
    if ($id_alumno && $id_materia && ($puntaje >= 0 && $puntaje <= 100)) {

        // Obtenemos el id_curso asociado a la materia para almacenar correctamente la nota
        $stmtCurso = $mysqli->prepare("SELECT id_curso FROM materias WHERE id_materia = ?");
        $stmtCurso->bind_param("i", $id_materia);
        $stmtCurso->execute();
        $resultadoCurso = $stmtCurso->get_result();

        // Si se encontró la materia, extraemos el id_curso
        if ($filaCurso = $resultadoCurso->fetch_assoc()) {
            $id_curso = intval($filaCurso["id_curso"]);
        } else {
            // Si no se encuentra la materia, mostramos un error y detenemos la ejecución
            die("Materia no encontrada o sin curso asignado.");
        }
        $stmtCurso->close();

        // Insertamos o actualizamos la nota para el alumno y materia dada
        // ON DUPLICATE KEY UPDATE actualiza si ya existe registro para esa combinación
        $sql = "INSERT INTO notas (id_alumno, id_materia, total, id_curso) VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE total = VALUES(total), id_curso = VALUES(id_curso)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iiii", $id_alumno, $id_materia, $puntaje, $id_curso);
        $stmt->execute();
        $stmt->close();
    }

    // Redirigimos para mostrar las notas del alumno actualizado
    header("Location: obtener_notas.php?id=" . $id_alumno);
    exit;
}
?>
