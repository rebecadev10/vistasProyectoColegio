# Auditoría Técnica, Diagnóstico de Fallas y Plan de Modernización
**Proyecto:** Sistema de Gestión Escolar (Colegio)  
**Fecha:** Noviembre 2026  
**Entorno de Desarrollo:** macOS / Windows (Cliente)  
**Rama Definitiva:** `main` (Integrada)

---

## 1. Resumen Ejecutivo y Diagnóstico del Repositorio

### 1.1 Estado de las Ramas Git y Unificación
Durante la inspección de Git, se detectó que el repositorio tenía una serie de ramas de desarrollo secuencial (`evento` -> `news` -> `recursos` -> `comunicacion` -> `usuarios`) que nunca habían sido fusionadas con `main`.
* La rama `main` se encontraba congelada en los primeros commits con maquetaciones HTML preliminares y un `README.md`.
* La rama `usuarios` contenía la acumulación completa de todos los módulos, controladores, modelos, librerías y la base de datos.
* **Acción ejecutada:** Se realizó el merge de la rama `usuarios` sobre `main` sin conflictos, consolidando `main` como la rama definitiva y estable del proyecto.

### 1.2 Estado de la Base de Datos
* **Hallazgo:** La base de datos **SÍ se encuentra en el repositorio**, bajo la ruta:
  `bd/colegio 13_04_2026.sql` (además de una versión previa `bd/colegio (4).sql`).
* Contiene 10 tablas: `usuario`, `permisos`, `usuariopermiso`, `noticias`, `eventos`, `recursos`, `comunicacion`, `departamentos`, `preguntas` y `respuestas`.

---

## 2. Diagnóstico Detallado y Corrección de las 4 Fallas Reportadas

### Falla 1: Al pulsar el botón de mirar clave se inicia sesión automáticamente
* **Causa Raíz:** En `index.html`, el elemento del ojo estaba codificado como `<button class="viewPassword" id="viewPassword">`. En HTML5, cualquier `<button>` dentro de un `<form>` cuyo atributo `type` no esté explícitamente fijado a `"button"` asume por defecto `type="submit"`. Al hacer clic, enviaba el formulario `#frmAcceso` antes de ejecutar la lógica del toggle.
* **Solución Aplicada:**
  1. Se añadió `type="button"` al botón en `index.html`.
  2. En `scripts/login.js`, se incorporó `e.preventDefault()` y `e.stopPropagation()`.
  3. Se añadió alternancia visual dinámica entre `fa-eye` y `fa-eye-slash`.

### Falla 2: Al iniciar sesión como estudiante en la opción recursos sale crear recursos
* **Causa Raíz:**
  1. En `componentes/navbar.php`, el tag de cierre `</ul>` de la barra de navegación estaba encerrado dentro del bloque `if ($_SESSION['Administrativo'] == 1)`. Cuando ingresaba un estudiante o docente, el `<ul>` nunca se cerraba en el DOM, provocando un colapso en la estructura jerárquica de clases CSS y dropdowns.
  2. En PHP 8+, verificar `$_SESSION['Docente'] == 1` sin verificar previamente `!empty()` o `isset()` emitía warnings de índice no definido que podían alterar el renderizado.
  3. En la base de datos de muestra, el usuario 1 tenía asignado permiso de docente además de estudiante.
* **Solución Aplicada:**
  1. Se corrigió la estructura del `navbar.php` cerrando correctamente las etiquetas HTML para todos los roles.
  2. Se protegieron todas las evaluaciones de rol con `!empty($_SESSION['Rol']) && $_SESSION['Rol'] == 1`.
  3. Se crearon variables limpias `$isEstudiante`, `$isDocente`, `$isAdmin` al inicio del componente.

