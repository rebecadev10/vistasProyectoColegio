#!/usr/bin/env python3
import os
import random
from PIL import Image, ImageDraw, ImageFont

BASE_DIR = "/Users/rebeca/PROYECTO JADE/vistasProyectoColegio"
PUBLIC_IMG_DIR = os.path.join(BASE_DIR, "public", "img", "contenido")
DATA_DIR = os.path.join(BASE_DIR, "data")

os.makedirs(os.path.join(DATA_DIR, "noticias"), exist_ok=True)
os.makedirs(os.path.join(DATA_DIR, "eventos"), exist_ok=True)
os.makedirs(os.path.join(DATA_DIR, "recursos"), exist_ok=True)
os.makedirs(os.path.join(DATA_DIR, "comunicacion"), exist_ok=True)
os.makedirs(os.path.join(DATA_DIR, "usuarios"), exist_ok=True)

# Base source images
source_images = [
    os.path.join(PUBLIC_IMG_DIR, "1.jpeg"),
    os.path.join(PUBLIC_IMG_DIR, "2.jpg"),
    os.path.join(PUBLIC_IMG_DIR, "3.jpg"),
    os.path.join(PUBLIC_IMG_DIR, "4.jpg"),
    os.path.join(PUBLIC_IMG_DIR, "noticia.jpg"),
    os.path.join(PUBLIC_IMG_DIR, "recurso.jpg"),
    os.path.join(PUBLIC_IMG_DIR, "anuncio.jpg"),
]
source_images = [img for img in source_images if os.path.exists(img)]

# Palette for overlays/cards
brand_navy = (3, 4, 94)
brand_blue = (0, 119, 182)
brand_accent = (0, 150, 199)
brand_gold = (245, 158, 11)
colors = [brand_navy, brand_blue, brand_accent, brand_gold, (30, 58, 138), (15, 118, 110)]

def create_styled_image(source_path, target_path, category_tag, title_text, width=800, height=500):
    if source_path and os.path.exists(source_path):
        try:
            im = Image.open(source_path).convert("RGBA")
            im = im.resize((width, height), Image.Resampling.LANCZOS)
        except Exception:
            im = Image.new("RGBA", (width, height), brand_navy)
    else:
        im = Image.new("RGBA", (width, height), brand_navy)

    # Add elegant gradient overlay at bottom for readability
    overlay = Image.new("RGBA", (width, height), (0, 0, 0, 0))
    draw = ImageDraw.Draw(overlay)
    
    # Bottom gradient
    grad_height = 160
    for y in range(height - grad_height, height):
        alpha = int(210 * ((y - (height - grad_height)) / grad_height))
        draw.line([(0, y), (width, y)], fill=(3, 4, 94, alpha))
    
    # Top badge
    draw.rounded_rectangle([24, 24, 200, 60], radius=18, fill=(3, 4, 94, 220), outline=(255, 255, 255, 120), width=1)
    draw.text((36, 34), category_tag.upper(), fill=(255, 255, 255, 255))
    
    # Title at bottom
    draw.text((28, height - 70), title_text[:45], fill=(255, 255, 255, 255))
    draw.text((28, height - 40), "U.E. Manuel Díaz Rodríguez • 2026", fill=(200, 225, 255, 220))

    final_img = Image.alpha_composite(im, overlay).convert("RGB")
    final_img.save(target_path, "JPEG", quality=88)

print("Generando imágenes para pruebas...")

