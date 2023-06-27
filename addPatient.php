<?php
include "db_conn.php";

$Name = $_POST['Name'];
$Surname = $_POST['Surname'];
$Age = $_POST['Age'];
$Gender = $_POST['Gender'];
$email = $_POST['email'];
$image = $_FILES['image'];

// Upload image file
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);

$sql = "INSERT INTO `Patient`(`Name`, `Surname`, `Age`, `Gender`, `email`, `Image`) 
        VALUES ('$Name', '$Surname', '$Age', '$Gender', '$email', '$image')";

$result = mysqli_query($conn, $sql);

if ($result) {
   header("Location: patientform.php?msg=New record created successfully");
   exit();
} else {
   echo "Failed: " . mysqli_error($conn);
}
?>
