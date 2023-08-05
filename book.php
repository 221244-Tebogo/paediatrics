
<?php
include "db_conn.php"; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle appointment form submission
    $typeOfAppointment = $_POST['type_of_appointment'];
    $medicalAidScheme = $_POST['medical_aid_scheme'];
    $medicalAidPlan = $_POST['medical_aid_plan'];
    $membershipNumber = $_POST['membership_number'];
    $referringDoctor = $_POST['referring_doctor'];
    $paymentMethod = $_POST['payment_method'];
    $isExistingPatient = isset($_POST['existing_patient']) ? 1 : 0;
    $acceptTermsAndConditions = isset($_POST['accept_terms']) ? 1 : 0;
    $appointmentDate = date('Y-m-d H:i:s'); // Assuming you want to store the current date/time for the appointment

    // Insert the appointment into the database
    $sql = "INSERT INTO Appointment (TypeOfAppointment, MedicalAidScheme, MedicalAidPlan, MembershipNumber, ReferringDoctor, PaymentMethod, IsExistingPatient, AcceptTermsAndConditions, AppointmentDate)
            VALUES ('$typeOfAppointment', '$medicalAidScheme', '$medicalAidPlan', '$membershipNumber', '$referringDoctor', '$paymentMethod', '$isExistingPatient', '$acceptTermsAndConditions', '$appointmentDate')";

    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<form class="user" method="POST" action="process_appointment.php">

<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Book Appointment</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Appointment Information </h2>

                </div>
                <form method="post" action="" name="frmappnt" onSubmit="return validateform()">
                    <input type="hidden" name="select2" value="Offline">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        if(isset($_GET[patid]))
                                        {
                                          $sqlpatient= "SELECT * FROM patient WHERE patientid='$_GET[patid]'";
                                          $qsqlpatient = mysqli_query($con,$sqlpatient);
                                          $rspatient=mysqli_fetch_array($qsqlpatient);
                                          echo $rspatient[patientname] . " (Patient ID - $rspatient[patientid])";
                                          echo "<input type='hidden' name='select4' value='$rspatient[patientid]'>";
                                      }
                                      else
                                      {
                                          ?>
                                        <select name="select4" id="select4" class=" form-control show-tick">
                                            <option value="">Select Patient</option>
                                            <?php
                                            $sqlpatient= "SELECT * FROM patient WHERE status='Active'";
                                            $qsqlpatient = mysqli_query($con,$sqlpatient);
                                            while($rspatient=mysqli_fetch_array($qsqlpatient))
                                            {
                                                if($rspatient[patientid] == $rsedit[patientid])
                                                {
                                                 echo "<option value='$rspatient[patientid]' selected>$rspatient[patientid] - $rspatient[patientname]</option>";
                                             }
                                             else
                                             {
                                                 echo "<option value='$rspatient[patientid]'>$rspatient[patientid] - $rspatient[patientname]</option>";
                                             }

                                         }
                                         ?>
                                        </select>
                                        <?php
                                 }
                                 ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select5" id="select5" class=" form-control show-tick">
                                            <option value="">Select</option>
                                            <?php
                                    $sqldepartment= "SELECT * FROM department WHERE status='Active'";
                                    $qsqldepartment = mysqli_query($con,$sqldepartment);
                                    while($rsdepartment=mysqli_fetch_array($qsqldepartment))
                                    {
                                       if($rsdepartment[departmentid] == $rsedit[departmentid])
                                       {
                                        echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
                                    }

                                }
                                ?>
                                        </select>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="date" name="appointmentdate"
                                            id="appointmentdate" value="<?php echo $rsedit[appointmentdate]; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="time" name="time" id="time"
                                            value="<?php echo $rsedit[appointmenttime]; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select6" id="select6" class=" form-control show-tick">
                                            <option value="">Select Doctor</option>
                                            <?php
                                $sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
                                $qsqldoctor = mysqli_query($con,$sqldoctor);
                                while($rsdoctor = mysqli_fetch_array($qsqldoctor))
                                {
                                   if($rsdoctor[doctorid] == $rsedit[doctorid])
                                   {
                                    echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[departmentname] ) </option>";
                                }
                                else
                                {
                                    echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";				
                                }
                            }
                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" class="form-control no-resize" name="appreason"
                                            id="appreason" s><?php echo $rsedit[app_reason]; ?></textarea>


                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                                <div class="form-group drop-custum">
                                    <select name="select" id="select" class=" form-control show-tick">

                                        <option value="">Select Status</option>
                                        <?php
                        $arr = array("Active","Inactive");
                        foreach($arr as $val)
                        {
                           if($val == $rsedit[status])
                           {
                            echo "<option value='$val' selected>$val</option>";
                        }
                        else
                        {
                            echo "<option value='$val'>$val</option>";			  
                        }
                    }
                    ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-12">

                                <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit"
                                    value="Submit" />

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>