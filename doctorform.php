<?php
include "db_conn.php"; // Include the database connection file

// Array of gender options
$gender_options = array("Male", "Female", "Other");

if (isset($_POST["submit"])) {
    $Name = $_POST['name'];
    $Surname = $_POST['surname'];
    $Age = $_POST['age'];
    $Gender = $_POST['gender'];
    $PhoneNumber = $_POST['phone_number'];
    $Specialisation = $_POST['specialisation'];
    $DoctorProfile = $_POST['doctor_profile'];
    $Room = $_POST['room'];
    $image = $_FILES['profile_image'];

    // Upload image file
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO `Doctors`(`Name`, `Surname`, `Age`, `Gender`, `PhoneNumber`, `Specialisation`, `DoctorProfile`, `Image`, `Room`)
            VALUES ('$Name', '$Surname', '$Age', '$Gender', '$PhoneNumber', '$Specialisation', '$DoctorProfile', '$target_file', '$Room')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // New doctor added successfully, redirect to doctorlist.php
        header("Location: doctorlist.php?msg=New doctor added successfully");
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>

<!-- Rest of the HTML code goes here -->


<!-- HTML form goes here -->


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
<form class="user" method="POST" action="" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="surname">Surname</label>
                <input type="text" class="form-control" name="surname" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" name="age" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" name="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="tel" class="form-control" name="phone_number" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="specialisation">Specialisation</label>
                <input type="text" class="form-control" name="specialisation" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="doctor_profile">Doctor Profile</label>
                <textarea class="form-control" name="doctor_profile" required></textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="room">Room</label>
                <select class="form-control" name="room" required>
                    <option value="" disabled selected>Select Room</option>
                    <?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                    ?>
                </select>
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
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
