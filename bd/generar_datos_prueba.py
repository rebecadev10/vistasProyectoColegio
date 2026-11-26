#!/usr/bin/env python3
import os

sql_file = "/Users/rebeca/PROYECTO JADE/vistasProyectoColegio/bd/datos_de_prueba_2026.sql"

noticias = [
    ("Inauguración del Nuevo Laboratorio de Ciencias", 
     "La Unidad Educativa Manuel Díaz Rodríguez inauguró formalmente su moderno laboratorio de física y química, equipado con instrumental de última generación para fortalecer las prácticas experimentales de nuestros bachilleres.", 
     "noticias/noticia_1.jpg", 1),
    ("Estudiantes Destacan en Olimpiadas de Matemáticas", 
     "Una delegación de cinco estudiantes de educación media general obtuvo menciones de honor en la fase regional de las Olimpiadas Matemáticas del estado Miranda, demostrando un extraordinario nivel académico y dedicación.", 
     "noticias/noticia_2.jpg", 1),
    ("Jornada Ecológica de Reforestación y Siembra", 
     "En el marco de la preservación ambiental, docentes y alumnos del comité ecológico llevaron a cabo la siembra de árboles autóctonos y plantas ornamentales en las áreas verdes circundantes al patio central.", 
     "noticias/noticia_3.jpg", 1),
    ("Feria de Robótica y Tecnología Escolar 2026", 
     "El departamento de computación celebró la primera muestra de robótica estudiantil, donde los jóvenes presentaron proyectos de automatización, programación y domótica aplicada a la educación.", 
     "noticias/noticia_4.jpg", 1),
    ("Semana Aniversaria: Actos Cívicos y Culturales", 
     "Nuestra institución conmemora un nuevo aniversario institucional con un nutrido programa de actividades académicas, desfiles folclóricos, conciertos y encuentros intercolegiales.", 
     "noticias/noticia_5.jpg", 1),
    ("Entrega de Reconocimientos al Mérito Académico", 
     "En un emotivo acto en el salón múltiple, se entregaron diplomas y medallas a los estudiantes con los promedios más sobresalientes del primer lapso escolar en todos los niveles.", 
     "noticias/noticia_6.jpg", 1),
    ("Taller de Prevención y Seguridad Digital", 
     "Especialistas en ciberseguridad ofrecieron una conferencia orientadora sobre el uso responsable de redes sociales, prevención del ciberacoso y protección de datos para jóvenes y representantes.", 
     "noticias/noticia_7.jpg", 1),
    ("Encuentro Intercolegial de Ajedrez", 
     "Los Teques fue sede del torneo amistoso de ajedrez estudiantil, donde el equipo representativo de la U.E. Manuel Díaz Rodríguez conquistó el primer lugar del podio.", 
     "noticias/noticia_8.jpg", 1),
    ("Dotación de Nuevos Textos a la Biblioteca", 
     "Gracias a la coordinación del departamento de biblioteca y donaciones institucionales, se incorporaron más de 300 volúmenes de literatura universal, ciencias exactas e historia contemporánea.", 
     "noticias/noticia_9.jpg", 1),
    ("Campaña Escolar de Salud y Nutrición Integral", 
     "Personal médico calificado atendió a la comunidad estudiantil en una jornada de despistaje nutricional, salud visual y recomendaciones preventivas para una alimentación saludable.", 
     "noticias/noticia_10.jpg", 1),
    ("Festival de Teatro y Expresión Artística", 
     "La agrupación teatral escolar presentó adaptaciones clásicas de la dramaturgia venezolana, promoviendo la sensibilidad artística y el trabajo en equipo.", 
     "noticias/noticia_11.jpg", 1),
    ("Gran Éxito en la Muestra de Pintura y Dibujo", 
     "Los pasillos del plantel se transformaron en una galería viva donde se expusieron más de 80 lienzos elaborados por los alumnos del área de arte y patrimonio.", 
     "noticias/noticia_12.jpg", 1),
    ("Capacitación Docente en Inteligencia Artificial", 
     "Los profesores de todas las áreas participaron en una jornada formativa sobre integración de herramientas digitales y metodologías activas para el aula moderna.", 
     "noticias/noticia_13.jpg", 1),
    ("Torneo de Baloncesto Intersecciones", 
     "Con gran entusiasmo y espíritu deportivo culminó el campeonato interno de baloncesto, coronando como campeón invicto al equipo de 4to año sección B.", 
     "noticias/noticia_14.jpg", 1),
    ("Celebración del Día del Maestro Venezolano", 
     "La directiva y comunidad de padres homenajearon al cuerpo profesoral con un desayuno especial y palabras de gratitud por su vocación y compromiso pedagógico.", 
     "noticias/noticia_15.jpg", 1),
    ("Muestra Gastronómica Tradicional Miranda", 
     "Los estudiantes de 3er año exhibieron dulces y platos típicos de la región mirandina como parte de sus proyectos socioproductivos y de identidad regional.", 
     "noticias/noticia_16.jpg", 1),
    ("Reunión General de la Sociedad de Padres", 
     "Se desarrolló una provechosa asamblea general donde se presentaron los avances en infraestructura y el plan de actividades formativas del año en curso.", 
     "noticias/noticia_17.jpg", 1),
    ("Simulacro Escolar de Evacuación y Primeros Auxilios", 
     "Con el apoyo de Protección Civil y Bomberos de Miranda, se realizó con éxito un ejercicio de desalojo rápido ante emergencias, cumpliendo todos los estándares de seguridad.", 
     "noticias/noticia_18.jpg", 1),
    ("Inicio del Proceso de Inscripciones 2026-2027", 
     "La oficina de control de estudio publicó los requisitos, fechas y procedimiento digital para nuevos ingresos y renovación de matrícula para el venidero ciclo académico.", 
     "noticias/noticia_19.jpg", 1),
    ("Concierto de la Coral Estudiantil Manuel Díaz", 
     "Nuestra distinguida coral cerró el trimestre con un concierto de música sacra y polifónica venezolana, recibiendo la ovación de pie de toda la audiencia.", 
     "noticias/noticia_20.jpg", 1),
]

