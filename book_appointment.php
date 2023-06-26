<?php
include "db_conn.php";

// Handle appointment booking form submission
if (isset($_POST['submit'])) {
    $doctor_id = $_POST['doctor_id'];
    $patient_name = $_POST['patient_name'];
    $appointment_date = $_POST['appointment_date'];

    // Insert the appointment into the database
    $sql = "INSERT INTO appointments (doctor_id, patient_name, appointment_date) VALUES ('$doctor_id', '$patient_name', '$appointment_date')";

    if (mysqli_query($conn, $sql)) {
        echo "Appointment booked successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
</head>
<body>
    <h1>Book Appointment</h1>
    <form method="POST" action="">
        <label for="doctor_id">Doctor:</label>
        <select name="doctor_id" id="doctor_id">
            <option value="1">Dr. John Doe</option>
            <option value="2">Dr. Jane Smith</option>
            <!-- Add more doctor options as needed -->
        </select>
        <br>
        <label for="patient_name">Patient Name:</label>
        <input type="text" name="patient_name" id="patient_name" required>
        <br>
        <label for="appointment_date">Appointment Date:</label>
        <input type="date" name="appointment_date" id="appointment_date" required>
        <br>
        <input type="submit" name="submit" value="Book Appointment">
    </form>
</body>
</html>
