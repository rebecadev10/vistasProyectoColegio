# Sistema de Gestión Escolar - U.E. Manuel Díaz Rodríguez

Sistema web integral para la administración y comunicación de la comunidad educativa: gestión de noticias, eventos escolares, recursos pedagógicos, circulares/comunicaciones y control de usuarios por roles.

---

## 🚀 Guía de Instalación y Ejecución en Windows (con XAMPP)

Para que el cliente ejecute el sistema en una máquina con Windows:

### 1. Ubicación de la Carpeta del Proyecto
1. Descargar o clonar el repositorio.
2. Copiar la carpeta completa dentro del directorio `htdocs` de XAMPP:
   ```text
   C:\xampp\htdocs\colegio
   ```
   *(Asegúrate de que la ruta quede exactamente así, de modo que el archivo `index.html` esté en `C:\xampp\htdocs\colegio\index.html`)*.

---

### 2. Iniciar Servicios en XAMPP
1. Abre el **XAMPP Control Panel** en Windows.
2. Haz clic en **Start** en el módulo **Apache**.
3. Haz clic en **Start** en el módulo **MySQL**.
*(Ambos módulos deben mostrar fondo verde).*

---

### 3. Crear e Importar la Base de Datos
1. Abre tu navegador web y entra a:
   [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. En la barra lateral izquierda, haz clic en **"Nueva"** (o *New*).
3. Escribe como nombre de base de datos:
   ```text
   colegio
   ```
   *(Cotejamiento recomendado: `utf8mb4_general_ci` o el predeterminado)* y haz clic en **Crear**.
4. Selecciona la base de datos `colegio` recién creada y haz clic en la pestaña superior **"Importar"**.
5. Haz clic en **"Seleccionar archivo"** y busca el archivo SQL ubicado en el proyecto:
   ```text
   C:\xampp\htdocs\colegio\bd\colegio 13_04_2026.sql
   ```
6. Baja hasta el final de la página y haz clic en el botón **"Importar"** (o *Continuar*).
7. Verás el mensaje confirmando que todas las tablas y datos se importaron con éxito.

---

### 4. Acceder al Sistema
Abre el navegador web en la siguiente dirección:
👉 **[http://localhost/colegio/index.html](http://localhost/colegio/index.html)**

---

### 5. Cuentas de Acceso para Pruebas (Roles)

| Rol | Usuario / Cédula | Contraseña | Permisos |
| :--- | :--- | :--- | :--- |
| **Administrador** | `29450555` | `12345` | Control total: Usuarios, Eventos, Noticias, Anuncios, Recursos |
| **Docente** | `30051282` | `12345` | Publicación y consulta de Recursos escolares |
| **Estudiante** | `16368790` | `12345678` | Consulta de Noticias, Calendario de Eventos y Descarga de Recursos |

*(También puedes registrar un usuario nuevo en cualquier momento desde la opción **"Regístrate"** en la pantalla de inicio de sesión).*

---

## 🍎 Guía de Ejecución en macOS

### Opción A: Con Docker (Recomendada)
Si tienes Docker Desktop instalado:
```bash
cd vistasProyectoColegio
docker compose up -d
```
* **Aplicación:** [http://localhost:8080](http://localhost:8080)
* **phpMyAdmin:** [http://localhost:8081](http://localhost:8081)

### Opción B: Con PHP y MariaDB / MySQL
1. Iniciar el servicio de base de datos MySQL local e importar `bd/colegio 13_04_2026.sql`.
2. Iniciar el servidor embebido de PHP desde la raíz del proyecto:
```bash
cd vistasProyectoColegio
php -S localhost:8000
```
3. Ingresar a [http://localhost:8000/index.html](http://localhost:8000/index.html).

---

## ⚡ Pruebas de Estrés y Carga
El repositorio incluye una suite automatizada en Python para evaluar el rendimiento bajo concurrencia:
```bash
# Ejemplo: Simular 25 usuarios concurrentes durante 30 segundos
python3 stress_test.py --url http://localhost/colegio --users 25 --duration 30
```

---

## 📋 Registro de Correcciones Técnicas Aplicadas
1. **Botón Mostrar Contraseña:** Corregido para evitar el envío involuntario del formulario de inicio de sesión.
2. **Control de Acceso por Roles (Estudiante):** Restricción estricta de menús administrativos y reparación de etiquetas HTML no cerradas en la barra de navegación.
3. **Módulo de Noticias y Eventos:** Resuelto el fallo de subida de archivos mediante rutas relativas multiplataforma compatibles con cualquier servidor y sistema operativo.
4. **Compatibilidad PHP 8.x:** Eliminados errores fatales de tipado estricto (`TypeError`) en arrays y variables de sesión.
5. **Configuración Flexible de Base de Datos:** Soporte para variables de entorno para despliegues locales (XAMPP/Docker) y en la nube (Railway).
