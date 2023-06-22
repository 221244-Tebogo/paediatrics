<?php
include "db_conn.php";


   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $dob =$_POST['date_of_birth'];
   $gender = $_POST['gender'];
   $image = $_FILES['image']['name'];
  
   // Upload image file
   //dob
   $target_dir = "uploads/";
   $target_file = $target_dir . basename($_FILES["image"]["name"]);
   move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

   $sql = "INSERT INTO Patient( Name, Surname, Age, Gender, PhoneNumber, MedicalAidNo, Image, PatientProfile) 
           VALUES ('$first_name', '$last_name', '$dob', '$gender', '', '', '$image', '')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: patientform.php?msg=New record created successfully");
      exit();
   } else {
      echo "Failed: " . mysqli_error($conn);
   }

?>