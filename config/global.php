<?php 
// Configuración dinámica por variables de entorno o valores por defecto para XAMPP
define("DB_HOST", getenv("DB_HOST") ?: (getenv("MYSQLHOST") ?: "localhost"));
define("DB_NAME", getenv("DB_NAME") ?: (getenv("MYSQLDATABASE") ?: "colegio"));
define("DB_USERNAME", getenv("DB_USER") ?: (getenv("DB_USERNAME") ?: (getenv("MYSQLUSER") ?: "root")));
define("DB_PASSWORD", getenv("DB_PASSWORD") !== false ? getenv("DB_PASSWORD") : (getenv("MYSQLPASSWORD") !== false ? getenv("MYSQLPASSWORD") : ""));
define("DB_PORT", (int)(getenv("DB_PORT") ?: (getenv("MYSQLPORT") ?: 3306)));

// Definimos la codificación de los caracteres
define("DB_ENCODE", "utf8mb4");

// Definimos una constante como nombre del proyecto
define("PRO_NOMBRE", "COLEGIO");
?>