eventos = [
    ("Feria Científica 2026", "Exposición de experimentos y proyectos de física, química y biología en los patios del colegio.", "eventos/evento_1.jpg", 2, "2026-03-10", "08:00:00", "2026-03-10", "13:00:00", 1),
    ("Torneo Deportivo", "Campeonato intercolegial de fútbol sala y baloncesto entre colegios del circuito Los Teques.", "eventos/evento_2.jpg", 7, "2026-03-15", "09:00:00", "2026-03-15", "15:00:00", 1),
    ("Entrega de Boletines", "Reunión de padres y representantes con profesores guías para entrega de notas del primer lapso.", "eventos/evento_3.jpg", 3, "2026-03-20", "08:30:00", "2026-03-20", "12:00:00", 1),
    ("Elección Reina Escolar", "Celebración de la semana aniversaria con presentaciones culturales y elección de la reina estudiantil.", "eventos/evento_4.jpg", 4, "2026-03-25", "10:00:00", "2026-03-25", "14:00:00", 1),
    ("Simposio Vocacional", "Orientación vocacional y visitas de universidades para estudiantes de 4to y 5to año de bachillerato.", "eventos/evento_5.jpg", 5, "2026-04-05", "08:00:00", "2026-04-05", "13:30:00", 1),
    ("Festival de Coros", "Encuentro de agrupaciones corales estudiantiles del estado Miranda en el auditorio principal.", "eventos/evento_6.jpg", 4, "2026-04-12", "09:30:00", "2026-04-12", "14:00:00", 1),
    ("Olimpiada de Química", "Fase clasificatoria para bachilleres de 3ero a 5to año con pruebas teóricas y experimentales.", "eventos/evento_7.jpg", 2, "2026-04-18", "08:00:00", "2026-04-18", "12:00:00", 1),
    ("Encuentro de Bandas", "Demostración de ritmo, marcialidad y sincronía entre bandas de marcha de la región.", "eventos/evento_8.jpg", 4, "2026-04-24", "10:00:00", "2026-04-24", "15:00:00", 1),
    ("Cine Foro: Miranda", "Proyección cinematográfica y debate guiado por profesores de historia y ciencias sociales.", "eventos/evento_9.jpg", 4, "2026-05-02", "09:00:00", "2026-05-02", "12:00:00", 1),
    ("Donación de Libros", "Jornada solidaria para nutrir los estantes de lectura libre de la biblioteca escolar.", "eventos/evento_10.jpg", 2, "2026-05-08", "08:00:00", "2026-05-08", "13:00:00", 1),
    ("Taller de Oratoria", "Capacitación práctica en expresión verbal, dicción y argumentación para líderes estudiantiles.", "eventos/evento_11.jpg", 5, "2026-05-15", "09:00:00", "2026-05-15", "12:30:00", 1),
    ("Clase Magistral Historia", "Conferencia especial con el historiador municipal sobre las crónicas de Los Teques colonial.", "eventos/evento_12.jpg", 2, "2026-05-22", "10:00:00", "2026-05-22", "12:00:00", 1),
    ("Campeonato Voleibol", "Torneo femenino y masculino de voleibol entre bachilleres en las canchas de la institución.", "eventos/evento_13.jpg", 7, "2026-05-29", "08:30:00", "2026-05-29", "14:00:00", 1),
    ("Día Medio Ambiente", "Actividades de reciclaje, siembra y paneles educativos sobre el cambio climático global.", "eventos/evento_14.jpg", 2, "2026-06-05", "08:00:00", "2026-06-05", "13:00:00", 1),
    ("Festival Folclórico", "Bailes tradicionales venezolanos: joropo, tambor y danzas típicas de las costas mirandinas.", "eventos/evento_15.jpg", 4, "2026-06-12", "09:00:00", "2026-06-12", "15:00:00", 1),
    ("Cierre de Proyectos", "Defensa y presentación pública de los proyectos pedagógicos de aula de todo el plantel.", "eventos/evento_16.jpg", 3, "2026-06-19", "08:00:00", "2026-06-19", "14:00:00", 1),
    ("Exposición de Física", "Presentación de maquetas cinemáticas, circuitos eléctricos y óptica experimental.", "eventos/evento_17.jpg", 6, "2026-06-25", "09:00:00", "2026-06-25", "13:00:00", 1),
    ("Maratón 5K Estudiantil", "Carrera y caminata familiar de 5 kilómetros por las avenidas aledañas al sector La Estrella.", "eventos/evento_18.jpg", 7, "2026-07-04", "07:00:00", "2026-07-04", "11:00:00", 1),
    ("Acto de Graduación", "Ceremonia solemne de egreso de la promoción de Bachilleres en Ciencias 2026.", "eventos/evento_19.jpg", 3, "2026-07-15", "10:00:00", "2026-07-15", "14:00:00", 1),
    ("Convivencia Familiar", "Jornada dominical de juegos tradicionales, compartir y recreación para toda la comunidad.", "eventos/evento_20.jpg", 5, "2026-07-19", "09:00:00", "2026-07-19", "16:00:00", 1),
]

