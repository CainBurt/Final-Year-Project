<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="fullcalendar/fullcalendar.min.js"></script>
    <script src="js/calendar.js"></script>
</head>


</html>

<?php
include_once 'navbar.php';
// include_once 'scripts/projects.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Calendar</h1>
</div>
<div class="response"></div>
<div id='calendar'></div>
<?php include_once 'footer.php' ?>