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

   // Insert new appointment into the database
   $sql = "INSERT INTO `Appointments` (`first_name`, `last_name`, `dob`, `gender`, `image`) 
           VALUES ('$first_name', '$last_name', '$dob', '$gender', '$image')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: index.php?msg=New record created successfully");
      exit();
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}

// Fetch appointments from the database
$sql = "SELECT * FROM `Appointments`";
$result = mysqli_query($conn, $sql);

// Prepare an array to hold the appointment data
$appointments = array();

// Loop through the result set and format the data
while ($row = mysqli_fetch_assoc($result)) {
    $appointment = array(
        'title' => 'Booked', // Appointment title
        'start' => $row['dob'], // Appointment start date/time
        // Add any additional appointment properties you want to display
        // e.g., 'end' => $row['EndTime'], 'description' => $row['Description']
    );
    $appointments[] = $appointment;
}

// Convert the array to JSON for FullCalendar
$appointmentsJson = json_encode($appointments);
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: <?php echo $appointmentsJson; ?> // Pass the appointment data to FullCalendar
        });
        calendar.render();
      });

    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>
