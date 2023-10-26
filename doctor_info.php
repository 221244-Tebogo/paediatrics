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

// Check if a specific doctor has been selected
if (isset($_GET['doctor_id'])) {
    $selectedDoctorId = $_GET['doctor_id'];
    // Replace this query with your own logic to fetch the selected doctor's information from the database
    $sql_selected_doctor = "SELECT * FROM Doctors WHERE id = $selectedDoctorId";
    $selectedDoctorResult = mysqli_query($conn, $sql_selected_doctor);
    $doctorData = mysqli_fetch_assoc($selectedDoctorResult);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>Doctor Profile</title>
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

    .doctor-card {
        max-width: 300px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin: 10px;
        padding: 10px;
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

    .doctor-profile {
        max-width: 600px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin: 10px;
        padding: 10px;
        background-color: #fff;
    }

    .doctor-profile img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 10px;
    }
</style>
</head>
<body>
<div class="container">
    <header>
        <!--<img src="images/paediatrics-logo-full-colour.png" alt="Paediatrics Logo" class="paediatrics-logo-1">
        <div class="header-links">
            <a href="login.php" class="login-btn btn-primary btn">Practice Login</a>
        </div>-->
    </header>

    <div class="content">
        <div class="rectangle-35">
            <h1 class="heading-text">Book Health Appointments 24/7</h1>
            <div class="container">
                <!-- Loop through the list of doctors -->
                <?php foreach ($doctors as $doctor) : ?>
                    <div class="doctor-card">
                        <!-- Display the doctor's profile information -->
                        <img src="uploads/<?php echo $doctor['Image']; ?>" alt="Doctor Profile" class="doctor-image">
                        <h2 class="doctor-name"><?php echo $doctor['Name']; ?> <?php echo $doctor['Surname']; ?></h2>
                        <p class="doctor-specialization"><?php echo $doctor['Specialisation']; ?></p>
                        <!-- Display other doctor profile information as needed -->

                        <!-- "Book Appointment" link with the doctor's ID as a query parameter -->
                        <a href="appointment.php?doctor_id=<?php echo $doctor['id']; ?>" class="btn btn-primary">Book Appointment</a>
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
        
            <?php endif; ?>

            <!-- Right side: Doctor's Calendar -->
            <div class="calendar">
                <!-- FullCalendar -->
                <div id="calendar"></div>
            </div>
        </div>

        <footer>
            <div class="help-booking-online">
                NEED HELP BOOKING ONLINE? +27 (0) 10 648 9200 admin@paediatrics.co.za
            </div>
            <div class="footer">2023 All rights are reserved to Paediatrics Healthcare</div>
        </footer>
    </div>
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
