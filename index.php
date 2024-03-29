<?php
include "db_conn.php"; // Include the database connection file

// Retrieve the list of doctors from the database
$sql = "SELECT * FROM Doctors";
$result = mysqli_query($conn, $sql);

// Fetch distinct specializations from the "Doctors" table
$sql_specializations = "SELECT DISTINCT Specialisation FROM Doctors";
$result_specializations = mysqli_query($conn, $sql_specializations);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Book your appointment</title>
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
  /* Custom CSS styles */
  body {
    margin: 0;
    padding: 0;
    background-image: url("images/pexels-gustavo-fring-7446987.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  .container {
    position: relative;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .content {
    flex: 1;
  }

  .frame-268 {
    align-items: flex-end;
    border: 1px none;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    flex: 1;
    position: relative;
  }

  .overlap-group {
    height: 100%;
    position: relative;
  }

  .footer {
    position: fixed;
    text-align: center;
    background-color: #49443c;
    bottom: 0;
    width: 100%;
    color: #fff;
    padding: 10px;
    font-weight: bold;
  }

  .paediatrics-logo-1 {
    position: absolute;
    top: 40px;
    left: 51px;
    width: 267px;
    height: 113px;
  }

  .help-booking-online {
    background-color: #545557;
    color: #fff;
    padding: 40px;
    text-align: center;
    font-weight: lighter;
    font-size: 20px;
    margin-bottom: 10px;
    width: 100%;
    box-sizing: border-box;
  }

  .rectangle-35 {
    background-color: #eaeff1;
    height: 444px;
    left: 51px;
    position: absolute;
    top: 299px;
    width: 800px;
    padding: 20px;
  }
  
  .header-links {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
  }

  .heading-text {
    margin-top: 0;
    line-height: 1.5;
    text-align: left;
  }
  
  .login-btn {
    padding: 10px 25px;
    font-size: 16px;
    background-color: #337ab7;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
  }

  .login-btn:hover {
    background-color: #286090;
  }

  .footer {
    padding: 10px;
  }
</style>
</head>

<body>
<div class="container">
  <header>
    <img src="images/paediatrics-logo-full-colour.png" alt="Paediatrics Logo" class="paediatrics-logo-1">
    <div class="header-links">
      <a href="login.php" class="login-btn btn-primary btn">Practice Login</a>
    </div>
  </header>

  <div class="content">
    <div class="rectangle-35">
        <h1 class="heading-text">Book Health Appointments 24/7</h1>
        <div class="doctors-on-call-drop poppins-bold-cerulean-24px">
            <form action="doctor_info.php" method="GET">
                <!-- Dropdown - Specializations -->
                <label for="specialization">Select a Doctors:</label><br>
                <select name="specialisation" id="specialisation">
                    <option value="">Doctor list</option>
                    <?php
                   // Display the list of distinct specializations in the dropdown menu
    while ($row = mysqli_fetch_assoc($result_specializations)) {
      echo '<option value="' . $row['Specialisation'] . '">' . $row['Specialisation'] . '</option>';
  }
  ?>
                    ?>
                </select>
                <button type="submit" class="login-btn btn-primary btn" name="submit">Book Appointment</button>
            </form>
        </div>
    </div>
</div>

  <footer>
    <div class="help-booking-online">
      NEED HELP BOOKING ONLINE? +27 (0) 10 648 9200 admin@paediatrics.co.za
    </div>
    <div class="footer">2023 All rights are reserved to Paediatrics Healthcare</div>
  </footer>
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
      defaultView: 'month',
      editable: true,
      selectable: true,
      events: "events.php", // Changed to load events from events.php
      dateClick: function(info) {
        // Create a new appointment on date click
        var title = prompt('Enter appointment title:');
        if (title) {
          calendar.addEvent({
            title: title,
            start: info.dateStr
          });
        }
      },
      eventClick: function(info) {
        // Delete the appointment on event click
        if (confirm("Are you sure you want to delete this appointment?")) {
          info.event.remove();
        }
      }
    });
    calendar.render();
  });
</script>
</body>
</html>