# 1. Noticias (20)
noticias_titles = [
    "Inauguración del Nuevo Laboratorio de Ciencias",
    "Estudiantes Destacan en Olimpiadas de Matemáticas",
    "Jornada Ecológica de Reforestación y Siembra",
    "Feria de Robótica y Tecnología Escolar 2026",
    "Semana Aniversaria: Actos Cívicos y Culturales",
    "Entrega de Reconocimientos al Mérito Académico",
    "Taller de Prevención y Seguridad Digital",
    "Encuentro Intercolegial de Ajedrez",
    "Dotación de Nuevos Textos a la Biblioteca",
    "Campaña Escolar de Salud y Nutrición Integral",
    "Festival de Teatro y Expresión Artística",
    "Gran Éxito en la Muestra de Pintura y Dibujo",
    "Capacitación Docente en Inteligencia Artificial",
    "Torneo de Baloncesto Intersecciones",
    "Celebración del Día del Maestro Venezolano",
    "Muestra Gastronómica Tradicional Miranda",
    "Reunión General de la Sociedad de Padres",
    "Simulacro Escolar de Evacuación y Primeros Auxilios",
    "Inicio del Proceso de Inscripciones 2026-2027",
    "Concierto de la Coral Estudiantil Manuel Díaz"
]

for i, tit in enumerate(noticias_titles, start=1):
    src = source_images[(i - 1) % len(source_images)]
    dest = os.path.join(DATA_DIR, "noticias", f"noticia_{i}.jpg")
    create_styled_image(src, dest, "Noticias", tit)

# 2. Eventos (20)
eventos_titles = [
    "Feria de Ciencias y Tecnología",
    "Torneo Deportivo Intercolegial",
    "Entrega de Boletines Primer Lapso",
    "Elección de Reina Estudiantil",
    "Simposio de Orientación Vocacional",
    "Festival de Coros y Gaitas",
    "Olimpiada Regional de Química",
    "Encuentro de Bandas de Guerra",
    "Cine Foro: Cine Venezolano",
    "Jornada de Donación de Libros",
    "Taller de Oratoria y Debate",
    "Clase Magistral de Historia Local",
    "Campeonato Escolar de Voleibol",
    "Día Mundial del Medio Ambiente",
    "Festival Folclórico Mirandino",
    "Cierre de Proyectos de Aprendizaje",
    "Exposición de Maquetas de Física",
    "Maratón 5K Estudiantil",
    "Acto de Graduación Bachilleres",
    "Convivencia Familiar Escolar"
]

for i, tit in enumerate(eventos_titles, start=1):
    src = source_images[(i) % len(source_images)]
    dest = os.path.join(DATA_DIR, "eventos", f"evento_{i}.jpg")
    create_styled_image(src, dest, "Evento Escolar", tit)

# 3. Recursos (20)
recursos_titles = [
    "Guía de Álgebra y Trigonometría",
    "Manual de Prácticas de Laboratorio Química",
    "Historia de Venezuela Contemporánea",
    "Antología Poética Latinoamericana",
    "Fundamentos de Física Mecánica",
    "Guía Teórico-Práctica de Biología",
    "Inglés Técnico para Bachillerato",
    "Introducción a la Programación con Python",
    "Guía de Educación Física y Salud",
    "Compendio de Geografía General",
    "Técnicas de Estudio y Concentración",
    "Cuaderno de Ejercicios de Geometría",
    "Manual de Ortografía y Redacción",
    "Guía de Filosofía y Ética Ciudadana",
    "Atlas Ilustrado de Venezuela",
    "Guía de Dibujo Técnico y Proyecciones",
    "Módulo de Formación Cívica y Social",
    "Ejercicios Prácticos de Estadística",
    "Guía de Ecología y Biodiversidad",
    "Compendio de Literatura Universal"
]

for i, tit in enumerate(recursos_titles, start=1):
    src = source_images[(i + 1) % len(source_images)]
    dest = os.path.join(DATA_DIR, "recursos", f"recurso_{i}.jpg")
    create_styled_image(src, dest, "Recurso Pedagógico", tit)
    
    # Create sample PDF placeholder if not exists
    pdf_path = os.path.join(DATA_DIR, "recursos", f"recurso_{i}.pdf")
    if not os.path.exists(pdf_path):
        with open(pdf_path, "wb") as f:
            f.write(b"%PDF-1.4\n1 0 obj\n<< /Title (Recurso Educativo) >>\nendobj\ntrailer\n<< /Root 1 0 R >>\n%%EOF\n")

