<?php
include "db_conn.php"; // Include the database connection file

// Retrieve events from the database
$sql = "SELECT * FROM Appointment";
$result = mysqli_query($conn, $sql);

// Create an array to hold events data
$events = array();

// Loop through the result set and add events to the array
while ($row = mysqli_fetch_assoc($result)) {
    $event = array();
    $event['title'] = $row['PatientName'];
    $event['start'] = $row['AppointmentDate'] . 'T' . $row['AppointmentTime'];
    $event['end'] = $row['AppointmentDate'] . 'T' . $row['AppointmentTime'];
    $events[] = $event;
}

// Output JSON formatted data
echo json_encode($events);
?>