recursos = [
    ("Guía de Álgebra y Trigonometría", "Ejercicios resueltos y propuestos para 3er y 4to año de educación media.", "Prof. Carlos Ramos", "2026-01-15", "Editorial Santillana", 2, "recursos/recurso_1.jpg", "recursos/recurso_1.pdf"),
    ("Manual de Laboratorio Química", "Prácticas de estequiometría, disoluciones y reacciones químicas fundamentales.", "Dra. Elena Salazar", "2026-01-20", "Ediciones McGraw-Hill", 2, "recursos/recurso_2.jpg", "recursos/recurso_2.pdf"),
    ("Historia de Venezuela Contemporánea", "Análisis histórico desde la consolidación republicana hasta el siglo XXI.", "Lic. Roberto Gil", "2026-01-28", "Editorial Colegial", 2, "recursos/recurso_3.jpg", "recursos/recurso_3.pdf"),
    ("Antología Poética Latinoamericana", "Selección de versos y autores fundamentales de la lírica en lengua española.", "Prof. Carmen Díaz", "2026-02-05", "Monte Ávila Editores", 4, "recursos/recurso_4.jpg", "recursos/recurso_4.pdf"),
    ("Fundamentos de Física Mecánica", "Cinemática, dinámica y leyes de Newton con problemas aplicados al entorno real.", "Ing. Marcos Pérez", "2026-02-12", "Editorial Panapo", 6, "recursos/recurso_5.jpg", "recursos/recurso_5.pdf"),
    ("Guía Práctica de Biología", "Estudio de la célula, genética mendeliana y ecología de ecosistemas tropicales.", "Lic. Laura Moreno", "2026-02-18", "Editorial Larense", 2, "recursos/recurso_6.jpg", "recursos/recurso_6.pdf"),
    ("Inglés Técnico para Bachillerato", "Vocabulario especializado, tiempos verbales y comprensión de lectura guiada.", "Prof. John Baker", "2026-02-25", "Pearson Education", 2, "recursos/recurso_7.jpg", "recursos/recurso_7.pdf"),
    ("Introducción a Python", "Conceptos básicos de algoritmos, variables, bucles y funciones en Python 3.", "Ing. Luis Sánchez", "2026-03-01", "Ediciones Marcombo", 6, "recursos/recurso_8.jpg", "recursos/recurso_8.pdf"),
    ("Educación Física y Salud", "Metodología del entrenamiento físico, fisiología del ejercicio y primeros auxilios.", "Prof. David Torres", "2026-03-05", "Editorial Kinesis", 7, "recursos/recurso_9.jpg", "recursos/recurso_9.pdf"),
    ("Compendio de Geografía General", "Cartografía, climatología y relieve del territorio nacional y mundial.", "Lic. Sonia Castro", "2026-03-10", "Editorial Romor", 2, "recursos/recurso_10.jpg", "recursos/recurso_10.pdf"),
    ("Técnicas de Estudio Efectivas", "Mapas conceptuales, cuadros sinópticos y métodos de memorización activa.", "Psic. Ana Rivas", "2026-03-15", "Editorial Trillas", 5, "recursos/recurso_11.jpg", "recursos/recurso_11.pdf"),
    ("Cuaderno de Geometría Analítica", "Lugares geométricos, rectas, parábolas y circunferencias en el plano cartesiano.", "Prof. Raúl Gómez", "2026-03-20", "Editorial CEC", 2, "recursos/recurso_12.jpg", "recursos/recurso_12.pdf"),
    ("Manual de Ortografía y Redacción", "Reglas de acentuación, signos de puntuación y redacción de textos formales.", "Lic. Patricia Vega", "2026-03-25", "Editorial Espasa", 2, "recursos/recurso_13.jpg", "recursos/recurso_13.pdf"),
    ("Filosofía y Ética Ciudadana", "Corrientes filosóficas clásicas y valores fundamentales para la convivencia escolar.", "Prof. Manuel Soto", "2026-04-01", "Editorial Tecnos", 5, "recursos/recurso_14.jpg", "recursos/recurso_14.pdf"),
    ("Atlas Ilustrado de Venezuela", "Mapas físicos y políticos, parques nacionales y cuencas hidrográficas.", "Geóg. Andrés Silva", "2026-04-08", "Fundación Polar", 2, "recursos/recurso_15.jpg", "recursos/recurso_15.pdf"),
    ("Guía de Dibujo Técnico", "Instrumentos de dibujo, acotamiento y vistas ortogonales en perspectiva isométrica.", "Arq. Víctor Bello", "2026-04-14", "Editorial Monfort", 6, "recursos/recurso_16.jpg", "recursos/recurso_16.pdf"),
    ("Formación Cívica y Social", "Estructura del Estado, derechos y deberes ciudadanos consagrados en la Constitución.", "Abg. Clara Méndez", "2026-04-20", "Editorial Jurídica", 3, "recursos/recurso_17.jpg", "recursos/recurso_17.pdf"),
    ("Ejercicios de Estadística", "Medidas de tendencia central, dispersión y gráficos para toma de decisiones.", "Prof. Jorge Lara", "2026-04-26", "Editorial Schaum", 2, "recursos/recurso_18.jpg", "recursos/recurso_18.pdf"),
    ("Ecología y Biodiversidad", "Conservación de la fauna y flora nacional en peligro y desarrollo sustentable.", "Lic. Rosa Padrón", "2026-05-02", "Editorial Galac", 2, "recursos/recurso_19.jpg", "recursos/recurso_19.pdf"),
    ("Literatura Universal Seleccionada", "Estudio de las grandes obras de la literatura europea, asiática y americana.", "Prof. Teresa Ruiz", "2026-05-10", "Editorial Cátedra", 4, "recursos/recurso_20.jpg", "recursos/recurso_20.pdf"),
]

