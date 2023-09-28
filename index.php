<?php
  error_reporting(0);
  include('includes/connection.php');
  session_start();
  $get_doctor = "SELECT id ,name,image,specialty FROM doctor WHERE status='active'";
  $get_doctor_run = mysqli_query($conn, $get_doctor);
  $doctor = mysqli_fetch_array($get_doctor_run);
  $doctor_id = $doctor['id']; 



if(isset($_POST['booking'])){

    $doctor_id = $_POST['doctor_id'];
    $patient_username = strip_tags($_POST['username']);
    $patient_password = strip_tags($_POST['password']);
    $patient_blood_group = strip_tags($_POST['blood_group']);
    $patient_gender = strip_tags($_POST['gender']);
    $patient_age = strip_tags($_POST['age']);
    $patient_whatsapp = strip_tags($_POST['whatsapp']);
    $patient_mobile = strip_tags($_POST['mobile']);
    $patient_village = strip_tags($_POST['village']);
    $patient_city = strip_tags($_POST['city']);
    $patient_district = strip_tags($_POST['district']);
    $patient_problem = strip_tags($_POST['problem']);

    $appointment = "INSERT INTO `patients`( `name`, `password`, `blood_group`, `age`, `gender`, `whatsapp`, `mobile`, `village`, `city`, `district`, `problem`, `doctor_id`) 
    VALUES ('$patient_username','$patient_password','$patient_blood_group','$patient_age','$patient_gender',' $patient_whatsapp','$patient_mobile',' $patient_village',' $patient_city',' $patient_district','$patient_problem','$doctor_id')";
     $appointment_run = mysqli_query($conn, $appointment);
     if($appointment_run){


       // =============The API Code Start========================


        $get_doctor = "SELECT id ,name,image,specialty FROM doctor WHERE status='1'";
        $get_doctor_run = mysqli_query($conn, $get_doctor);
        $doctor = mysqli_fetch_array($get_doctor_run);
        $doctor_id = $doctor['id']; 

        $query_doctor_no = "SELECT * FROM doctor WHERE id='$doctor_id '";
        $run= mysqli_query($conn, $query_doctor_no);
        $doctor = mysqli_fetch_array($run);


        $id = "rchprimeggs";//API ID
        $pass = "WebSol@938";//API PASSWORD
        $lang = "English";
        $mask = "Prime Eggs";//API REGISTERATION NAME

        // Prepare data for POST request
        //Data for text message
        $to =  $doctor['phone'];
        $message = "Please Check Patient Oppointment in Online Psychology Clinic";
        $message = urlencode($message);
        $data = 
        "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask;

        // Send the POST request with cURL

        $ch = curl_init('http://outreach.pk/api/sendsms.php/sendsms/url'); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responce = curl_exec($ch);
        curl_close($ch);

        echo $responce;

    
         header('Location: admin/login.php');

// =============The API Code END========================

        
     }else{
        echo "<script>alert('Sorry! Please Try Again Later')</script>";
          
     }
    }
     // doctor registration
    
        if(isset($_POST['doctor_reg'])){
         

       $doctor_id = $_POST['doctor_id'];
        $doctor_name = $_POST['name'];
        $doctor_password = $_POST['password'];
        $doctor_gender = $_POST['gender'];
        $doctor_email = $_POST['email'];
        $doctor_mobile = $_POST['mobile'];
        $doctor_whatsapp = $_POST['whatsapp'];
        $doctor_skype = $_POST['skype'];
        $doctor_specialty = $_POST['quality'];
        $doctor_Unavalible = $_POST['Unavalible'];
        $doctor_appointment_fee = $_POST['appointment_fee'];
        
          // degree uploade  
        $degree = $_FILES['degree']['name'];
        $destination = 'images/degree/' .$degree;
        $file = $_FILES['degree']['tmp_name'];
        move_uploaded_file($file, $destination);
        
          // certificate uploade 
          $certificate = $_FILES['certificate']['name'];
          $destination = 'images/certificate/' .$certificate;
          $file = $_FILES['certificate']['tmp_name'];
          move_uploaded_file($file, $destination);

           // doctor profile image
          $doctor_image = $_FILES['doctor_image']['name'];
          $destination = 'images/doctor/' .$doctor_image;
          $file = $_FILES['doctor_image']['tmp_name'];
          move_uploaded_file($file, $destination);


      $doctor_reg = "INSERT INTO `doctor`( `name`, `password`, `gender`, `email`, `phone`, `whatsapp`, `skype_id`, `specialty`, `degree`, `certificate`, `appointment_fee`,`image`, `date_unavalible`) 
      VALUES ('$doctor_name','$doctor_password',' $doctor_gender','$doctor_email','$doctor_mobile','$doctor_whatsapp','$doctor_skype','$doctor_specialty','$degree','$certificate','$doctor_appointment_fee','$doctor_image','$doctor_Unavalible')";
      $doctor_reg_run = mysqli_query($conn,$doctor_reg) or trigger_error("query failed".mysqli_error($conn),E_USER_ERROR);
      if($doctor_reg_run){
        header('Location: admin/login.php');
      }else{
        echo "<script>alert('Sorry! Please Try Again Later')</script>";
      }
     }

