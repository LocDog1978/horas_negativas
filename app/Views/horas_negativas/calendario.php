<?php $this->extend('template/dgti_template'); ?>
<?php $this->section('content'); ?>

<script src='<?php echo  base_url('assets/fullcalendar/index.global.min.js'); ?>'></script>

<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: 'pt-br',
          selectable: true,

          dateClick: function(info) {
                // alert('Date: ' + info.dateStr);
                // alert('Resource ID: ' + info.resource.id);
                window.location.href = "&teste=" + info.dateStr;
            }
          
        });
        calendar.render();
      });

    </script>

    <div id='calendar'></div>

    <?php $this->endSection('content'); ?>