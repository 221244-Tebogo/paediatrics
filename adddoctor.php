<?php
include "db_conn.php";

$Name = $_POST['Name'];
$Surname = $_POST['Surname'];
$Age = $_POST['Age'];
$Gender = $_POST['Gender'];
$Specialisation = $_POST['Specialisation'];
$PhoneNumber = $_POST['PhoneNumber'];
$Room = $_POST['Room'];
$image = $_FILES['image'];

// Upload image file
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

$sql = "INSERT INTO `Doctor`(`Name`, `Surname`, `Age`, `Gender`, `Specialisation`, `PhoneNumber`, `Room`, `Image`) 
        VALUES ('$Name', '$Surname', '$Age', '$Gender', '$Specialisation', '$PhoneNumber', '$Room', '$image')";

$result = mysqli_query($conn, $sql);

if ($result) {
   header("Location: doctorlist.php?success=true");
   exit();
} else {
   echo "Failed: " . mysqli_error($conn);
}
?>
