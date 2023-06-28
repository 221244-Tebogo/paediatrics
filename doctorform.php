<?php
include "db_conn.php"; // Include the database connection file

// Array of gender options
$gender_options = array("Male", "Female", "Other");

if (isset($_POST["submit"])) {
   $Name = $_POST['first_name']; // Changed from 'Name' to 'first_name'
   $Surname = $_POST['last_name']; // Changed from 'Surname' to 'last_name'
   $Age = $_POST['date_of_birth']; // Changed from 'Age' to 'date_of_birth'
   $Gender = $_POST['gender']; // Changed from 'Gender' to 'gender'
   $email = $_POST['email'];
   $image = $_FILES['profile_image'];

   // Upload image file
   $target_dir = "uploads/";
   $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
   move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);

   $sql = "INSERT INTO `Doctor`(`Name`, `Surname`, `Age`, `Gender`, `email`, `Image`)
   VALUES ('$Name', '$Surname', '$Age', '$Gender', '$email', '$image')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: doctorlist.php?msg=New record created successfully");
      exit();
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Doctor Form</title>
    
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
 
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;800&family=Poppins:wght@300;600;800&display=swap" rel="stylesheet">
 
    <!-- Custom styles for this template -->
    <link href="css/index.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="images/paediatrics-logo.png" alt="Logo" width="150px">
                </div>
            </a>
            
             <!-- Divider -->
             <hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="receptionist.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Tables Patient Lists -->
<li class="nav-item">
    <a class="nav-link" href="patientlist.php">
        <i class="fas fa-fw fa-users"></i>
        <span>Patients</span>
    </a>
</li>

            <!-- Nav Item - Tables Doctor Lists -->
            <li class="nav-item active">
                <a class="nav-link" href="doctorlist.php">
                    <i class="fas fa-fw fa-user-md"></i>
                    <span>Doctors</span>
                </a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Sheila</span>
                                <img class="img-profile rounded-circle" src="images/receptionist.jpg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Doctor Form</h1>

                    <!-- Form -->
                    <form class="user" method="POST" action="">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="first_name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" name="gender" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <?php
                                        foreach ($gender_options as $option) {
                                            echo "<option value='$option'>$option</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="profile_image">Profile Image</label>
                                    <input type="file" class="form-control" name="profile_image" accept="image/*" required>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Submit">
                    </form>
                    <!-- End Form -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="text-center my-auto">
                        <span>&copy; 2023 All rights are reserved to Paediatrics Healthcare.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/index.js"></script>
</body>

</html>
