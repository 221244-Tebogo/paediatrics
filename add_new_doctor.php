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
   $image = $_POST['image'];
   $role = $_POST['role'];

   $sql = "INSERT INTO `user`(`id`, `first_name`, `last_name`, `dob`, `identity_number`, `gender`, `race`, `image`, `role`) 
           VALUES (NULL, '$first_name', '$last_name', '$dob', '$identity_number', '$gender', '$race', '$image', '$role')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: index.php?msg=New record created successfully");
      exit();
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;800&family=Poppins:wght@300;600;800&display=swap" rel="stylesheet">

   <!-- Custom CSS -->
   <link href="style.css" rel="stylesheet">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>Add New Doctor</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-between fs-3 mb-5" style="background-color: #0095d4;">
      <div class="container">
         <a class="navbar-brand" href="#"><img src="logo.png" alt="Logo" width="150"></a>
         <div class="d-flex">
            <a class="nav-link text-white" href="#"><i class="fas fa-user"></i> User</a>
            <a class="nav-link text-white" href="#">Logout</a>
         </div>
      </div>
   </nav>

   <div class="container-fluid">
      <div class="row">
         <div class="col-2 bg-light">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
               <a class="nav-link active" id="receptionist-tab" data-bs-toggle="pill" href="#receptionist" role="tab" aria-controls="receptionist" aria-selected="true">Receptionist</a>
               <a class="nav-link" id="doctor-tab" data-bs-toggle="pill" href="#doctor" role="tab" aria-controls="doctor" aria-selected="false">Doctor</a>

               <a class="nav-link" id="patient-tab" data-bs-toggle="pill" href="#patient" role="tab" aria-controls="patient" aria-selected="false">Patient</a>
               <a class="nav-link" id="appointment-tab" data-bs-toggle="pill" href="#appointment" role="tab" aria-controls="appointment" aria-selected="false">Appointment</a>
            </div>
         </div>
         <div class="col-10">
            <div class="tab-content" id="v-pills-tabContent">
               <div class="tab-pane fade show active" id="receptionist" role="tabpanel" aria-labelledby="receptionist-tab">
                  <div class="container">
                     <div class="text-center mb-4">
                        <h3>Add New Doctor</h3>
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
               <div class="tab-pane fade" id="patient" role="tabpanel" aria-labelledby="patient-tab">
                  <!-- Patient Tab Content -->
               </div>
               <div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
                  <!-- Appointment Tab Content -->
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>