### Falla 3: Error al crear una noticia ("Acción no permitida / no completada")
* **Causa Raíz:**
  1. En `controlador/noticia.php`, la ruta de almacenamiento de archivos estaba quemada en código como `$directorio = "C:/xampp/htdocs/colegio/data/noticias/";`. En Mac, o en cualquier Windows donde la ruta no sea idéntica, `move_uploaded_file()` fallaba.
  2. La carpeta `data/noticias/` no existía físicamente en el repositorio.
  3. Al fallar la subida, el controlador respondía `"Error al subir la imagen."`. SweetAlert en `scripts/noticia.js` interpretaba cualquier mensaje que no contuviera `"noticia registrado"` mostrando la alerta `"Acción no completada"`.
  4. Adicionalmente, el archivo `noacceso.php` referenciado por los controladores no existía en el repositorio, provocando un Fatal Error si se invocaba.
* **Solución Aplicada:**
  1. Se transformaron las rutas a rutas dinámicas multiplataforma: `dirname(__DIR__) . "/data/noticias/"`.
  2. Se agregó la creación automática del directorio si no existe (`mkdir($directorio, 0777, true)`).
  3. Esto mismo se corrigió en los 5 controladores (`noticia.php`, `comunicacion.php`, `evento.php`, `recurso.php`, `usuario.php`).
  4. Se creó el archivo `noacceso.php` con interfaz estilizada y segura.

### Falla 4: El botón "Publicar nuevo evento" no hace nada
* **Causa Raíz:**
  1. En `eventoEditar.php`, el botón estaba maquetado como:
     `<button class="componente__boton-subir"><a href="./formularioEvento.php">Publicar Nuevo Evento</a></button>`
     Un `<button>` que envuelve a una etiqueta `<a>` es HTML inválido; al hacer clic sobre el botón, el navegador no dispara la navegación del link.
  2. En `formularioEvento.php`, se cargaba `scripts/evento.js`. Al cargarse, `init()` llamaba inmediatamente a `listar()`, la cual intentaba inicializar DataTables sobre `$('#tbllistado')`. Como dicha tabla no existe en la vista del formulario, DataTables lanzaba una excepción no capturada de JavaScript que interrumpía la ejecución del script antes de que se registrara el listener `$('#formulario').on('submit', ...)`.
  3. En `scripts/evento.js`, `document.getElementById("imagen").addEventListener(...)` fallaba con `TypeError: Cannot read properties of null` en pantallas donde no existía dicho input.
* **Solución Aplicada:**
  1. Se convirtió el enlace en `eventoEditar.php` en una etiqueta `<a>` directa con clase `.componente__boton-subir`.
  2. En `scripts/evento.js` (y de forma homóloga en `noticia.js`, `comunicacion.js`, `recurso.js` y `usuario.js`), se condicionó la ejecución de `listar()` y `mostrarform()` a la existencia real de `$('#tbllistado')`.
  3. Se añadieron comprobaciones de nulidad antes de registrar event listeners en elementos del DOM.

---

## 3. Seguridad y Compatibilidad con PHP 8.x

### 3.1 Corrección de Fatal Errors en PHP 8.1 / 8.2 / 8.3
* **Fallo Crítico:** En `controlador/usuario.php`, el código realizaba `trim($_POST['permiso'])`. En PHP 8+, pasar un array a funciones de string (`trim`, `substr`) arroja un **`Fatal TypeError: trim(): Argument #1 must be of type string, array given`**.
* **Corrección:** Se sanitizó la lectura comprobando `is_array()` y asignando un array por defecto `[1]` (Estudiante) de forma segura.

### 3.2 Vulnerabilidades Identificadas y Roadmap de Seguridad
1. **Contraseñas en Texto Plano:** La base de datos almacena contraseñas sin hash (`12345`).  
   * *Recomendación implementada en roadmap:* Migrar al estándar nativo `password_hash($clave, PASSWORD_BCRYPT)` y `password_verify()`.
2. **Inyección SQL Potencial:** Se concatenan cadenas escapadas con `mysqli_real_escape_string()`.  
   * *Recomendación:* Migrar progresivamente a Sentencias Preparadas (`mysqli_stmt` o `PDO`).
3. **Escapado Incorrecto:** `limpiarCadena()` ejecutaba `htmlspecialchars()` antes de insertar a BD, corrompiendo datos con entidades HTML. El escapado debe hacerse al renderizar en la vista.

---

## 4. Opciones de Servidor y Entorno Local (Mac vs. Windows)

