<?php
error_reporting(0);
include('includes/connection.php');


session_start();
if(!isset($_SESSION['IS_LOGIN'])){

    header('Location: login.php');
    die();
}

     // patient delete

     if(isset($_GET['delete_id'])){

        $delete_id = $_GET['delete_id'];

        $delete_patient = "DELETE FROM patients WHERE id='$delete_id'";
        $delete_run = mysqli_query($conn, $delete_patient);
        if($delete_run){

          echo "<script>alert('Record Deleted Successfully')</script>";
          header("location: total_patient.php");
        }else{

            echo "<script>alert('Sorry! Please Try Again Later')</script>";
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
                                <h4>Patients List</h4>
                                <div class="box_right d-flex lms_block">

                                    <a class="btn btn-dark " href="patient_download.php">Export to Excel</a>
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
                                            <th scope="col">Blood Group</th>
                                            <th scope="col">Age</th>
                                            <th scope="col">WhatsApp</th>
                                            <th scope="col">Mobile Contact</th>
                                            <th scope="col">Village</th>
                                            <th scope="col">City</th>
                                            <th scope="col">District</th>
                                            <th scope="col">What Kind Of Problem</th>
                                            <th scope="col">status</th>
                                            <th scope="col">Create Date</th>
                                            <th scope="col">Setting</th>


                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
                                // get admin record form db
                                 $sno = 1;
                                 $get_patient = "SELECT * FROM patients";
                                 $get_patient = mysqli_query($conn, $get_patient);
                                 if(mysqli_num_rows($get_patient)){
                                  while($patient = mysqli_fetch_array($get_patient)){

                                  $id = $patient['id'];
                                  
                                  $created_date = $patient['created_date'];
                                  $status = $patient['status'];

                                    
                                ?>

                              <tr>
                                  <td><?php  echo $sno++ ?></td>
                                  <td><?php  echo $username = $patient['name']; ?></td>
                                  <td><?php  echo $password = $patient['password']; ?></td>
                                  <td><?php  echo $blood_group = $patient['blood_group']; ?></td>
                                  <td><?php  echo $age = $patient['age']; ?></td>
                                  <td><?php  echo $whatsapp = $patient['whatsapp']; ?></td>
                                  <td><?php  echo $mobile = $patient['mobile']; ?></td>
                                  <td><?php  echo $village = $patient['village']; ?></td>
                                  <td><?php  echo $city = $patient['city']; ?></td>
                                  <td><?php  echo $district = $patient['district']; ?></td>
                                  <td><?php  echo $problem = $patient['problem']; ?></td>
                                  <td><a href="test_status.php?status_id=<?php echo $id;?>"
                                    class="btn btn-success text-white"><?php 
                                    if ($status == 0) {
                                      echo "Inactive";
                                     }else{
                                      echo "Active";
                                     }
                                      ?></a></td>
                                  <td><?php  echo $created_date; ?></td>
                                  <td><a
                                    
                            onclick="return confirm('Are You Sure To Delete this Patient Record!')"

                                    href="total_patient.php?delete_id=<?php echo $id;?>"
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