?>
<!DOCTYPE html>
<html lang="en">
    <?php
     include('includes/header.php');
    ?>
<body>
    <!--header   section ended here -->
<header id="Home">

        <!--navabar section startin from here -->

        <nav class="navbar navbar-expand-lg navbar-light bg-white px-4  border-bottom fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand fs-3" href="#"><span class="text-warning">Online</span> <span
                        class="text-danger">Psychology</span> <span class="text-info">Clinic</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-5   text-center">
                        <li class="nav-item">
                            <a class="nav-link active text-primary" aria-current="page" href="#Home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#About">About us</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#Services">Our Services</a>
                        </li>
                 

                        <li class="nav-item">
                            <a class="nav-link" href="#Consultants">Our Consultants</a>
                        </li>
                        <li class="nav-item">
                            
                            <a class="btn btn-info p-2 m-2"  href="doctor_oppiontment.php"><span class="glyphicon glyphicon-edit"></span>Doctor Registration</a>
                        </li>

                        <?php
                        if(isset($_SESSION['IS_LOGIN'])){ ?>

                            <li class="nav-item">
                            <a class="nav-link btn btn-info text-white p-2 m-2"  href="admin/index.php">Dashboard</a>
                        </li>
                        
                        
                        <?php } ?>
                     <?php
                        if(!isset($_SESSION['IS_LOGIN'])){ ?>

                <li class="nav-item">
                <a class="nav-link btn btn-info text-white p-2 m-2"  href="admin/login.php">Login</a>
                </li>


                <?php } ?>
                       
                       

                    </ul>

                </div>
            </div>
        </nav>

        <!--navar section ended here -->

        <!--carousole section start here-->
        <div id="carouselCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-interval="1000">
                    <img src="./images/img1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Welcome To Online-psychology-clinic</h5>
                        <p>we are providing a special platform for you.</p>
                    </div>
                </div>
                <div class="carousel-item" data-interval="2000">

                    <img src="./images/img3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Meet Expert Psychologist here</h5>
                        <p>So on this platform you can easily find solution of your problems </p>
                    </div>
                </div>
                <div class="carousel-item" data-interval="3000">
                    <img src="./images/img2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Experience Doctors</h5>
                        <p>Easily explain your issue with doctors to find better solution</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!--carousole section ended here-->
    </header>
    <!--(((((((((((((((((((((((((((((((((((((((((((((((((((((((((()))))))))))))))))))))))))))))))))))))))))))))))))))))))-->

    <!--About section start from here-->
    <section class="about my-5" id="About">
        <div class="container text-center my-5">
            <h1 data-aos="fade-up" data-aos-offset="200">About<span class="text-primary">us</span></h1>
            <hr class="w-25 m-auto" />
        </div>
        <div class="row ">
            <div class="col-sm-12 col-md-6 col-lg-6 col-12  " data-aos="zoom-in-right" data-aos-offset="200">
                <h1 class="px-5 ">Lets<span class="text-primary"> know</span>about<span class="text-warning"> our
                        platform</span> </h1>
                <p class="px-4">
                    Our mission is to help people and aware them about such mental illness via experts. We are going to
                    give them platform to present their issues with doctors and to overcome all of them.
                    We will connect you with a professional, licensed and vetted therapist in an online, private session
                    room. You can message your counselor anytime, and you can also schedule a weekly phone, video, or
                    live chat session with your counslers.<br>
                    <strong>Click on read more for further benefits of yours being visiting our website</strong>
                </p>

                <a href="moreabout.php" class="btn-more m-5 px-5">Read more</a>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-12 m-auto  text-end" data-aos="fade-right"
                data-aos-offset="200">
                <img src="./images/about-us.jpg" alt="image" class="img-fluid img-thumbnail" id="img-about">



            </div>
        </div>
    </section>
    <!--About section ended here-->

    <!--<><><><><><><>><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><<><><><><><><><><><<><><><<<<<><>-->

    <!--Our services section start here -->
    <section class="our services py-5 bg-light" id="Services">
        <div class="container text-center my-5">
            <h1 data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-offset="200">Our <span
                    class="text-primary">Services</span></h1>
            <hr class="w-25 m-auto" />
        </div>
        <div class="row my-5" data-aos="pade-up-left" data-aos-offset="200">
            <div class="col-sm-12 col-md-5 col-lg-4 col-12" data-aos="zoom-in-right" data-aos-offset="200">
                <!--card 1 section start here-->
                <div class="card ml-2">
                    <div class="card-body">
                        
                        <h4 class="card-title bg-primary text-white text-center">Student development issue</h4>
                        <p class="card-text  ">
                        •   Social anxiety, general anxiety, test anxiety, or panic attacks</br>
•   Family expectations or problems•</br>
•   Depression, lack of energy or motivation, hopelessness, being overwhelmed, low self-esteem, homesickness, loneliness</br>
•   Relationship difficulties (emotional and physical aspects of intimate relationships)</br>
•   Dealing with conflict or difficult people</br>
•   Helping others in distress</br>
•   Eating problems or body image issues</br>
•   Grief from the loss of a loved one or a relationship breakup</br>
•   Stress, perfectionism, procrastination, time management</br>
•   Lack of confidence, assertiveness, self-esteem</br>
•   Past or recent trauma, abuse (physical, sexual, emotional), sexual assault, or stalking</br>
•   Sexuality or gender identity questions</br>
</p>
                        
                    </div>
                </div>
            </div>
            <!--card 1 section ended here-->

            <!--card 2 section start here-->


              
            <div class="col-sm-12 col-md-4 col-lg-4 col-12" data-aos="zoom-in-left" data-aos-offset="200">
             
       
                <div class="card">

                    <div class="card-body">
                         
                        <h4 class="card-title bg-success text-white text-center">Career consoling </h4>
                        <p class="card-text"> Your career development is a lifelong process that, whether you know it or not, actually started when you were born! There are a number of factors that influence your career development, including your interests, abilities, values, personality, background, and 
                        circumstances</br>
                       <h4>What can I expect?
                        Your Career Counselor WILL:
                        </h4>Help you figure out who you are and what you want out of your education, your career, and your life.</br>
                        Be someone for you to talk to about your thoughts, ideas, feelings, and concerns about your career and educational choices, who will help you sort out, organize, and make sense of your thoughts and feelings.
 
                        </p>
                         
                    </div>
                </div>
            </div>
            <!--card 2 section ended here-->

            <!--card 3 section start here-->
            <div class="col-sm-12 col-md-4 col-lg-4 col-12" data-aos="zoom-in-down" data-aos-offset="400">

                <div class="card mr-4 pr-4">
                    <div class="card-body">
                         
                        <h4 class="card-title bg-danger text-white text-center"> Physical and mental fitness </h4>
                        <p class="card-text">
                        
Physical fitness gets plenty of attention, and for good reason.</br> A healthy body can prevent conditions such as heart disease and diabetes, and help you maintain independence as you age.</br>
Mental fitness is just as important as physical fitness, and shouldn’t be neglected. </br>Including mental dexterity exercises into your daily routine can help you reap the benefits of a sharper mind and a healthier body for years to come.</br>
Mental fitness means keeping your brain and emotional health in tip-top shape.</br> It doesn’t mean training for <b>“brain Olympics”</b> or acing an IQ test. It refers to a series of exercises that help you:</br>
•   slow down</br>
•   decompress</br>
•   boost a flagging memory</br>

                        </p>
              
                    </div>
                </div>
            </div>
        </div>
        <!--card 3 section ended here-->


        <div class="row mt-5 ml-2" data-aos="zoom-in-down" data-aos-offset="200">
            <!--card 4 section start here-->
            <div class="col-sm-12 col-md-6 col-lg-6 col-12">

                <div class="card">
                    <div class="card-body">
                       
                        <h4 class="card-title bg-dark text-white text-center">Stress</h4>
                        <p class="card-text"> <b>Stress is a feeling of emotional or physical tension.</b></br> It can come from any event or thought that makes you feel </br>
                        frustrated</br>angry </br>or</br> nervous. </br>Stress is your body's reaction to a challenge or demand.</br> In short bursts, stress can be positive, such as when it helps you avoid danger or meet a deadline</p>
                    
                    </div>
                </div>
            </div>
            <!--card 4 section ended here-->

            <!--card  5 section started-->
            <div class="col-sm-12 col-md-6 col-lg-6 col-12" data-aos="zoom-in-down" data-aos-offset="300">

                <div class="card mx-4 px-4">

                    <div class="card-body">
                        
                        <h4 class="card-title bg-secondary text-center text-white">Anxiety</h4>
                        <p class="card-text">
                            Ever wondered why you were trembling before your exam, or why your palms got sweaty before that job interview? These anxious feelings are a natural way for the body to prepare itself for an important event. You would have also noticed how you started to calm down once the event was under way; you started to breathe easier and your heart stopped thumping. Such an anxiety actually helps us perform better as it makes us more alert.</br>
                            However, some people experience anxiety or anxiety attacks for no apparent reason. If you find it hard to control your worries and if these constant feelings of anxiety affect your ability to go about your daily activities, then it might be a case of an anxiety disorder.

                        </p>
                      
                    </div>
                </div>

            </div>
            <!--card  section ended-->
           

        </div>


    </section>
    <!--Our services section ended here -->

    <!--****************************************************************************************************************************-->

    <!--Our consultants section started here -->
    <section class="our Consultants py-5 bg-light" id="Consultants">

        <div class="container text-center my-5" data-aos="fade-up" data-aos-offset="200">
            <h1>Our <span class="text-primary">Consultants</span></h1>
            <hr class="w-25 m-auto" />

            <div class="row my-5 bp-5" data-aos="zoom-in-right" data-aos-offset="200">


              <?php

 // front doctor section

               $get_doctor = "SELECT id ,name,image,specialty FROM doctor WHERE status=1";
               $get_doctor_run = mysqli_query($conn, $get_doctor);
               if(mysqli_num_rows($get_doctor_run) > 0){
                while($doctor = mysqli_fetch_array($get_doctor_run)){

                 $doctor_id = $doctor['id']; 

              ?>

                <div class="col-sm-12 col-md-4 col-lg-4 col-12">
                    <!--card 1 section start here-->
                    <div class="card ml-2 pl-2">
                        <div class="card-body">
                            <img src="images/doctor/<?php echo $doctor['image'];?>" class="img-fluid rounded-circle border border-primary p-2"
                                alt="">
                            <h5 class="card-title mt-4">Dr - <?php echo $doctor['name'] ;?></h5>
                            <p class="card-text">
                                <hr>
                            <strong> specialities - </strong><?php echo $doctor['specialty'] ;?></p>
                            
                            <a class="btn btn-info" href="Patient_oppiontment.php?doctor_patient_id=<?php echo $doctor_id;?>"><span class="glyphicon glyphicon-edit"></span> Appointment</a>
                        </div>
                    </div><br><br>
                    
                </div>
                <?php  
        }

           }else{
                   echo "<h4>No Doctor Found!</h4>";

              } ?>


            </div>
        </div>
        
    </section>
    <!--Our consultants section ended here -->

    <!--###########################################################################################################-->



<!-- form modal end -->

<!--doctor registration form model start-->




<!--end form-->


    <?php
    
    include('includes/footer.php');
   ?>

    <!-- aos ended here-->

</body>

</html>