<?php
include "db_conn.php";

// Check if the doctor_id parameter is set in the URL
if (isset($_GET['doctor_id'])) {
    $selectedDoctorId = $_GET['doctor_id'];
    // Replace this query with your own logic to fetch the selected doctor's information from the database
    $sql_selected_doctor = "SELECT * FROM Doctors WHERE id = $selectedDoctorId";
    $selectedDoctorResult = mysqli_query($conn, $sql_selected_doctor);
    $doctorData = mysqli_fetch_assoc($selectedDoctorResult);
} else {
    // Redirect back to doctor_info.php if no doctor is selected
    
    header("Location: doctor_info.php");
    exit();

    
}

function build_calendar($month, $year)
{
    $mysqli = new mysqli('localhost', 'root', '', 'paediatrics');
    $stmt = $mysqli->prepare("SELECT * FROM appointment WHERE MONTH(AppointmentDate) = ? AND YEAR(AppointmentDate) = ?");
    $stmt->bind_param('ss', $month, $year);
    $bookings = array();
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row['AppointmentDate'];
            }
        }
        $stmt->close();
    }

    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];

    $datetoday = date('Y-m-d');

    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<h2 class='text-center'>$monthName $year</h2>";
    $calendar .= "<div class='text-center'>";
    $calendar .= "<a class='btn btn-xs btn-success' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "'>Previous Month</a> ";
    $calendar .= " <a class='btn btn-xs btn-danger' href='?month=" . date('m') . "&year=" . date('Y') . "'>Current Month</a> ";
    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'>Next Month</a></div><br>";

    $calendar .= "<tr>";
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

    $currentDay = 1;
    $calendar .= "</tr><tr>";

    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        $dayname = strtolower(date('l', strtotime($date)));
        $eventNum = 0;
        $today = $date == date('Y-m-d') ? "today" : "";

        if ($date < date('Y-m-d')) {
            $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' disabled>N/A</button>";
        } elseif (in_array($date, $bookings)) {
            $calendar .= "<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'> <span class='glyphicon glyphicon-lock'></span> Already Booked</button>";
        } else {
            $selectedDoctorId = $_GET['doctor_id'];
            $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='appointment_form.php?date=" . $date . "?doctorID=". $selectedDoctorId ."' class='btn btn-success btn-xs'> <span class='glyphicon glyphicon-ok'></span> Book Now</a>";
        }

        $calendar .= "</td>";
        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($l = 0; $l < $remainingDays; $l++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";
    return $calendar;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Appointment Booking</title>
    <!-- Mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/index.css" rel="stylesheet">
    <!--  calendar JavaScript files -->
    <script src="path_to_jquery.min.js"></script>
    <script src="path_to_moment.min.js"></script>
    <script src="path_to_your_calendar_plugin.js"></script>

    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet">
    <style>
        /* Your custom CSS styles go here */
        body {
            margin: 0;
            padding: 0;
            background-image: url("images/pexels-gustavo-fring-7446987.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }

        .doctor-profile {
            /* Add your styles here for the doctor's profile container */
            /* For example: width, border, padding, etc. */
            max-width: 400px;
            margin-right: 20px;
        }

        .doctor-profile img {
            /* Add your styles here for the doctor's profile image */
            /* For example: width, height, border-radius, etc. */
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .calendar {
            /* Add your styles here for the calendar container */
    
  max-width: 100%;
  height: 300px; /* Adjust the height as per your requirements */
  margin: 0 auto;
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <img src="images/paediatrics-logo-full-colour.png" alt="Paediatrics Logo" class="paediatrics-logo-1">
            <div class="header-links">
                <a href="login.php" class="login-btn btn-primary btn">Practice Login</a>
            </div>
        </header>


     



        <div class="content">
            <!-- Left side: Doctor's Profile -->
            <?php if (isset($doctorData)) : ?>
                <div class="doctor-profile">
                    <h2>Doctor Information</h2>
                    <p><strong>Name:</strong> <?php echo $doctorData['Name']; ?></p>
                    <p><strong>Surname:</strong> <?php echo $doctorData['Surname']; ?></p>
                    <p><strong>Age:</strong> <?php echo $doctorData['Age']; ?></p>
                    <p><strong>Gender:</strong> <?php echo $doctorData['Gender']; ?></p>
                    <p><strong>Phone Number:</strong> <?php echo $doctorData['PhoneNumber']; ?></p>
                    <p><strong>Specialization:</strong> <?php echo $doctorData['Specialization']; ?></p>
                    <p><strong>Doctor Profile:</strong> <?php echo $doctorData['DoctorProfile']; ?></p>
                    <p><strong>Room:</strong> <?php echo $doctorData['Room']; ?></p>

                    <!-- Display the doctor's profile image -->
                    <?php
                    $imagePath = "uploads/" . $doctorData['Image'];
                    if (file_exists($imagePath)) {
                        echo "<img src='" . $imagePath . "' alt='Doctor Profile'>";
                    } else {
                        echo "Profile image not available.";
                    }
                    ?>
                </div>
            <?php else : ?>
                <!-- Display a message if no doctor is selected -->
                <p>No doctor selected. Please go back to <a href="doctor_info.php">Doctor Info</a> page and select a doctor.</p>
            <?php endif; ?>


           <!-- Right side: Calendar -->
        <div class="calendar">
            <div id="booking-calendar" class="jquery-plugincreator-booking">
                <!-- Replace this div with the actual calendar container provided by your calendar plugin -->
                <div id="practitioner-calendar" class="booking-calendar">
                <div class="content">
            <!-- Left side: Doctor's Profile -->
            <?php if (isset($doctorData)) : ?>
                <!-- ... Your doctor profile content goes here ... -->
            <?php else : ?>
                <!-- ... Your message for no selected doctor goes here ... -->
            <?php endif; ?>

               <!-- Right side: Calendar -->
               <div class="container">
        <!--<h1>Appointment Booking System</h1>-->
        <?php
        // Get the month and year from the query parameters
        if (isset($_GET['month']) && isset($_GET['year'])) {
            $month = $_GET['month'];
            $year = $_GET['year'];
        } else {
            $month = date('m');
            $year = date('Y');
        }

        // Call the build_calendar function with the provided month and year
        echo build_calendar($month, $year);
        ?>
    </div>
        </div>
                </div>
            </div>
        </div>
    </div>

        <footer>
            <div class="help-booking-online">
                NEED HELP BOOKING ONLINE? +27 (0) 10 648 9200 admin@paediatrics.co.za
            </div>
            <div class="footer">2023 All rights are reserved to Paediatrics Healthcare</div>
        </footer>
    </div>
    
    <!-- calendar plugin  -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sample event data for the calendar
            const eventData = [
                { date: '2023-07-24', time: '09:00 AM' },
                { date: '2023-07-25', time: '11:30 AM' },
                // Add more event data as needed
            ];

            // Initialize your calendar plugin with the appropriate configuration
            $('#booking-calendar').yourCalendarPlugin({
                // Your configuration options here, like event data, business hours, etc.
                eventData: eventData,
                onTimeSlotClick: function(selectedDate, selectedTime) {
                    // Sample function to handle the time slot click event
                    // You can modify this function to capture the selected date and time
                    document.getElementById('selected-date').value = selectedDate;
                    document.getElementById('selected-time').value = selectedTime;
                }
            });
        });
    </script>

</body>

</html>
