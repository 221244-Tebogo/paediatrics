<?php
// Check if the date is provided in the query parameters
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    
    // Perform the necessary steps to insert the booked date into the database
    $mysqli = new mysqli('localhost', 'root', '', 'bookingsysystem');
    $stmt = $mysqli->prepare("INSERT INTO bookings_record (DATE) VALUES (?)");
    $stmt->bind_param('s', $date);
    
    if ($stmt->execute()) {
        echo "Booking successful!";
    } else {
        echo "Booking failed. Please try again.";
    }
    
    $stmt->close();
} else {
    echo "Invalid date.";
}
?>
