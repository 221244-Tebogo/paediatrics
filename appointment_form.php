<?php
include "db_conn.php"; // Include the database connection file

// Retrieve the list of doctors from the database
$sql = "SELECT * FROM Doctors";
$result = mysqli_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['date']) && isset($_GET['time'])) {
        $date = $_GET['date'];
        $time = $_GET['time'];
    } else {
        // Handle invalid or missing parameters, redirect or show an error message.
    }
}

// Handle the appointment booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Get the selected doctor, patient name, date, and time
        $doctor = $_POST['doctor'];
        $patientName = $_POST['patient_name'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        // Insert the appointment into the database
        // Assuming you have a table `Appointment` to store booked appointments
        $sql = "INSERT INTO Appointment (DoctorID, PatientName, AppointmentDate, AppointmentTime) VALUES ('$doctor', '$patientName', '$date', '$time')";
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8' />
  <title>Appointment Booking</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h1>Book your appointment now</h1>
  
  <form id="appointment-form" method="POST" action="process_appointment.php">
    <label for="selected-date">Select a date for your appointment:</label>
    <input type="date" name="selected_date" id="selected-date" required>
    
    <label for="first-name">First name *</label>
    <input type="text" name="first_name" id="first-name" required>
    
    <label for="last-name">Last name *</label>
    <input type="text" name="last_name" id="last-name" required>
    
    <label for="phone">Phone *</label>
    <input type="tel" name="phone" id="phone" required>
    
    <label for="email">Email address *</label>
    <input type="email" name="email" id="email" required placeholder="mail@domain.com">
    
    <label for="type-of-appointment">Type of Appointment *</label>
    <select name="type_of_appointment" id="type-of-appointment" required>
      <option value="" selected>Select a Type of Appointment</option>
      <option value="CONSULTATION WITHOUT PROCEDURE">CONSULTATION WITHOUT PROCEDURE</option>
      <option value="CONSULTATION WITH PROCEDURE">CONSULTATION WITH PROCEDURE</option>
      <!-- Add other appointment types as needed -->
    </select>
    
    <label for="payment-method">Payment Method *</label>
    <select name="payment_method" id="payment-method" required>
      <option value="" selected>Select a Payment Method</option>
      <option value="Voucher">Voucher</option>
      <option value="Medical Aid">Medical Aid</option>
      <option value="Private">Private</option>
      <option value="Insurance">Insurance</option>
      <!-- Add other payment methods as needed -->
    </select>
    
    <label for="existing-patient">Have you visited this practice before?</label>
    <input type="checkbox" name="existing_patient" id="existing-patient">
    
    <label for="accept-terms">Do you accept our Terms & Conditions and privacy policy? *</label>
    <input type="checkbox" name="accept_terms" id="accept-terms" required>
    
    <input type="submit" value="Book Appointment">
  </form>
</body>
</html>

