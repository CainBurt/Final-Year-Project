<?php
include_once 'navbar.php';
// include_once 'scripts/projects.php';
?>
<link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
<script src="fullcalendar/lib/jquery.min.js"></script>
<script src="fullcalendar/lib/moment.min.js"></script>
<script src="fullcalendar/fullcalendar.min.js"></script>
<!-- <script src="js/calendar.js"></script> -->

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Calendar</h1>
</div>
<div class="response"></div>
<div id='calendar'></div>

<script>
    $(document).ready(function() {
        var calendar = $("#calendar").fullCalendar({
            editable: true,
            events: "/fyp/scripts/getTasksForCal.php",
            displayEventTime: false,
            selectable: true,
            selectHelper: true,
            // events: [{
            //     title: 'Front-End Conference',
            //     start: '2022-04-01',
            //     end: '2022-04-02',
            //     textColor: 'rgba(255,255,255,.5)',
            //     backgroundColor: 'rgba(241,155,55.5)'
            // }, ]
        })
    })
</script>


<?php include_once 'footer.php' ?>