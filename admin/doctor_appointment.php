<?php
error_reporting(0);
session_start();
include('includes/connection.php');

if(isset($_GET['status_id']))
{   
    $status_id = $_GET['status_id'];

    $status = "SELECT status FROM appointment where id='$status_id'";
    $status_run = mysqli_query($conn, $status);
    $status_db = mysqli_fetch_array($status_run);

    $status_name = $status_db['status'];

    if($status_name == 'inactive'){
       $query = "UPDATE appointment SET status = 'active' WHERE id='$status_id'";
        $query_run = mysqli_query($conn, $query);
        header("location:doctor_appointment.php");
   
    }elseif($status_name == 'active'){
       $query = "UPDATE appointment SET status = 'inactive' WHERE id='$status_id'";
        $query_run = mysqli_query($conn, $query);
        header("location:doctor_appointment.php");
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
                            <h4 class="text-muted">Welcome to Psychology-clinic Dashboard</h4>

                        </div>
                        <a class="btn btn-default border " href="../index.php" target="_blank">Visit Website</a>
                        <div class="profile_info">
                            <button class="btn btn-info">Profile</button>
                            <div class="profile_info_iner">

                                <h5><?php echo $_SESSION['RULE']; ?></h5>
                                <div class="profile_info_details">
                                    <a href=""> <i class="ti-user"></i></a>
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
                                            <th scope="col">Doctor Contact</th>
                                            <th scope="col">Appointment Fee</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                        $get_appointment = "SELECT * FROM appointment ";
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
                                            <td><?php echo $appointment_id;?></td>

                                            <td><?php echo $appointment_patient_name;?></td>
                                            <td><?php echo $appointment_patient_contact;?></td>
                                            <td><?php echo $appointment_doctor_name ;?></td>
                                            <td><?php echo $appointment_doctor_contact ;?></td>
                                            <td><?php echo $appointment_fee ;?></td>
                                            <td><a href="doctor_appointment.php?status_id=<?php echo $appointment_id; ?>"
                                                    class="status_btn"><?php echo $appointment_status; ?></a></td>
                                        </tr>
                                        <?php
                                   
                                    }
                                        }else{
                                            echo "<h4>No Appointment Found!</h4>";
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