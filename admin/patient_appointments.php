<?php
error_reporting(0);
include('includes/connection.php');
session_start();
     
      // $patient_id = $_SESSION['patient_id'];
    if(isset($_SESSION['patient_id'])){
        $patient_id = $_SESSION['patient_id'];
    }
    if(isset($_GET['patient_id'])){
        
           $patient_id = $_SESSION['patient_id'];
          $doctor_id = $_GET['patient_id']; // index page appointment btn

          $doctor = "SELECT * FROM doctor WHERE id='$doctor_id'"; 
          $get_doctor_run = mysqli_query($conn, $doctor); 
          $doctor = mysqli_fetch_array($get_doctor_run);
          $doctor_name =   $doctor['name'];
          $doctor_contact =   $doctor['whatsapp'];
          $doctor_fee =   $doctor['appointment_fee'];

          $patient = "SELECT * FROM patients WHERE id='$patient_id'";
          $get_patient_run = mysqli_query($conn,$patient);
          $patient = mysqli_fetch_array($get_patient_run); 
          $patient_name =    $patient['name'];
          $patient_contact =    $patient['whatsapp'];

        //  $book_appointment = "INSERT INTO `appointment`(`patient_name`, `patient_contact`, `doctor_name`, `doctor_contact`,`appointment_fee`) 
        //  VALUES ('$patient_name','$patient_contact','$doctor_name','$doctor_contact','$doctor_fee')";

         $book_appointment = "INSERT INTO appointment (patient_name, patient_contact, doctor_name, doctor_contact, appointment_fee)
         VALUES('$patient_name','$patient_contact','$doctor_name','$doctor_contact','$doctor_fee')";


           $book_appointment_run = mysqli_query($conn,$book_appointment) or trigger_error("query failed".mysqli_error($conn),E_USER_ERROR);
           if($book_appointment_run){
                echo "<scr>alert('appointment is done')</script>";
             }else{
                 
                echo "<scr>alert('appointment is not done')</script>";
               
             }
    

    }
 

?>
<!DOCTYPE html>
<html lang="Eng">

<?php include('includes/header.php')?>

<body class="crm_body_bg">



    <!-- main content part here -->

    <!-- sidebar  -->
    <!-- sidebar part here -->
    <?php include('includes/sidebar.php') ?>
    <!-- sidebar part end -->
    <!--/ sidebar  -->


    <section class="main_content dashboard_part">
        <!-- menu  -->
        <div class="container-fluid no-gutters">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="header_iner d-flex justify-content-between align-items-center">
                        <div class="sidebar_icon d-lg-none">
                            <i class="ti-menu"></i>
                        </div>
                        <div class="serach_field-area">
                            <h4 class="text-muted">Welcome to Psychology-Clinic Dashboard</h4>

                        </div>
                        <a class="btn btn-default border " href="../index.php" target="_blank">Visit Website</a>
                        <div class="profile_info">
                            <button class="btn btn-info">Profile</button>
                            <div class="profile_info_iner">

                                <h5><?php echo $_SESSION['RULE']; ?></h5>
                                <div class="profile_info_details">
                                    <a href=""><i class="ti-user"></i></a>
                                    <a href="logout.php">Log Out <i class="ti-shift-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


        <!--/ menu  -->
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>Appointments List</h4>

                            </div>

                            <div class="QA_table mb_30">
                                <!-- table-responsive -->
                                <table class="table lms_table_active">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Patient Name</th>
                                            <th scope="col">Patient Contact</th>
                                            <th scope="col">Doctor Name</th>
                                            <th scope="col">Doctor Name</th>
                                            <th scope="col">Appointment Fee</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                        $get_appointment = "SELECT * FROM appointment";
                                        $get_appointment_run = mysqli_query($conn,$get_appointment);
                                        if(mysqli_num_rows($get_appointment_run) > 0){
                                           while($appointment = mysqli_fetch_array($get_appointment_run)){
                                            $appointment_id = $appointment['id'];
                                            $appointment_fee = $appointment['appointment_fee'];
                                            $appointment_status = $appointment['status'];
                                            $appointment_patient_name = $appointment['patient_name'];
                                            $appointment_patient_contact = $appointment['patient_contact'];
                                            $appointment_doctor_name = $appointment['doctor_name'];
                                            $appointment_doctor_contact = $appointment['doctor_name'];
                                            
                                        
                                        ?>
                                            <td><?php echo $appointment_id ;?></td>
                                            <td><?php echo $appointment_patient_name;?></td>
                                            <td><?php echo $appointment_patient_contact ;?></td>
                                            <td><?php echo $appointment_doctor_name ;?></td>
                                            <td><?php echo $appointment_doctor_contact ;?></td>
                                            <td><?php echo $appointment_fee ;?></td>
                                            <td><a class="status_btn"><?php echo $appointment_status; ?></a></td>
                                        </tr>
                                        <?php
                                   
                                    }
                                        }else{
                                            echo "<h4>No Appointment Fount!</h4>";
                                        }
                                        ?>




                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- footer part -->
        <?php  include('includes/footer.php')?>
</body>


</html>