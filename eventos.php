<?php include 'componentes/header.php' ?>
  <h2>Eventos</h2>
  <div id="calendar"></div>

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
        events: [
          {
            title: 'Evento de ejemplo',
            start: '2024-10-20'
          },
          {
            title: 'Otro evento',
            start: '2024-10-22'
          }
        ],
        eventClick: function(info) {
          alert(info.event.title + "\n" + info.event.start.toLocaleDateString());
        }
      });

      calendar.render();
    });
  </script>

