<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paediatrics";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $patientID = $_POST["patientID"];
    $doctorID = $_POST["doctorID"];
    $appointmentDate = $_POST["appointmentDate"];
    $appointmentReason = $_POST["appointmentReason"];
    $image = $_POST["image"];
    $patientProfile = $_POST["patientProfile"];

    // Check if the doctor already has an appointment on the selected date
    $checkQuery = "SELECT * FROM Appointment WHERE DoctorID = $doctorID AND AppointmentDate = '$appointmentDate'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "Sorry, the doctor already has an appointment on the selected date. Please choose a different date.";
    } else {
        // Generate a unique appointment number
        $appointmentNo = generateAppointmentNumber();

        // Insert the appointment into the database
        $insertQuery = "INSERT INTO Appointment (PatientID, DoctorID, ReceptionistID, AppointmentNo, AppointmentDate, AppointmentReason, Image, PatientProfile)
                        VALUES ('$patientID', '$doctorID', 1, '$appointmentNo', '$appointmentDate', '$appointmentReason', '$image', '$patientProfile')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "Appointment scheduled successfully.";
        } else {
            echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
}

// Function to generate a unique appointment number
function generateAppointmentNumber() {
    // Generate a random number between 100000 and 999999
    $appointmentNo = mt_rand(100000, 999999);

    // Check if the appointment number already exists in the database
    global $conn;
    $checkQuery = "SELECT * FROM Appointment WHERE AppointmentNo = $appointmentNo";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // If the appointment number exists, generate a new one recursively
        return generateAppointmentNumber();
    } else {
        // If the appointment number is unique, return it
        return $appointmentNo;
    }
}
?>

<!-- HTML form for scheduling an appointment -->
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="patientID">Patient Name:</label>
    <input type="text" name="patientID" required><br>

    <label for="doctorID">Doctor Name:</label>
    <input type="text" name="doctorID" required><br>

    <label for="appointmentDate">Appointment Date:</label>
    <input type="date" name="appointmentDate" required><br>

    <label for="image">Image:</label>
    <input type="file" name="image"><br>

    <label for="patientProfile">Patient Profile:</label>
    <textarea name="patientProfile" required></textarea><br>

    <input type="submit" value="Schedule Appointment">
</form>

</body>
</html>
