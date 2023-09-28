<?php
error_reporting(0);
include('includes/connection.php');


session_start();
if(!isset($_SESSION['IS_LOGIN'])){

    header('Location: login.php');
    die();
}

 // doctor delete

 if(isset($_GET['delete_id'])){

    $delete_id = $_GET['delete_id'];

    $delete_doctor = "DELETE FROM doctor WHERE id='$delete_id'";
    $delete_run = mysqli_query($conn, $delete_doctor);
    if($delete_run){

      echo "<script>alert('Record Deleted Successfully')</script>";
      header("location: total_doctor.php");
    }else{

        echo "<script>alert('Sorry! Please Try Again Later')</script>";
    }
 }

 if(isset($_GET['status_id']))
 {   
     $status_id = $_GET['status_id'];
     $status = "SELECT status FROM doctor where id='$status_id'";
     $status_run = mysqli_query($conn, $status);
     $status_db = mysqli_fetch_array($status_run);
     $status_name = $status_db['status'];
     
     if($status_name == 0) //here i had changed inactive to Active
     {
        $query = "UPDATE doctor SET status = 1 WHERE id='$status_id'";
         $query_run = mysqli_query($conn, $query);
         header("location:total_doctor.php");
     

     }else if($status_name == 1)//here i have changed Active to inactive
     {
        $query = "UPDATE doctor SET status = 0 WHERE id='$status_id'";
        $query_run = mysqli_query($conn, $query);
        header("location:total_doctor.php");

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
                                <h4>Doctors List</h4>

                                <div class="box_right d-flex lms_block">

                                    <a class="btn btn-dark " href="doctor_download.php">Export to Excel</a>
                                </div>
                            </div>

                            <div class="QA_table mb_30 table-responsive">
                                <!-- table-responsive -->
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">whatsApp</th>
                                            <th scope="col">Skype Id</th>
                                            <th scope="col">Specialty</th>
                                            <th scope="col">Degree</th>
                                            <!-- <th scope="col">Certificate</th> -->
                                            <!-- <th scope="col">Date Unavalible</th> -->
                                            <th scope="col">status</th>
                                            <th scope="col">Create Date</th>
                                            <th scope="col">Setting</th>


                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
                                // get admin record form db
                                 $get_doctor = "SELECT * FROM doctor";
                                 $get_doctor = mysqli_query($conn, $get_doctor);
                                 if(mysqli_num_rows($get_doctor)){
                                  while($doctor = mysqli_fetch_array($get_doctor)){

                                  $id = $doctor['id'];
                                  $username = $doctor['name'];
                                  $password = $doctor['password'];
                                  $email = $doctor['email'];
                                  $phone = $doctor['phone'];
                                  $whatsapp = $doctor['whatsapp'];
                                  $skype_id = $doctor['skype_id'];
                                  $specialty = $doctor['specialty'];
                                  $degree = $doctor['degree'];
                                //   $certificate = $doctor['certificate'];
                                //   $date_unavalible = $doctor['date_unavalible'];
                                  $status = $doctor['status'];
                                  $create_date = $doctor['created_date'];

                                 
                                ?>

                                        <tr>

                                            <td><?php  echo $id; ?></td>
                                            <td><?php  echo $username; ?></td>
                                            <td><?php  echo $password; ?></td>
                                            <td><?php  echo $email; ?></td>
                                            <td><?php  echo $phone; ?></td>
                                            <td><?php  echo $whatsapp; ?></td>
                                            <td><?php  echo $skype_id; ?></td>
                                            <td><?php  echo $specialty; ?></td>
                                            <td><?php  echo $degree; ?></td>
                                           <!--  //here i had deleted both Unavalible date and also certificate sections -->
                                            <td><a href="total_doctor.php?status_id=<?php echo $id;?>"
                                           class="btn btn-success text-white"><?php 
                                            if ($status == 0) {
                                              echo "<b style='color:red'>Inactive</b>";
                                             }else{
                                              echo "Active";
                                             }
                                            ?></a></td>
                                            <td><?php  echo $create_date; ?></td>
                                            <td><a  onclick="return confirm('Are You Sure To Delete this Doctor Record!')" href="total_doctor.php?delete_id=<?php echo $id;?>"
                                                    class="btn btn-danger text-white">Delete</a>


                                            </td>
                                            <?php
                                 
                                } // end while
                                    

                            }else{
                               // echo "<h4>No Admin Found!</h4>";
                            }  // end if
                          
                                 
                                 ?>
                                        </tr>


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