# 4. Comunicacion (20)
comunicacion_titles = [
    "Inicio Formal de Actividades del 2do Lapso",
    "Convocatoria Urgente a Asamblea de Representantes",
    "Cronograma de Evaluaciones Sumativas Finales",
    "Dispensación de Clases por Jornada Pedagógica",
    "Apertura del Registro para Becas de Estudio",
    "Recordatorio: Uso Obligatorio del Uniforme Escolar",
    "Horario Especial por Motivo de Asueto Nacional",
    "Mantenimiento Programado de Plataforma Web",
    "Entrega de Carnets Estudiantiles Digitales",
    "Convocatoria a Consejo de Docentes y Tutores",
    "Inscripción en Actividades Extracurriculares",
    "Aviso de Cobranza y Actualización Arancelaria",
    "Campañas de Vacunación Escolar en Sede",
    "Normativa de Convivencia y Uso de Teléfonos",
    "Resultados de las Becas de Excelencia",
    "Invitación al Acto Solemne del Bicentenario",
    "Recepción de Documentos para Bachilleres",
    "Aviso sobre Seguridad en Entradas y Salidas",
    "Comité Electoral Estudiantil: Votaciones",
    "Mensaje de Felicitación por Fin de Lapso"
]

for i, tit in enumerate(comunicacion_titles, start=1):
    src = source_images[(i + 2) % len(source_images)]
    dest = os.path.join(DATA_DIR, "comunicacion", f"anuncio_{i}.jpg")
    create_styled_image(src, dest, "Comunicado", tit)

# 5. Usuarios (20 Avatares)
usuarios_names = [
    ("Carlos", "Mendoza", 28450111, "admin123", [1, 2, 3]),
    ("María", "Rodríguez", 27330222, "docente2026", [2]),
    ("Alejandro", "Pérez", 29555333, "estudiante2026", [1]),
    ("Valeria", "Gómez", 29888444, "estudiante2026", [1]),
    ("José", "Hernández", 19222555, "docente2026", [2]),
    ("Gabriela", "Castillo", 26111666, "admin2026", [3]),
    ("Daniel", "Morales", 29777123, "estudiante2026", [1]),
    ("Sofía", "Martínez", 29444321, "estudiante2026", [1]),
    ("Fernando", "Torres", 18555678, "docente2026", [2]),
    ("Camila", "Silva", 29333987, "estudiante2026", [1]),
    ("Andrés", "Rojas", 28999876, "estudiante2026", [1]),
    ("Lucía", "Paredes", 17444111, "docente2026", [2]),
    ("Ricardo", "Blanco", 29111222, "estudiante2026", [1]),
    ("Elena", "Suárez", 20333444, "docente2026", [2]),
    ("Mateo", "Vargas", 29666777, "estudiante2026", [1]),
    ("Isabella", "Navarro", 29222333, "estudiante2026", [1]),
    ("Javier", "Rivas", 16888999, "docente2026", [2]),
    ("Paola", "Acosta", 29000111, "estudiante2026", [1]),
    ("Santiago", "Medina", 29555444, "estudiante2026", [1]),
    ("Victoria", "Cabrera", 21777888, "admin2026", [3])
]

for i, (nom, ape, _, _, _) in enumerate(usuarios_names, start=1):
    # Generar avatar circular estilizado
    avatar = Image.new("RGB", (240, 240), brand_navy)
    draw = ImageDraw.Draw(avatar)
    color_bg = colors[(i - 1) % len(colors)]
    draw.ellipse([10, 10, 230, 230], fill=color_bg, outline=(255, 255, 255), width=4)
    initials = f"{nom[0]}{ape[0]}"
    draw.text((95, 105), initials, fill=(255, 255, 255))
    dest = os.path.join(DATA_DIR, "usuarios", f"usuario_{i}.jpg")
    avatar.save(dest, "JPEG", quality=90)

print("Todas las imágenes fueron generadas exitosamente.")
