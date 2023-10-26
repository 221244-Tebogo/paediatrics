<?php
include "db_conn.php"; // Include the database connection file

// Handle the appointment booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Get the selected doctor, patient name, date, and time
        $doctorId = $_POST['doctor_id'];
        $patientName = $_POST['patient_name'];
        $date = $_POST['date'];

        // Validate the patient name is not empty
        if (empty($patientName)) {
            echo "Please enter your name.";
        } else {
            // Insert the appointment into the database
            $sql = "INSERT INTO Appointment (TypeOfAppointment, Patient, AppointmentDate, Doctors) 
                    VALUES ('General Checkup', '$patientName', '$date', '$doctorId')";
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
<head>
    <!-- ... Your head section ... -->
</head>
<body>
    <div class="container">
        <h3>Book your appointment now</h3><br>
        <form id="appointment-form" method="POST" action="">
            <input type="text" name="doctor_id" value="<?php echo htmlspecialchars($_GET['doctor_id']); ?>">
            <input type="date" name="date" value="<?php echo htmlspecialchars($_GET['date']); ?>">
            
            <label for="patient-name">Patient Name *</label>
            <input type="text" name="patient_name" id="patient-name" required>
            
            <input type="submit" name="submit" value="Book Appointment">
        </form>
    </div>
</body>
</html>
