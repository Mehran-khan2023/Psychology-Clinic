<?php 
error_reporting(0);
include('includes/connection.php');

session_start();

if(!isset($_SESSION['IS_LOGIN'])){
       header('location: login.php');
}else{
  //  header('location: index.php');
}

// count total active doctor
$total_doctor = "SELECT * FROM doctor WHERE status= 1";
$total_doctor_run = mysqli_query($conn, $total_doctor);
$total_doctor = (mysqli_num_rows($total_doctor_run));


// count total active patients
$total_patient = "SELECT * FROM patients WHERE status= 1";
$total_patient_run = mysqli_query($conn, $total_patient);
$total_patient = (mysqli_num_rows($total_patient_run));

// count total  appointment
$total_appointment = "SELECT * FROM appointment WHERE status='Active'";
$total_appointment_run = mysqli_query($conn,$total_appointment);
$total_appointment = (mysqli_num_rows($total_appointment_run));





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
        <?php if($_SESSION['IS_LOGIN'] && $_SESSION['RULE'] == 1) {?>
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="single_element">
                            <div class="quick_activity">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between flex-column flex-lg-row">
                                            <div class="single_quick_activity d-flex col-lg-4 col-12 mb-4">
                                                <div class="icon">
                                                    <img src="img/icon/man.svg" alt="">
                                                </div>
                                                <div class="count_content">
                                                    <h3><span class=""><?php echo $total_doctor;?></span> </h3>
                                                    <p> Total Doctors</p>
                                                </div>
                                            </div>
                                            <div class="single_quick_activity d-flex col-12 col-lg-4 mx-3 mb-4">
                                                <div class="icon">
                                                    <img src="img/icon/man.svg" alt="">
                                                </div>
                                                <div class="count_content">
                                                    <h3><span class=""><?php  echo $total_patient; ?></span> </h3>
                                                    <p>Total Patients</p>
                                                </div>
                                            </div>

                                            <div class="single_quick_activity d-flex col-12 col-lg-4  mb-4">
                                                <div class="icon">
                                                    <img src="img/icon/cap.svg" alt="">
                                                </div>
                                                <div class="count_content">
                                                    <h3><span class=""><?php echo $total_appointment; ?></span> </h3>
                                                    <p>Total Appointments</p>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-xl-12">
                        <div class="white_box mb_30 ">
                            <div class="box_header border_bottom_1px  ">
                                <div class="main-title">
                                    <h3 class="mb_25">Psychology-Clinic Survey</h3>
                                </div>
                            </div>
                            <div class="income_servay">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="count_content">
                                            <?php  
                                   $day_appointment = "SELECT * FROM appointment
                                    WHERE DATE(created_date) = DATE(NOW()) ORDER BY `id` DESC";
                                    $day_appointment = mysqli_query($conn,$day_appointment);
                                    $total_app = mysqli_num_rows($day_appointment);
                                        ?>
                                            <h3><span class=""><?php echo $total_app; ?></span> </h3>
                                            <p>Today's Appointment</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="count_content">
                                            <?php  
                                   $seven_appointment = "SELECT *
                                   FROM appointment
                                   WHERE created_date >= DATE(NOW())  - INTERVAL 7 DAY";
                                    $seven_appointment = mysqli_query($conn,$seven_appointment);
                                    $total_seven_app = mysqli_num_rows($seven_appointment);
                                    

                                        ?>
                                            <h3><span class=""><?php echo $total_seven_app;?></span> </h3>
                                            <p>Last Week's Appointment</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="count_content">
                                            <?php  
                                   $month_appointment = "SELECT *
                                   FROM appointment 
                                   WHERE MONTH(created_date) = MONTH(NOW()) - 1 ORDER BY `id` DESC";
                                     $month_appointment = mysqli_query($conn,$month_appointment);
                                    $total_month_app = mysqli_num_rows($month_appointment);
                                    

                                        ?>
                                            <h3><span class=""><?php echo $total_month_app; ?></span> </h3>
                                            <p>Last Month's Income</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="bar_wev"></div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="white_box card_height_100">
                            <div class="box_header border_bottom_1px  ">
                                <div class="main-title">
                                    <h3 class="mb_25">Psychology-Clinic Management Staff</h3>
                                </div>
                            </div>
                            <div class="staf_list_wrapper sraf_active owl-carousel">


                                <!-- single carousel  -->
                                <div class="single_staf">
                                    <div class="staf_thumb">
                                        <img src="img/staf/mehran.jpg" alt="">
                                    </div>
                                    <h4>Mr- MEHRAN KHAN</h4>
                                    <p>Web Engneer</p>
                                </div>

                                <!-- single carousel  -->
                                <div class="single_staf">
                                    <div class="staf_thumb">
                                         <img src="img/staf/faisal.jpg"alt="">
                                    </div>
                                    <h4>Mr- FASIAL illahi</h4>
                                    <p>HR Manager</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <?php } ?>

        <!--doctor section start here-->
        <?php
              if(isset($_SESSION['DOCTOR_ID'])){

                $doctor_id = $_SESSION['DOCTOR_ID'];
              }
         ?>
        <!--/ menu  -->
        <?php if($_SESSION['IS_LOGIN'] && $_SESSION['RULE'] == 2) {?>
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <?php
                
                
                $login_doctor = "SELECT * FROM doctor WHERE id='$doctor_id'";
                $login_doctor_run = mysqli_query($conn,$login_doctor);
                $doctor = mysqli_fetch_array($login_doctor_run);

                        $doctor_id =  $doctor['id'];
                       $doctor_name =  $doctor['name'];
                        $doctor_image =  $doctor['image'];
                        $doctor_whatsapp =  $doctor['whatsapp'];
                        $doctor_gender =  $doctor['gender'];
                        $doctor_email =  $doctor['email'];
                        $doctor_specialty =  $doctor['specialty'];
                
                
                ?>

                        <div class="container emp-profile">
                            <form method="post">
                                <div class="row">



                                    <div class="col-md-4">

                                        <div class="profile-img">
                                            <img src="../images/doctor/<?php echo $doctor_image;?>" alt="image" />

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="profile-head">
                                            <h5>
                                                <?php echo $doctor_name; ?>
                                            </h5>
                                            <h6>
                                                <?php echo $doctor_specialty; ?>
                                            </h6>
                                            <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="home-tab" data-toggle="tab"
                                                        href="#home" role="tab" aria-controls="home"
                                                        aria-selected="true">About</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="profile-work">

                                            <p>Speciality</p>
                                            <p><?php echo $doctor_specialty; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="tab-content profile-tab" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                                aria-labelledby="home-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>User Id</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php echo "#OPC".$doctor_id; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Name</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php echo $doctor_name; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Email</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php echo $doctor_email; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Phone</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php echo $doctor_whatsapp; ?></p>
                                                    </div>
                                                </div>
                                                <!-- <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Profession</label>
                                                    </div>
                                                  <div class="col-md-6">
                                                        <p>Brain</p>
                                                    </div>  
                                                </div> -->
                                            </div>

                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>





                </div>
            </div>
        </div>



        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <?php } ?>
        <!--doctor section end here-->


        <!--patients section start here-->

        <!--/ menu  -->
        <?php if($_SESSION['IS_LOGIN'] && $_SESSION['RULE'] == 3) {?>
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">



                    <div class="col-lg-12">




                        <div class="col-lg-12">
                            <div class="white_box mb_30">
                                <div class="box_header ">
                                    <div class="main-title">
                                        <h3 class="mb-2">OPClinic Doctors</h3>
                                    </div>
                                </div>
                                <div class="card-group">

                                    <?php 
                           $total_doctor = "SELECT * FROM doctor WHERE status=1";//here is it
                           $total_doctor_run = mysqli_query($conn,$total_doctor);
                           if(mysqli_num_rows($total_doctor_run) > 0){
                             
                                while($doctor =  mysqli_fetch_array($total_doctor_run)){

                                   $doctor_id = $doctor['id'];  
                                   $doctor_name = $doctor['name'];
                                   $doctor_image = $doctor['image'];
                                   $doctor_specialty = $doctor['specialty'];
                                   $doctor_appointment_fee = $doctor['appointment_fee'];                           
                           
                           
                           ?>
                                    <div class="card col-lg-4 m-2">
                                        <img src="../images/doctor/<?php echo $doctor_image;?>" class="card-img-top"
                                            alt="doctor image">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $doctor_name;?></< /h5>
                                                <p class="card-text text-dark"><?php echo $doctor_specialty;?></p>

                                                <h3>Fee: Rs.<?php echo $doctor_appointment_fee;?></h3>
                                                <h5>Student Discount : 10%</h5>
                                                <a href="patient_appointments.php?patient_id=<?php  echo $doctor_id; ?>"
                                                    class="btn btn-info">Book Appointment</a>
                                        </div>
                                    </div>

                                    <?php
                               }
                            }else{
 
                            }
                            
                            ?>


                                </div>
                            </div>
                        </div>





                    </div>
                </div>
            </div>



        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

        <?php } ?>
        <!--patients section end here-->

        <!-- footer part -->
        <?php  include('includes/footer.php')?>
</body>


</html>