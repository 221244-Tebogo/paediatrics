<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title>Book your appointment</title>
  <!-- Mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- Font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
 
  <!-- Custom styles for this template -->
  <link href="css/index.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="style.css" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">

 <style>
    /* Custom CSS styles */
    body {
      margin: 0;
      padding: 0;
      background-image: url("images/pexels-gustavo-fring-7446987.jpg");
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      font-family: 'Poppins', sans-serif;
    }

    .header {
      text-align: center;
      padding: 50px 0;
      color: #fff;
    }

    .calendar {
      max-width: 1200px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .fc th {
      padding: 10px;
      background-color: #007bff;
      color: #fff;
    }

    .fc td {
      padding: 10px;
    }

    .fc-day:hover {
      background-color: #f2f2f2;
      cursor: pointer;
    }

    .fc-day-header {
      font-size: 18px;
    }

    .fc-day-number {
      font-size: 16px;
    }

    .fc-button {
      background-color: #007bff;
      border-color: #007bff;
    }

    .fc-button:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>
</head>

<body>
  <div class="header">
    <h1>Book Your Appointment</h1>
  </div>
  <div class="calendar">
    <div id="calendar"></div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
  <script>
    // Load the calendar when the DOM is ready
    $(document).ready(function () {
      $('#calendar').fullCalendar({
        // Set the calendar to show the current month and year
        defaultView: 'month',
        // Set the event source to the events.php script
        events: 'events.php',
        // Enable the mouse hover pop-up to show event details
        eventMouseover: function (event, jsEvent, view) {
          var tooltip = '<div class="tooltiptopicevent" style="width:auto;height:auto;background:#FF00CC;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">' + event.title + '</br>' + event.start + ' - ' + event.end + '</div>';
          $("body").append(tooltip);
          $(this).mouseover(function (e) {
            $(this).css('z-index', 10000);
            $('.tooltiptopicevent').fadeIn('500');
            $('.tooltiptopicevent').fadeTo('10', 1.9);
          }).mousemove(function (e) {
            $('.tooltiptopicevent').css('top', e.pageY + 10);
            $('.tooltiptopicevent').css('left', e.pageX + 20);
          });
        },

        // Hide the event details pop-up on mouse out
        eventMouseout: function (event, jsEvent, view) {
          $(this).css('z-index', 8);
          $('.tooltiptopicevent').remove();
        },

        // Set the header title format
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,basicWeek,basicDay'
        },
        // Add the "Book Appointment" button to the header
        customButtons: {
          bookAppointment: {
            text: 'Book Appointment',
            click: function () {
              // Redirect to the appointment form page
              window.location.href = 'appointment_form.php';
            }
          }
        },
        // Show the "Book Appointment" button in the header
        // You can add more header buttons if needed
        // Check the FullCalendar documentation for more customization options.
        header: {
          left: 'prev,next today bookAppointment',
          center: 'title',
          right: 'month,basicWeek,basicDay'
        },
      });
    });
  </script>
</body>

</html>
