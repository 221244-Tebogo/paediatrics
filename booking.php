<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['submit'])) {
    // Get the selected doctor
    $doctor = $_POST['doctor'];

    // Insert the appointment into the database
    $sql = "INSERT INTO Appointment (DoctorID, AppointmentDate) VALUES ('$doctor', NOW())";
    $result = mysqli_query($conn, $sql);
    
    // Check if the query was successful
    if ($result) {
      echo "Appointment booked successfully!";
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
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
            $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=" . $date . "' class='btn btn-success btn-xs'> <span class='glyphicon glyphicon-ok'></span> Book Now</a>";
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
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Booking</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;800&family=Poppins:wght@300;600;800&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet">
    <!--<title>Appointment Booking System</title>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .header {
            background-color: #337ab7;
            color: #fff;
        }

        .empty {
            background-color: #eee;
        }

        .today {
            background-color: #337ab7;
            color: #fff;
        }

        .calendar {
  max-width: 100%;
  height: 300px; /* Adjust the height as per your requirements */
  margin: 0 auto;
}

    </style>
</head>

<body>
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
</body>

</html>
