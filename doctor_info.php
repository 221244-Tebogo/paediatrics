<?php
include "db_conn.php";

// Fetch all doctors from the database
$sql = "SELECT * FROM Doctors";
$doctorsResult = mysqli_query($conn, $sql);
$doctors = mysqli_fetch_all($doctorsResult, MYSQLI_ASSOC);

// Function to get doctor's free schedule from the database (replace with your implementation)
function getDoctorFreeSchedule($doctorId)
{
    // Replace this query with your own logic to fetch the doctor's free schedule from the database
    // The returned result should include the doctor's available time slots
    // For simplicity, I'm returning a static array here.
    return [
        "Monday" => "09:00 AM - 12:00 PM",
        "Tuesday" => "02:00 PM - 05:00 PM",
        "Wednesday" => "08:00 AM - 11:00 AM",
        "Thursday" => "Not Available",
        "Friday" => "01:00 PM - 04:00 PM",
    ];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Doctor Information</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;800&family=Poppins:wght@300;600;800&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/index.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet">
    <style>
        /* Your custom CSS styles go here */
        .doctor-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: 300px;
            border-radius: 5px;
        }

        .doctor-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .doctor-name {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .doctor-specialization {
            margin-bottom: 10px;
        }

        .doctor-availability {
            font-style: italic;
            font-size: 14px;
        }
    </style>
</head>

<body id="page-top">
    <div class="container">
        <!-- Loop through the list of doctors -->
        <?php foreach ($doctors as $doctor) : ?>
            <?php
            // Get the doctor's free schedule
            $doctorId = $doctor['id'];
            $freeSchedule = getDoctorFreeSchedule($doctorId);
            ?>
            <div class="doctor-card">
                <div class="doctor-image">
                    <img src="<?php echo $doctor['Image']; ?>" alt="Photo of <?php echo $doctor['Name']; ?>" width="100" height="100">
                </div>
                <div class="doctor-info">
                    <div class="doctor-name"><?php echo $doctor['Name']; ?></div>
                    <div class="doctor-specialization"><?php echo $doctor['Specialisation']; ?></div>
                    <div class="doctor-availability">
                        <strong>Availability:</strong>
                        <ul>
                            <?php foreach ($freeSchedule as $day => $schedule) : ?>
                                <li><?php echo $day . ': ' . $schedule; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

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
        <p>No doctor selected or doctor information not found.</p>
    <?php endif; ?>

    <!-- Right side: Doctor's Calendar -->
    <div class="calendar">
        <!-- FullCalendar -->
        <div id="calendar"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'agendaWeek', // Show agendaWeek as default view
                editable: false,
                selectable: false,
                events: {
                    url: 'events.php',
                    method: 'POST',
                    extraParams: {
                        doctor: '<?php echo isset($selectedDoctor) ? $selectedDoctor : ""; ?>'
                    }
                },
                businessHours: {
                    dow: [1, 2, 3, 4, 5, 6], // Monday - Saturday
                    start: '08:00', // Start time
                    end: '17:00' // End time
                }
            });
            calendar.render();
        });
    </script>
</body>

</html>