comunicacion = [
    ("Inicio Formal del 2do Lapso Pedagógico", "Se informa a toda la comunidad educativa que el próximo lunes inician formalmente las actividades académicas del segundo lapso escolar. Se solicita puntualidad y uniforme reglamentario.", "comunicacion/anuncio_1.jpg", "2026-01-10"),
    ("Asamblea General de Padres y Representantes", "Convocatoria con carácter de obligatoriedad a la asamblea informativa sobre el presupuesto y mejoras del plantel, pautada en el salón de usos múltiples.", "comunicacion/anuncio_2.jpg", "2026-01-18"),
    ("Cronograma de Evaluaciones Sumativas", "Ya se encuentra disponible en la cartelera digital el cronograma detallado de evaluaciones parciales y talleres para todas las secciones de bachillerato.", "comunicacion/anuncio_3.jpg", "2026-01-25"),
    ("Dispensación de Actividades por Taller Docente", "El próximo viernes los estudiantes no tendrán actividades presenciales debido a la jornada pedagógica mensual de formación continua del personal docente.", "comunicacion/anuncio_4.jpg", "2026-02-02"),
    ("Apertura del Registro para Becas de Estudio", "Se abre el período de recepción de solicitudes de beca al mérito académico y apoyo socioeconómico para el año en curso ante el departamento de psicopedagogía.", "comunicacion/anuncio_5.jpg", "2026-02-10"),
    ("Uso Obligatorio del Uniforme Escolar", "Se recuerda que el porte del uniforme diario y de educación física debe cumplir con las normativas internas del Ministerio de Educación sin excepciones.", "comunicacion/anuncio_6.jpg", "2026-02-17"),
    ("Horario Especial por Motivo de Asueto", "Con motivo de las fechas festivas patrias, las actividades administrativas y académicas se reanudarán el día miércoles en su horario habitual de 7:00 AM.", "comunicacion/anuncio_7.jpg", "2026-02-23"),
    ("Mantenimiento Programado del Portal Web", "El sistema informático de notas y biblioteca estará en labores de actualización técnica durante el fin de semana para mejorar la velocidad y seguridad.", "comunicacion/anuncio_8.jpg", "2026-03-01"),
    ("Entrega de Carnets Estudiantiles 2026", "La coordinación de control de estudio iniciará la entrega de los nuevos carnets con código QR de acceso para todos los estudiantes matriculados.", "comunicacion/anuncio_9.jpg", "2026-03-08"),
    ("Convocatoria a Consejo Extraordinario de Profesores", "Se cita a todo el personal docente de educación media general a reunión evaluativa de rendimiento del 1er corte en la sala de profesores.", "comunicacion/anuncio_10.jpg", "2026-03-15"),
    ("Inscripción en Actividades Extracurriculares", "Están abiertas las inscripciones para los clubes de ajedrez, banda de guerra, coral y robótica. Los cupos son limitados y sin costo adicional.", "comunicacion/anuncio_11.jpg", "2026-03-22"),
    ("Aviso Administrativo de Pagos y Aranceles", "Se informa a los representantes que el departamento de administración estará atendiendo trámites de solvencias en el horario de 8:00 AM a 1:00 PM.", "comunicacion/anuncio_12.jpg", "2026-03-28"),
    ("Jornada de Vacunación en Sede Escolar", "En coordinación con el Ambulatorio local se aplicarán dosis de refuerzo y vacunas pediátricas en el consultorio médico de la institución.", "comunicacion/anuncio_13.jpg", "2026-04-04"),
    ("Normativa sobre Dispositivos Móviles", "Se reitera que el uso de teléfonos celulares en las aulas está reservado exclusivamente para fines pedagógicos autorizados por el docente de la cátedra.", "comunicacion/anuncio_14.jpg", "2026-04-11"),
    ("Resultados del Comité de Becas Estudiantiles", "Los listados de beneficiarios del programa de becas de excelencia académica están publicados en la cartelera interna de orientación estudiantil.", "comunicacion/anuncio_15.jpg", "2026-04-18"),
    ("Celebración del Acto del Bicentenario", "Toda la comunidad queda invitada a presenciar la parada cívica y disertación histórica con motivo de las efemérides patrias en el patio techado.", "comunicacion/anuncio_16.jpg", "2026-04-25"),
    ("Recepción de Documentos para Bachilleres", "Los estudiantes cursantes de 5to año deben consignar copia de partida de nacimiento actualizada y notas certificadas en la oficina de control de estudio.", "comunicacion/anuncio_17.jpg", "2026-05-03"),
    ("Protocolo de Seguridad en Entradas y Salidas", "Se exhorta a los representantes a respetar la bahía de estacionamiento y no obstruir el portón principal para garantizar la seguridad de los alumnos.", "comunicacion/anuncio_18.jpg", "2026-05-10"),
    ("Convocatoria a Elecciones Estudiantiles", "Se inicia el proceso para la conformación del Centro de Estudiantes del período 2026-2027. Las planchas deberán inscribirse hasta el viernes entrante.", "comunicacion/anuncio_19.jpg", "2026-05-17"),
    ("Cierre Exitoso de Lapso y Felicitaciones", "El equipo directivo extiende una cordial felicitación a los estudiantes, docentes y familias por la dedicación y excelencia demostrada este trimestre.", "comunicacion/anuncio_20.jpg", "2026-05-24"),
]

