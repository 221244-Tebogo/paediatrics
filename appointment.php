<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $dob = date('Y-m-d', strtotime($_POST['date_of_birth']));
   $gender = $_POST['gender'];
   $image = $_FILES['image']['name'];

   // Upload image file
   $target_dir = "uploads/";
   $target_file = $target_dir . basename($_FILES["image"]["name"]);
   move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

   // Sanitize and escape input values
   $first_name = mysqli_real_escape_string($conn, $first_name);
   $last_name = mysqli_real_escape_string($conn, $last_name);
   $doctor = mysqli_real_escape_string($conn, $doctor);
   $appointment = mysqli_real_escape_string($conn, $appointment );
   $date = mysqli_real_escape_string($conn, $date);
   $receptionist = mysqli_real_escape_string($conn, $receptionist);
   $appointment_no = mysqli_real_escape_string($conn, $appointment_no);
   $patient = mysqli_real_escape_string($conn, $patient);
   $reason = mysqli_real_escape_string($conn, $reason);
   

   // ... sanitize other input fields
//add variables - 
   $sql = "INSERT INTO `Appointment`(`AppointmentID`, `PatientID`, `DoctorID`, `ReceptionistID`, `AppointmentNo`, `AppointmentDate`, `AppointmentReason`, `image`, `PatientProfile`) 
   VALUES (NULL, '$first_name', '$last_name', '$doctor', '$receptionist', '$date','$appointment_no', '$reason', '$image', '$patient')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: index.php?msg=New record created successfully");
      exit();
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css' rel='stylesheet' />
    <!-- Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/index.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js'></script>
    <script>
      // Calendar initialization and configuration
      $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'agendaWeek' // Set the header to only display week view
          },
          defaultView: 'agendaWeek', // Set the default view to week view
          selectable: true,
          selectHelper: true,
          select: function(start, end) {
            // Handle date selection here
            var startDate = moment(start).format('YYYY-MM-DD');
            var endDate = moment(end).format('YYYY-MM-DD');

            // Redirect to appointment booking page with selected dates
            window.location.href = 'appointment_booking.php?start=' + startDate + '&end=' + endDate;
          },
          editable: true,
          eventResize: function(event, delta, revertFunc) {
            // Handle event resizing here
          },
          eventDrop: function(event, delta, revertFunc) {
            // Handle event dragging here
          }
        });
      });
    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>


