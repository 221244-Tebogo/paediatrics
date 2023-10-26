<?php
include "db_conn.php"; // Include the database connection file

// Retrieve the list of doctors from the database
$sql = "SELECT * FROM Doctors";
$result = mysqli_query($conn, $sql);

// Handle the appointment booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Get the selected doctor, patient name, date, and time
        $doctor = $_POST['doctor'];
        $patientName = $_POST['patient_name'];
        $date = $_POST['date'];
        // $time = $_POST['time'];
        $selectedDoctorId = $_GET['doctor_id'];
        // $selectedDoctorId = 2;


        // Validate the patient name is not empty
        if (empty($patientName)) {
            echo "Please enter your name.";
        } else {
            // Insert the appointment into the database
            $sql = "INSERT INTO Appointment (AppointmentID, Doctors, TypeOfAppointment, Patient, AppointmentDate ) 
                    VALUES (null, '$selectedDoctorId', 'General Checkup', '$patientName', '$date')";
            $result = mysqli_query($conn, $sql);

            // Check if the query was successful
            if ($result) {
                echo "Appointment booked successfully!";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
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

<body>
    <div class="container">
        <h3>Book your appointment now</h3><br>
        <form id="appointment-form" method="POST" action="appointment_form.php">
            <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
            <input type="hidden" name="time" value="<?php echo htmlspecialchars($time); ?>">

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

            
            <label for="patient-name">Patient Name *</label>
            <input type="text" name="patient_name" id="patient-name" required>

            <!-- Add other form fields as needed -->

            <input type="submit" name="submit" value="Book Appointment">
        </form>
    </div>
</body>
</html>
