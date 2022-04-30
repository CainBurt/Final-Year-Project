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
    <button class="btn rounded-pill red new-project-btn" data-toggle="modal" data-target="#projectModal"><span class="bi bi-plus white">New Task</span></button>
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
            },
            // tooltip on task hover
            eventMouseover: function(calEvent, jsEvent) {
                if (calEvent.user == "null" || calEvent.user == " ") {
                    calEvent.user = "<i>No One</i>";
                }
                var tooltip = '<div class="tooltipevent" style="width:250px;height:20px;background:#ccc;position:absolute;z-index:10001;">' + "Assigned User Is: " + calEvent.user + '</div>';
                var $tooltip = $(tooltip).appendTo('body');

                $(this).mouseover(function(e) {
                    $(this).css('z-index', 10000);
                    $tooltip.fadeIn('500');
                    $tooltip.fadeTo('10', 1.9);
                }).mousemove(function(e) {
                    $tooltip.css('top', e.pageY + 10);
                    $tooltip.css('left', e.pageX + 20);
                });
            },

            eventMouseout: function(calEvent, jsEvent) {
                $(this).css('z-index', 8);
                $('.tooltipevent').remove();
            },
        })
    })
</script>


<?php include_once 'footer.php' ?>