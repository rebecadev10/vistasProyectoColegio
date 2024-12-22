<?php include 'componentes/header.php'; ?>
<h2>Eventos</h2>

<!-- Calendario -->
<div id="calendar" class="calendario"></div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@3.10.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@3.10.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText: { 
            today: 'Hoy', 
            month: 'Mes', 
            week: 'Semana', 
            day: 'Día', 
            list: 'Agenda' 
        },
        events: function(info, successCallback, failureCallback) {
            fetch('controlador/evento.php?op=listarCalendario')  // URL correcta para tu controlador
                .then(response => response.json())
                .then(data => {
                  console.log(data);
                    const events = data.aaData.map(evento => ({
                        id: evento.id,
                        title: evento.title,
                        start: evento.start,
                        end: evento.end,
                        department: evento.department,
                        image: evento.image // URL de la imagen
                    }));
                    successCallback(events);
                })
                .catch(error => {
                    console.error('Error al cargar eventos:', error);
                    failureCallback(error);
                });
        },
        eventClick: function(info) {
            // Mostrar SweetAlert con los detalles del evento
            Swal.fire({
                title: info.event.title,
                html: `
                    <img src="${info.event.extendedProps.image}" alt="Imagen del evento" style="max-width: 100%; border-radius: 8px; margin-bottom: 15px;">
                    <p><strong>Departamento:</strong> ${info.event.extendedProps.department}</p>
                    <p><strong>Fecha Inicio:</strong> ${info.event.start.toLocaleString()}</p>
                    <p><strong>Fecha Fin:</strong> ${info.event.end ? info.event.end.toLocaleString() : 'Sin fecha de fin'}</p>
                `,
                icon: 'info',
                confirmButtonText: 'Cerrar'
            });
        }
    });

    calendar.render();
});
</script>

<?php include 'componentes/footer.php'; ?>
