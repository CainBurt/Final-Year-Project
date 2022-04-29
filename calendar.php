<?php
include_once 'navbar.php';
// include_once 'scripts/projects.php';
?>
<link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
<script src="fullcalendar/lib/jquery.min.js"></script>
<script src="fullcalendar/lib/moment.min.js"></script>
<script src="fullcalendar/fullcalendar.min.js"></script>
<!-- <script src="js/calendar.js"></script>-->

<!-------- Full calendar cdn ------------->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> -->


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Calendar</h1>
</div>
<div class="response"></div>
<div class="container">
    <div id='calendar'></div>
</div>
<script>
    $(document).ready(function() {
        var calendar = $("#calendar").fullCalendar({
            editable: true,
            events: "/fyp/scripts/getTasksForCal.php",
            displayEventTime: false,
            selectable: true,
            selectHelper: true,
            eventColor: '#B20D30',
            eventTextColor: 'white',
            // update task dates when task is resized
            eventResize: function(event) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                var title = event.title;
                var id = event.id;

                $.ajax({
                    url: '/fyp/scripts/editTaskForCal.php',
                    method: 'POST',
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id
                    },
                    success: function(data) {
                        calendar.fullCalendar("refetchEvents");
                        alert("Update completed")
                    }
                })
            },
            // changes task date when drag and drop task
            eventDrop: function(event) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                var title = event.title;
                var id = event.id;

                $.ajax({
                    url: '/fyp/scripts/editTaskForCal.php',
                    method: 'POST',
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id
                    },
                    success: function(data) {
                        calendar.fullCalendar("refetchEvents");
                        alert("Update completed")
                    }
                })
            }
        })
    })
</script>


<?php include_once 'footer.php' ?>