<?php
include "db_conn.php";

// Get patient details from the appointment form
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// Insert patient details into the `Patient` table
$sql = "INSERT INTO `Patient`(`Name`, `Surname`, `Age`, `Gender`, `email`, `Image`) 
        VALUES ('$first_name', '$last_name', 'N/A', 'N/A', '$email', 'N/A')";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}

// Get the newly inserted patient ID
$patient_id = mysqli_insert_id($conn);

// Get the selected doctor and appointment date from the URL parameters
$doctor_id = $_GET['doctor'];
$appointment_date = $_GET['date'];

// Insert appointment details into the `Appointment` table
$sql = "INSERT INTO `Appointment`(`TypeOfAppointment`, `Patient`, `Doctor`, `Receptionist`, `AppointmentNo`, `AppointmentDate`, `AppointmentReason`, `image`, `PatientProfile`)
        VALUES ('CONSULTATION', '$patient_id', '$doctor_id', 'N/A', 'N/A', '$appointment_date', 'N/A', 'N/A', 'N/A')";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Appointment successfully created!";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
