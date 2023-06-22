<?php
include "db_conn.php";

// Array of race options
$race_options = array("White", "Black", "Indian", "Coloured", "Asian");

if (isset($_POST["submit"])) {
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $dob = date('Y-m-d', strtotime($_POST['date_of_birth']));
   $identity_number = $_POST['identity_number'];
   $gender = $_POST['gender'];
   $race = $_POST['race'];
   $role = $_POST['role'];

   // Handle file upload
   $image = $_FILES['image']['name']; // Get the name of the uploaded file
   $target_directory = "image/uploads/"; // Specify the directory where the file will be stored
   $target_file = $target_directory . basename($image); // Specify the path of the uploaded file on the server

   // Move the uploaded file to the target directory
   if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
      // File upload successful
      $sql = "INSERT INTO `user`(`id`, `first_name`, `last_name`, `dob`, `identity_number`, `gender`, `race`, `image`, `role`) 
           VALUES (NULL, '$first_name', '$last_name', '$dob', '$identity_number', '$gender', '$race', '$image', '$role')";

      $result = mysqli_query($conn, $sql);

      if ($result) {
         header("Location: index.php?msg=New record created successfully");
         exit();
      } else {
         echo "Failed: " . mysqli_error($conn);
      }
   } else {
      echo "Failed to upload file.";
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
    <title>Receptionist - Dashboard</title>
    
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
 
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;800&family=Poppins:wght@300;600;800&display=swap" rel="stylesheet">
 
    <!-- Custom styles for this template -->
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
                <div class="sidebar-brand-icon ">
                <img src="images/paediatrics-logo.png" alt="Logo" width="150px">

                </div>
            </a>
            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Tables Patient Lists -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Patients</span>
                </a>
            </li>

            <!-- Nav Item - Tables Doctor Lists -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-user-md"></i>
                    <span>Doctors</span>
                </a>
            </li>

            <!-- Nav Item - Charts Appointment -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Appointment</span>
                </a>
            </li>
        
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                       
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
                                <img class="img-profile rounded-circle"
                                    src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
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
                   <!-- <h1 class="h3 mb-4 text-gray-800">Add Patient Details</h1>-->

                    <!-- Content Row -->
                    <div class="container">
                     <div class="text-center mb-4">
                       <h3>Add Patient Details</h3>
                        <p class="text-muted">Your child is a patient</p>
                     </div>

                     <div class="container d-flex justify-content-center">
                        <form action="" method="post" style="width:50vw; min-width:300px;">
                           <div class="row mb-3">
                              <div class="col">
                                 <label class="form-label">First Name:</label>
                                 <input type="text" class="form-control" name="first_name" placeholder="Patient Name">
                              </div>

                              <div class="col">
                                 <label class="form-label">Last Name:</label>
                                 <input type="text" class="form-control" name="last_name" placeholder="Patient Surname">
                              </div>
                           </div>

                           <div class="mb-3">
                              <label class="form-label">Date of Birth:</label>
                              <input type="date" class="form-control" name="date_of_birth">
                           </div>

                           <div class="mb-3">
                              <label class="form-label">Patient Identity Number:</label>
                              <input type="text" class="form-control" name="identity_number" placeholder="Patient Identity Number">
                           </div>

                           <div class="form-group mb-3">
                              <label>Gender:</label>
                              &nbsp;
                              <input type="radio" class="form-check-input" name="gender" id="male" value="male">
                              <label for="male" class="form-input-label">Male</label>
                              &nbsp;
                              <input type="radio" class="form-check-input" name="gender" id="female" value="female">
                              <label for="female" class="form-input-label">Female</label>
                           </div>

                           <div class="mb-3">
                              <label class="form-label">Patient Image:</label>
                              <input type="file" class="form-control" name="image">
                           </div>

                           <div class="mb-3">
                              <label class="form-label">Patient Role:</label>
                              <input type="text" class="form-control" name="role" placeholder="Patient Role">
                           </div>

                           <div class="mb-3">
                              <label class="form-label">Patient Race:</label>
                              <select class="form-select" name="race">
                                 <?php
                                 foreach ($race_options as $option) {
                                    echo "<option value='$option'>$option</option>";
                                 }
                                 ?>
                              </select>
                           </div>

                           <div>
                              <button type="submit" class="btn btn-success" name="submit">Save</button>
                              <a href="index.php" class="btn btn-danger">Cancel</a>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>


            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="text-center">
                        <span>2023 All rights are reserved to Paediatrics Healthcare</span>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
