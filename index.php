<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Receptionist Form</title>
  <!-- Mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- Font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="style.css" rel="stylesheet">
  <style>
    /* Custom CSS styles */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      color: #fff;
      background-color: #49443c;
      background-image: url("images/pexels-gustavo-fring-7446987.jpg");
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #337ab7;
      color: #fff;
      text-decoration: none;
      border: none;
      border-radius: 5px;
      cursor: pointer;
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

    .footer {
      background-color: #49443c;
      color: #fff;
      padding: 10px;
      text-align: center;
      font-weight: bold;
      font-size: 16pt;
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

    .pexels-gustavo-fring-7446987-1 {
      position: absolute;
      top: 0;
      left: 0;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      background-image: url("images/pexels-gustavo-fring-7446987.jpg");
      z-index: -1;
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
      padding: 10px;
      text-align: center;
      font-weight: lighter;
      font-size: 16px;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
<div class="full-height">
  <center>
    <table border="0">
      <tr>
        <td width="80%">
          <img src="images/paediatrics-logo-full-colour.png" alt="Paediatrics Logo" class="paediatrics-logo-1">
        </td>
        <td width="10%">
          <a href="login.php" class="non-style-link"><p class="nav-item">LOGIN</p></a>
        </td>
        <td width="10%">
          <a href="signup.php" class="non-style-link"><p class="nav-item" style="padding-right: 10px;">REGISTER</p></a>
        </td>
      </tr>

        <td colspan="3">
          <p class="heading-text">Avoid Hassles & Delays.</p>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <p class="sub-text2">How is your health today? Sounds like not good!<br>Don't worry. Find your doctor online and book an appointment with eDoc.<br>
            We offer you a free doctor channeling service. Make your appointment now.</p>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <div class="doctors-on-call-drop poppins-bold-cerulean-24px">
            <select>
              <option value="">Select a doctor</option>
              <option value="Dr. Molefe">Dr. Molefe</option>
              <option value="Dr. Knight">Dr. Knight</option>
              <option value="Dr. Marya Smith">Dr. Marya Smith</option>
              <option value="Dr. Eric Makibelo">Dr. Eric Makibelo</option>
            </select>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <center>
            <a href="login.php">
              <input type="button" value="Make Appointment" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
            </a>
          </center>
        </td>
      </tr>
      <tr>
        <td colspan="3">

        </td>
      </tr>
    </table>
    <p class="sub-text2 footer-hashen">A Web Solution by Hashen.</p>
  </center>

  <div class="weekly-calendar poppins-bold-cerulean-24px">Weekly calendar</div>
</div>

<div class="rectangle-32"></div>

<div class="help-booking-online">
  NEED HELP BOOKING ONLINE? +27 (0) 10 648 9200 admin@paediatrics.co.za
</div>
<div class="footer">
  <p>2023 All rights are reserved to Paediatrics Healthcare</p>
</div>

<!--End of footer-->
<script type="text/javascript">
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
</script>
</body>
</html>