usuarios = [
    ("Carlos", "Mendoza", 28450111, "usuarios/usuario_1.jpg", "admin123", [1, 2, 3]),
    ("María", "Rodríguez", 27330222, "usuarios/usuario_2.jpg", "docente2026", [2]),
    ("Alejandro", "Pérez", 29555333, "usuarios/usuario_3.jpg", "estudiante2026", [1]),
    ("Valeria", "Gómez", 29888444, "usuarios/usuario_4.jpg", "estudiante2026", [1]),
    ("José", "Hernández", 19222555, "usuarios/usuario_5.jpg", "docente2026", [2]),
    ("Gabriela", "Castillo", 26111666, "usuarios/usuario_6.jpg", "admin2026", [3]),
    ("Daniel", "Morales", 29777123, "usuarios/usuario_7.jpg", "estudiante2026", [1]),
    ("Sofía", "Martínez", 29444321, "usuarios/usuario_8.jpg", "estudiante2026", [1]),
    ("Fernando", "Torres", 18555678, "usuarios/usuario_9.jpg", "docente2026", [2]),
    ("Camila", "Silva", 29333987, "usuarios/usuario_10.jpg", "estudiante2026", [1]),
    ("Andrés", "Rojas", 28999876, "usuarios/usuario_11.jpg", "estudiante2026", [1]),
    ("Lucía", "Paredes", 17444111, "usuarios/usuario_12.jpg", "docente2026", [2]),
    ("Ricardo", "Blanco", 29111222, "usuarios/usuario_13.jpg", "estudiante2026", [1]),
    ("Elena", "Suárez", 20333444, "usuarios/usuario_14.jpg", "docente2026", [2]),
    ("Mateo", "Vargas", 29666777, "usuarios/usuario_15.jpg", "estudiante2026", [1]),
    ("Isabella", "Navarro", 29222333, "usuarios/usuario_16.jpg", "estudiante2026", [1]),
    ("Javier", "Rivas", 16888999, "usuarios/usuario_17.jpg", "docente2026", [2]),
    ("Paola", "Acosta", 29000111, "usuarios/usuario_18.jpg", "estudiante2026", [1]),
    ("Santiago", "Medina", 29555444, "usuarios/usuario_19.jpg", "estudiante2026", [1]),
    ("Victoria", "Cabrera", 21777888, "usuarios/usuario_20.jpg", "admin2026", [3])
]