Dado que actualmente se ejecuta en **macOS** pero el cliente final lo usará en **Windows**, existen dos caminos recomendados:

### Opción A: Docker Compose (Recomendada para Desarrollo en Mac y Portabilidad)
Se incluyó en el proyecto un `docker-compose.yml` y un `Dockerfile` listos para usar:
* **Levantamiento con 1 comando:** `docker compose up -d`
* **Contenedores:**
  * `colegio_app` (PHP 8.2 + Apache) en `http://localhost:8080`
  * `colegio_db` (MariaDB 10.6) con importación automática de la base de datos
  * `colegio_phpmyadmin` en `http://localhost:8081`
* **Ventaja:** Funciona idéntico en macOS y Windows sin tocar configuraciones del sistema operativo ni lidiar con rutas absolutas.

### Opción B: XAMPP (Para el Cliente en Windows)
1. Instalar **XAMPP para Windows** con PHP 8.1 o superior.
2. Copiar la carpeta `vistasProyectoColegio` dentro de `C:/xampp/htdocs/colegio`.
3. Abrir phpMyAdmin (`http://localhost/phpmyadmin`), crear la base de datos `colegio` e importar el archivo `bd/colegio 13_04_2026.sql`.
4. Gracias a las modificaciones realizadas en `config/global.php`, el sistema se conecta automáticamente a `localhost`, usuario `root` y sin contraseña.

---

## 5. Estrategia de Despliegue en la Nube (Railway vs. Supabase)

| Característica | Supabase | Railway (Recomendado) |
| :--- | :--- | :--- |
| **Motor de Base de Datos** | **PostgreSQL** exclusivamente | **MySQL / MariaDB nativo** |
| **Compatibilidad con el Proyecto** | Requiere reescribir todo el código SQL y la capa `mysqli` | **100% Compatible sin cambiar código** |
| **Dominio y Certificado SSL** | Provee API REST y dashboard | Provee subdominio gratuito `*.up.railway.app` con HTTPS automático |
| **Costo** | Plan gratuito limitado | Créditos de bienvenida / Plan Hobby muy económico |

> **Dictamen sobre Supabase:** Supabase no ofrece MySQL. Como este proyecto utiliza funciones nativas `mysqli` y sintaxis específica de MySQL/MariaDB, migrarlo a Supabase obligaría a reescribir todos los modelos y controladores a PostgreSQL.  
> **Recomendación:** Desplegar en **Railway**:
> 1. Crear un proyecto en Railway y agregar el servicio **MySQL**.
> 2. Importar el archivo SQL mediante Railway CLI o conectando phpMyAdmin/DBeaver.
> 3. Conectar el repositorio de GitHub; Railway detectará el `Dockerfile` y conectará automáticamente las variables `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE` que ya configuramos en `config/global.php`.

---

## 6. Suite de Pruebas de Estrés y Carga

Se programó el script `stress_test.py` en Python que evalúa:
* Concurrencia de usuarios simultáneos (threads paralelos).
* Throughput (peticiones por segundo - RPS).
* Latencia de respuesta: mínima, promedio, mediana ($p_{50}$), $p_{90}$, $p_{95}$ y $p_{99}$.
* Tasa de éxito y tasa de errores.

### Cómo ejecutar la prueba:
```bash
# Ejemplo: 25 usuarios concurrentes durante 30 segundos
python3 stress_test.py --url http://localhost:8080 --users 25 --duration 30
```

---

## 7. Plan de Modernización UI/UX

El diseño original presentaba patrones visuales rígidos y desalineados:
1. **Paleta de Color y Tipografía:** Se establecieron variables CSS modernas en `public/css/base/variables.css` con tonos índigo corporativos, acentos esmeralda y fuentes del sistema optimizadas.
2. **Componentes Interactivos:**
   * Botones con `display: inline-flex`, micro-transiciones suaves y elevación en hover.
   * Tablas DataTables con bordes redondeados y paginación estilizada.
   * Formularios con inputs con estados de foco accesibles (`outline-ring`).
3. **Responsive Design:** Corrección de breakpoints móviles en la barra de navegación para evitar desbordamientos en pantallas pequeñas.
