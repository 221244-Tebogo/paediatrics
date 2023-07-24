<?php
include "db_conn.php";

// Array of race options
$race_options = array("White", "Black", "Indian", "Coloured", "Asian");

if (isset($_POST["submit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = date('Y-m-d', strtotime($_POST['date_of_birth']));
    $identity_number = $_POST['identity_number'];
    $gender = $_POST['gender'];
    $race = $_POST['race'];
    $role = $_POST['role'];

    // Handle file upload
    $image = $_FILES['image']['name']; // Get the name of the uploaded file
    $target_directory = "image/uploads/"; // Specify the directory where the file will be stored
    $target_file = $target_directory . basename($image); // Specify the path of the uploaded file on the server

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // File upload successful
        $sql = "INSERT INTO `appointment`(`id`, `first_name`, `last_name`, `dob`, `identity_number`, `gender`, `race`, `image`, `role`) 
               VALUES (NULL, '$first_name', '$last_name', '$dob', '$identity_number', '$gender', '$race', '$image', '$role')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: index.php?msg=New record created successfully");
            exit();
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Booking System</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointment Booking System</h1>
        <?php
        function build_calendar($month, $year) {
            $mysqli = new mysqli('localhost', 'root', '', 'paediatrics');
            $stmt = $mysqli->prepare("SELECT * FROM appointment WHERE MONTH(date) = ? AND YEAR(date) = ?");
            $stmt->bind_param('ss', $month, $year);
            $bookings = array();
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $bookings[] = $row['date'];
                    }

                    $stmt->close();
                }
            }

            $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
            $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
            $numberDays = date('t', $firstDayOfMonth);
            $dateComponents = getdate($firstDayOfMonth);
            $monthName = $dateComponents['month'];
            $dayOfWeek = $dateComponents['wday'];

            $datetoday = date('Y-m-d');

            $calendar = "<table class='table table-bordered'>";
            $calendar .= "<h2 class='text-center'>$monthName $year</h2>";
            $calendar .= "<div class='text-center'>";
            $calendar .= "<a class='btn btn-xs btn-success' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
            $calendar .= " <a class='btn btn-xs btn-danger' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
            $calendar .= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></div><br>";

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
                    $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=".$date."' class='btn btn-success btn-xs'> <span class='glyphicon glyphicon-ok'></span> Book Now</a>";
                }

                $calendar .="</td>";
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
