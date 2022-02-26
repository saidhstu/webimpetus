<?php require_once (APPPATH.'Views/fullcalendar/list-title.php'); ?>
<script>

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap',
        height: 'auto',
        expandRows: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialView: 'dayGridMonth',
        initialDate: '<?php echo render_date(time(), "", "Y-m-d"); ?>',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        selectable: true,
        nowIndicator: true,
        dayMaxEvents: true, // allow "more" link when too many events
        events: [
            <?php foreach ($timeslips as $eachSlip) {
                $startDate = strtotime($eachSlip['slip_start_date']);
                $endDate = strtotime($eachSlip['slip_end_date']);
                $splitted = explode(" ", $eachSlip['slip_timer_started']);
                $titleStartDateHour = getTitleHour($eachSlip['slip_timer_started']);
                $titleEndDateHour = getTitleHour($eachSlip['slip_timer_end']);
                echo "{
                    id: '" . $eachSlip['id'] . "',
                    title: '". "{" . render_date($startDate, "", "d-M") . " " . $titleStartDateHour . " - " . render_date($endDate, "", "d-M") . " " . $titleEndDateHour . "} " . $eachSlip['employee_name'] . ": ". $eachSlip['task_name'] ."',
                    start: '" . render_date($startDate, "", "Y-m-d") . "',
                    end: '" . render_date($endDate, "", "Y-m-d") . "',
                    url: '" . base_url('/' . $tableName . '/edit/' . $eachSlip['uuid']) . "',
                },";
            } ?>
        ]
    });

    calendar.render();
});

</script>

<div id='calendar'></div>
<?php require_once (APPPATH.'Views/common/footer.php'); ?>