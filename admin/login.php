<?php
error_reporting(0);
    include('includes/connection.php');
    session_start();
   // admin = 1
   // doctor = 2
   // patient= 3
   if(isset($_POST['login_btn'])){

       $username = $_POST['username'];
       $password = $_POST['password'];
       $rule = $_POST['rule'];
       if($rule  == 1){
        $admin = "SELECT id,username,password FROM admin WHERE rule='$rule'";
        $admin_run = mysqli_query($conn,$admin);
        $admin_data = mysqli_fetch_array($admin_run);
       // $rule_db =  $admin_data['rule'];
        $username_db =  $admin_data['username'];
        $password_db =  $admin_data['password'];
        if($username == $username_db  &&  $password == $password_db ){
               $_SESSION['RULE'] = 1; // $admin_data['rule']; 
               $_SESSION['IS_LOGIN'] = 'yes';

                    header('Location: index.php');

        }else{

               echo "<script>alert('username or password in incorrect')</script>";
        }

       }

       else if($rule  == 2){
        $doctor = "SELECT id,name,password, rule FROM doctor WHERE rule='$rule'";
        $doctor_run = mysqli_query($conn,$doctor);
        $doctor_data = mysqli_fetch_array($doctor_run);
        $username_id =  $doctor_data['id'];
        $username_rule =  $doctor_data['rule'];
        $username_db =  $doctor_data['name'];
        $password_db =  $doctor_data['password'];
        if($username == $username_db  &&  $password == $password_db &&  $username_rule == 2){
               $_SESSION['RULE'] =  2; 
               $_SESSION['IS_LOGIN'] = 'yes';
               $_SESSION['DOCTOR_ID'] = $username_id;
                    header('Location: index.php');

        }else{
              echo "<script>alert('username or password in incorrect')</script>";
        }

       }

       else if($rule  == 3){
        $patient = "SELECT id,name,password FROM patients WHERE rule='$rule'";
        $patient_run = mysqli_query($conn,$patient);
        $patient_data = mysqli_fetch_array($patient_run);
        $patient_id = $patient_data['id'];
        $username_db =  $patient_data['name'];
        $password_db =  $patient_data['password'];
        if($username == $username_db  &&  $password == $password_db){
            $_SESSION['RULE'] =  3; 
            $_SESSION['patient_id'] = $patient_id;
               $_SESSION['IS_LOGIN'] = 'yes';
                    header('Location: index.php');

        }else{
              echo "<script>alert('username or password in incorrect')</script>";
        }

       }







       }
    
      
         
   




?>

<!DOCTYPE html>
<html lang="zxx">

<?php include('includes/header.php')?>

<body class="crm_body_bg">



    <!-- main content part here -->

<a class="btn btn-success " href="../index.php" target="_blank">Home Page</a>
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_box mb_30">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <!-- sign_in  -->
                                <div class="modal-content cs_modal">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Psychology-Clinic </h5>
                                        <h4 class=" text-success">Log-IN</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">

                                            <div class="border_style">
                                                <span>Admin | Doctor | Patient</span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control"
                                                    placeholder="Enter your UserName" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Password" autocomplete="off" required>
                                            </div>


                                            <div class="form-group">
                                                <select class="form-select form-control" name="rule"
                                                    aria-label="Default select example">
                                                    <option selected>Select Rule : Who you are ?</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Doctor</option>
                                                    <option value="3">Patient</option>
                                                </select>
                                            </div>

                                            <button type="submit" name="login_btn"
                                                class="btn btn-info w-100">LogIn</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



            </div>
        </div>




        <!-- footer part -->
        <?php  include('includes/footer.php')?>

</body>

<!-- Mirrored from demo.dashboardpack.com/hospital-html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Sep 2021 04:58:57 GMT -->

</html>