with open(sql_file, "w", encoding="utf-8") as f:
    f.write("-- =========================================================================\n")
    f.write("-- SCRIPT DE DATOS REALISTAS DE PRUEBA 2026 - U.E. MANUEL DÍAZ RODRÍGUEZ\n")
    f.write("-- Generado para pruebas de comportamiento, edición y visualización del sistema\n")
    f.write("-- Compatible con MySQL 8+, MariaDB 10/11+ y Modo Estricto\n")
    f.write("-- =========================================================================\n\n")
    f.write("USE `colegio`;\n\n")
    f.write("SET FOREIGN_KEY_CHECKS = 0;\n\n")

    # Fix empty departamento if needed
    f.write("-- 0. Normalización de Departamentos y Capacidades de Columnas\n")
    f.write("UPDATE `departamentos` SET `nombre` = 'Dirección Académica' WHERE `idDepartamento` = 1;\n\n")
    f.write("ALTER TABLE `noticias` MODIFY `titulo` VARCHAR(255) NOT NULL;\n")
    f.write("ALTER TABLE `noticias` MODIFY `nombreImagenN` VARCHAR(255) NOT NULL;\n")
    f.write("ALTER TABLE `eventos` MODIFY `titulo` VARCHAR(255) NOT NULL;\n")
    f.write("ALTER TABLE `eventos` MODIFY `descripcion` TEXT NOT NULL;\n")
    f.write("ALTER TABLE `eventos` MODIFY `nombreImagen` VARCHAR(255) NOT NULL;\n")
    f.write("ALTER TABLE `recursos` MODIFY `tituloRecurso` VARCHAR(255) NOT NULL;\n")
    f.write("ALTER TABLE `recursos` MODIFY `descripcion` TEXT NOT NULL;\n")
    f.write("ALTER TABLE `recursos` MODIFY `autor` VARCHAR(100) NOT NULL;\n")
    f.write("ALTER TABLE `recursos` MODIFY `editorial` VARCHAR(100) NOT NULL;\n")
    f.write("ALTER TABLE `recursos` MODIFY `fotoPortada` VARCHAR(255) NOT NULL;\n")
    f.write("ALTER TABLE `recursos` MODIFY `dataRecurso` VARCHAR(255) NOT NULL;\n")
    f.write("ALTER TABLE `comunicacion` MODIFY `asunto` VARCHAR(255) NOT NULL;\n")
    f.write("ALTER TABLE `comunicacion` MODIFY `descripcion` TEXT NOT NULL;\n")
    f.write("ALTER TABLE `comunicacion` MODIFY `imagenAnuncio` VARCHAR(255) NOT NULL;\n")
    f.write("ALTER TABLE `usuario` MODIFY `imagenUsuario` VARCHAR(255) NOT NULL;\n\n")

    # Clean existing data and reset auto_increment for crisp testing
    f.write("-- Limpieza de tablas principales para carga limpia de pruebas\n")
    f.write("TRUNCATE TABLE `noticias`;\n")
    f.write("TRUNCATE TABLE `eventos`;\n")
    f.write("TRUNCATE TABLE `recursos`;\n")
    f.write("TRUNCATE TABLE `comunicacion`;\n")
    f.write("TRUNCATE TABLE `usuariopermiso`;\n")
    f.write("TRUNCATE TABLE `usuario`;\n\n")

    # 1. Noticias
    f.write("-- 1. Inserción de 20 Noticias Realistas\n")
    f.write("INSERT INTO `noticias` (`titulo`, `descripcion`, `nombreImagenN`, `estado`) VALUES\n")
    n_rows = []
    for tit, desc, img, est in noticias:
        t_esc = tit[:50].replace("'", "''")
        d_esc = desc.replace("'", "''")
        n_rows.append(f"('{t_esc}', '{d_esc}', '{img}', {est})")
    f.write(",\n".join(n_rows) + ";\n\n")

    # 2. Eventos
    f.write("-- 2. Inserción de 20 Eventos Escolares 2026\n")
    f.write("INSERT INTO `eventos` (`titulo`, `descripcion`, `nombreImagen`, `departamento`, `fechaInicio`, `horaInicio`, `fechaFin`, `horaFin`, `estado`) VALUES\n")
    e_rows = []
    for tit, desc, img, dep, fi, hi, ff, hf, est in eventos:
        t_esc = tit[:25].replace("'", "''")
        d_esc = desc[:250].replace("'", "''")
        e_rows.append(f"('{t_esc}', '{d_esc}', '{img}', {dep}, '{fi}', '{hi}', '{ff}', '{hf}', {est})")
    f.write(",\n".join(e_rows) + ";\n\n")

    # 3. Recursos
    f.write("-- 3. Inserción de 20 Recursos Pedagógicos\n")
    f.write("INSERT INTO `recursos` (`tituloRecurso`, `descripcion`, `autor`, `fechaPublicacion`, `editorial`, `idDepartamento`, `fotoPortada`, `dataRecurso`) VALUES\n")
    r_rows = []
    for tit, desc, aut, fp, ed, dep, img, doc in recursos:
        t_esc = tit[:50].replace("'", "''")
        d_esc = desc[:250].replace("'", "''")
        a_esc = aut[:20].replace("'", "''")
        e_esc = ed[:25].replace("'", "''")
        r_rows.append(f"('{t_esc}', '{d_esc}', '{a_esc}', '{fp}', '{e_esc}', {dep}, '{img}', '{doc}')")
    f.write(",\n".join(r_rows) + ";\n\n")

    # 4. Comunicacion / Anuncios
    f.write("-- 4. Inserción de 20 Anuncios y Comunicados Oficiales\n")
    f.write("INSERT INTO `comunicacion` (`asunto`, `descripcion`, `imagenAnuncio`, `fecha`) VALUES\n")
    c_rows = []
    for asu, desc, img, fec in comunicacion:
        a_esc = asu[:50].replace("'", "''")
        d_esc = desc[:600].replace("'", "''")
        c_rows.append(f"('{a_esc}', '{d_esc}', '{img}', '{fec}')")
    f.write(",\n".join(c_rows) + ";\n\n")

    # 5. Usuarios
    f.write("-- 5. Inserción de 20 Usuarios (Administradores, Docentes, Estudiantes)\n")
    f.write("INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `cedula`, `imagenUsuario`, `clave`) VALUES\n")
    u_rows = []
    for idx, (nom, ape, ced, img, clv, _) in enumerate(usuarios, start=1):
        n_esc = nom.replace("'", "''")
        a_esc = ape.replace("'", "''")
        u_rows.append(f"({idx}, '{n_esc}', '{a_esc}', {ced}, '{img}', '{clv}')")
    f.write(",\n".join(u_rows) + ";\n\n")

    # 6. Permisos de Usuarios
    f.write("-- 6. Asignación de Roles / Permisos (1: Estudiante, 2: Docente, 3: Administrativo)\n")
    f.write("INSERT INTO `usuariopermiso` (`idUsuario`, `idPermisos`) VALUES\n")
    p_rows = []
    for idx, (_, _, _, _, _, perms) in enumerate(usuarios, start=1):
        for p in perms:
            p_rows.append(f"({idx}, {p})")
    f.write(",\n".join(p_rows) + ";\n\n")

    f.write("SET FOREIGN_KEY_CHECKS = 1;\n")
    f.write("-- =========================================================================\n")
    f.write("-- FIN DEL SCRIPT DE DATOS DE PRUEBA\n")
    f.write("-- =========================================================================\n")

print(f"Script SQL generado exitosamente en: {sql_file}")
