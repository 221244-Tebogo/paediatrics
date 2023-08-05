<?php
session_start();

include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $Name = $_POST['Name'];
    $Surname = $_POST['Surname'];
    $Age = $_POST['Age'];
    $Gender = $_POST['Gender'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $Specialisation = $_POST['Specialisation'];
    $DoctorProfile = $_POST['DoctorProfile'];
    $Room = $_POST['Room'];
    $image = $_FILES['image'];

    // File upload handling
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_error = $_FILES['image']['error'];

    // Check if a new image is uploaded
    if ($image_error === 0) {
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $allowed_ext = array('jpg', 'jpeg', 'png');

        // Check if the uploaded file has an allowed extension
        if (in_array($image_ext, $allowed_ext)) {
            // Generate a unique filename to avoid conflicts
            $new_image_name = uniqid('profile_', true) . '.' . $image_ext;
            $image_path = "images/" . $new_image_name;

            // Move the uploaded file to the destination folder
            move_uploaded_file($image_tmp_name, $image_path);

            // Remove the old image if it exists
            $old_image_path = "images/" . $row['Image'];
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        } else {
            $_SESSION['error_msg'] = "Invalid file type. Only JPG, JPEG, and PNG files are allowed.";
            header("Location: editdoctor.php?id=" . $id);
            exit();
        }
    } else {
        // No new image uploaded, retain the old image
        $new_image_name = $row['Image'];
    }

    // Update the database record with the new data
    $stmt = $conn->prepare("UPDATE `doctors` SET `Name`=?, `Surname`=?, `Age`=?, `Gender`=?, `PhoneNumber`=?, `Specialisation`=?, `DoctorProfile`=?, `Room`=?, `Image`=? WHERE id=?");
    $stmt->bind_param(
        "ssissssssi",
        $Name,
        $Surname,
        $Age,
        $Gender,
        $PhoneNumber,
        $Specialisation,
        $DoctorProfile,
        $Room,
        $new_image_name,
        $id
    );
    $stmt->execute();

    $_SESSION['success_msg'] = "Data updated successfully";
    header("Location: doctorlist.php?success=true");
    exit();
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
    <title>Edit Doctor Information</title>

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
            <li class="nav-item active">
                <a class="nav-link active" href="patientlist.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Patients</span>
                </a>
            </li>

            <!-- Nav Item - Tables Doctor Lists -->
            <li class="nav-item">
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
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Receptionist</span>
                                <img class="img-profile rounded-circle" src="images/default-avatar.jpg">
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Edit Doctor Information</h1>

                    <!-- Form -->
    <?php
    $stmt = $conn->prepare("SELECT * FROM `doctors` WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="Name">Name:</label>
            <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $row['Name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="Surname">Surname:</label>
            <input type="text" class="form-control" id="Surname" name="Surname" value="<?php echo $row['Surname']; ?>" required>
        </div>
        <div class="form-group">
            <label for="Age">Age:</label>
            <input type="number" class="form-control" id="Age" name="Age" value="<?php echo $row['Age']; ?>" required>
        </div>
        <div class="form-group">
            <label for="Gender">Gender:</label>
            <select class="form-control" id="Gender" name="Gender" required>
                <option value="Male" <?php if ($row['Gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($row['Gender'] == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if ($row['Gender'] == 'Other') echo 'selected'; ?>>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="PhoneNumber">Phone Number:</label>
            <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="<?php echo $row['PhoneNumber']; ?>" required>
        </div>
        <div class="form-group">
            <label for="Specialisation">Specialisation:</label>
            <input type="text" class="form-control" id="Specialisation" name="Specialisation" value="<?php echo $row['Specialisation']; ?>" required>
        </div>
        <div class="form-group">
            <label for="DoctorProfile">Doctor Profile:</label>
            <textarea class="form-control" id="DoctorProfile" name="DoctorProfile" rows="5" required><?php echo $row['DoctorProfile']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="Room">Room:</label>
            <input type="text" class="form-control" id="Room" name="Room" value="<?php echo $row['Room']; ?>" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>

    <!-- Success message -->
    <?php if (isset($_SESSION['success_msg'])): ?>
        <div class="alert alert-success mt-4">
            <?php echo $_SESSION['success_msg']; ?>
        </div>
        <?php unset($_SESSION['success_msg']); ?>
    <?php endif; ?>

    <!-- Error message -->
    <?php if (isset($_SESSION['error_msg'])): ?>
        <div class="alert alert-danger mt-4">
            <?php echo $_SESSION['error_msg']; ?>
        </div>
        <?php unset($_SESSION['error_msg']); ?>
    <?php endif; ?>

                    <!-- Success message -->
                    <?php if (isset($_SESSION['success_msg'])): ?>
                        <div class="alert alert-success mt-4">
                            <?php echo $_SESSION['success_msg']; ?>
                        </div>
                        <?php unset($_SESSION['success_msg']); ?>
                    <?php endif; ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <span>&copy; 2023 All rights are reserved to Paediatrics Healthcare.</span>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/index.js"></script>
</body>
</html>
