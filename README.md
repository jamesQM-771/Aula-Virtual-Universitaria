# Sistema de Gestión Universitaria

Este proyecto es un sistema de gestión universitaria desarrollado con PHP y Bootstrap, conectado a una base de datos MySQL y ejecutado en un entorno Apache bajo XAMPP. Permite administrar información de alumnos, cursos, materias, docentes y notas, facilitando la gestión académica de manera sencilla y organizada.

---

## Tecnologías Utilizadas

- **PHP**: Lógica del servidor y manejo de datos.
- **Bootstrap 4 & 5**: Diseño responsive y componentes visuales modernos.
- **MySQL**: Base de datos para almacenar información académica.
- **Apache (XAMPP)**: Servidor local para ejecutar el proyecto.
- **JavaScript/jQuery**: Funciones básicas para interactividad.
- **Font Awesome**: Iconos para mejorar la interfaz.

---

## Estructura del Proyecto y Descripción de Archivos

### Archivos Principales de Lógica y Clases

- `conexion.php`: Establece la conexión con la base de datos MySQL utilizando `mysqli`.
- `alumnos.php`: Clase para manejar operaciones sobre la entidad "alumnos" (crear, leer, actualizar, eliminar).
- `cursos.php`: Clase para la gestión de cursos.
- `Materia.php`: Clase para gestionar materias, incluyendo la asignación de docentes y cursos.
- `Notas.php`: Clase para manejo de notas por alumno, materia y periodo.
- `Index.php`: Muestra el apartado principal

### Archivos para Registro, Edición y Visualización

- `formulario_alumnos.php`: Formulario para el registro de nuevos alumnos.
- `editar_alumnos.php`: Interfaz para editar datos existentes de un alumno.
- `mostrar_alumnos.php`: Muestra una lista con todos los alumnos agrupados por curso.
- `nueva_materia.php`: Formulario para agregar o editar una materia.
- `gestion_de_materias.php`: Listado y gestión de materias agrupadas por curso.
- `mostrar_cursos.php`, `nuevo_cursos.php`, `editar_cursos.php`: Para gestión de cursos (listado, creación, edición).
- `notas_alumnos.php`, `obtener_notas.php`, `modificar_notas.php`, `eliminar_nota.php`: Para ver, modificar y eliminar notas de alumnos.

### Archivos de Procesamiento (Back-end)

- `actualizar_alumnos.php`: Actualiza datos de alumnos en la base de datos.
- `eliminar_alumnos.php`, `eliminar_cursos.php`, `eliminar_materias.php`: Scripts para eliminar registros según entidad.
- `guardar_materia.php`: Guarda una nueva materia en la base de datos.
  
### Archivos de Plantilla y Presentación

- `header.php` y `footer.php`: Contienen la estructura y elementos comunes de la interfaz, como la barra de navegación y pie de página.
- Uso de Bootstrap para el diseño responsive, acordeones para listar agrupaciones y formularios con validación básica.

---

## Funcionalidades Principales

- **Gestión de Alumnos**: Registrar, editar, eliminar, y listar alumnos.
- **Gestión de Cursos**: Crear, editar, eliminar y listar cursos disponibles.
- **Gestión de Materias**: Administración de materias asociadas a cursos y docentes.
- **Registro y Gestión de Notas**: Visualizar, modificar, guardar y eliminar notas por alumno y materia.
- **Interfaz amigable y responsiva** para facilitar la navegación y uso desde distintos dispositivos.
- **Validaciones básicas** tanto en la parte cliente (HTML5) como servidor (PHP).

---

## Base de Datos

- **Nombre de la base de datos**: `sistema_colegio`
- Utiliza MySQL para almacenar datos de alumnos, cursos, materias, docentes y notas.
- Incluye tablas interrelacionadas para mantener integridad y relación entre datos académicos.
- Se conecta usando `mysqli` con soporte para prepared statements para seguridad y eficiencia.

---

## Cómo Ejecutar el Proyecto

1. Instalar XAMPP o un entorno similar con Apache y MySQL.
2. Colocar los archivos del proyecto en la carpeta `htdocs` de XAMPP.
3. Crear la base de datos `sistema_colegio` y las tablas necesarias (según la estructura utilizada en las clases).
4. Configurar `conexion.php` con los datos correctos de conexión (usuario, contraseña, base de datos).
5. Ejecutar Apache y MySQL desde el panel de XAMPP.
6. Acceder a `http://localhost/index.php` desde un navegador web.
7. Utilizar las interfaces para administrar los datos universitarios.

---

## Consideraciones y Recomendaciones

- El sistema está orientado a entornos locales, ideal para pruebas y desarrollo inicial.
- Para producción, se recomienda mejorar seguridad, manejo de sesiones y permisos.
- Evite mezclar versiones diferentes de Bootstrap (el proyecto usa Bootstrap 4 y 5, lo que puede causar conflictos).
- Validar y sanitizar entradas de usuario para evitar vulnerabilidades.
- La estructura del código facilita ampliaciones y mantenimientos futuros.

---

## Autor

Sistema creado por James Quintero Mosquera y Juan Miguel Lopez Alarcon (GitHub: [jamesQM-771](https://github.com/jamesQM-771?tab=repositories))  
Proyecto simple de sistema escolar desarrollado con PHP, Bootstrap y MySQL.

---
