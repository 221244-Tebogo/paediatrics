<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Receptionist Login</title>
	<!-- Mobile -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
	<!-- Main Style Css -->
	<link rel="stylesheet" href="./css/style.css">
</head>
<body class="form">
	<div class="page-content">
		<div class="form-content">
			<!-- Left Form Section -->
			<div class="form-left" style="margin-right: 20px;">
				<img src="https://cdn.pixabay.com/photo/2014/12/10/10/04/teddy-562960_1280.jpg" alt="form">
			</div>
			
			<!-- Right Form Section -->
			<div class="form-right">
				<!-- Heading -->
				<h2>Paediatrics</h2><br>
				<h1>Welcome Back</h1><br>
				
				<!-- Body Text -->
				<div class="body" style="text-align: center;">
					Welcome back! Please enter your details.
				</div>
				
				<!-- Sign In and Sign Up Tabs -->
				<div class="contact">
					<div class="tab">
						<div class="tab-inner">
							<button class="tablinks" onclick="openCity(event, 'sign-in')" id="defaultOpen">Sign In</button>
						</div>
						<div class="tab-inner">
							<button class="tablinks" onclick="openCity(event, 'sign-up')">Sign Up</button>
						</div>
					</div>
					
					<!-- Sign In Form -->
					<form class="form-detail" action="signin.php" method="post"> <!-- Replace "signin.php" with the PHP file to process the sign-in form -->
						<div class="tabcontent" id="sign-in">
							<!-- Username Field -->
							<div class="form-row">
								<label class="form-row-inner">
									<input type="text" name="username" id="username" class="input-text" required>
									<span class="label">Username</span>
									<span class="border"></span>
								</label>
							</div>
							
							<!-- Email Field -->
							<div class="form-row">
								<label class="form-row-inner">
									<input type="text" name="your_email" id="your_email" class="input-text" required>
									<span class="label">E-Mail</span>
									<span class="border"></span>
								</label>
							</div>
							
							<!-- Password Field -->
							<div class="form-row">
								<label class="form-row-inner">
									<input type="password" name="password" id="password" class="input-text" required>
									<span class="label">Password</span>
									<span class="border"></span>
								</label>
							</div>
							
							<!-- Confirm Password Field -->
							<div class="form-row">
								<label class="form-row-inner">
									<input type="password" name="confirm_password" id="confirm_password" class="input-text" required>
									<span class="label">Confirm Password</span>
									<span class="border"></span>
								</label>
							</div>
							
							<!-- Sign In Button -->
							<div class="form-row-last">
								<input type="submit" name="signin" class="register" value="Sign In">
							</div>
						</div>
					</form>
					
					<!-- Sign Up Form -->
					<form class="form-detail" action="register.php" method="post"> <!-- Replace "register.php" with the PHP file to process the registration form -->
						<div class="tabcontent" id="sign-up">
							<!-- Full Name Field -->
							<div class="form-row">
								<label class="form-row-inner">
									<input type="text" name="full_name" id="full_name" class="input-text" required>
									<span class="label">Username</span>
									<span class="border"></span>
								</label>
							</div>
							
							<!-- Email Field -->
							<div class="form-row">
								<label class="form-row-inner">
									<input type="text" name="your_email" id="your_email" class="input-text" required>
									<span class="label">E-Mail</span>
									<span class="border"></span>
								</label>
							</div>
							
							<!-- Password Field -->
							<div class="form-row">
								<label class="form-row-inner">
									<input type="password" name="password" id="password" class="input-text" required>
									<span class="label">Password</span>
									<span class="border"></span>
								</label>
							</div>
							
							<!-- Confirm Password Field -->
							<div class="form-row">
								<label class="form-row-inner">
									<input type="password" name="confirm_password" id="confirm_password" class="input-text" required>
									<span class="label">Confirm Password</span>
									<span class="border"></span>
								</label>
							</div>
							
							<!-- Register Button -->
							<div class="form-row-last">
								<input type="submit" name="register" class="register" value="Register">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	<!--Footer --->
	<footer>
    <div class="footer">2023 All rights are reserved to Paediatrics Healthcare</div>
  </footer>

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
