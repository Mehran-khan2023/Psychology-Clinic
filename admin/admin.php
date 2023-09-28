<?php
error_reporting(0);
include('includes/connection.php');

session_start();



if(!isset($_SESSION['IS_LOGIN'])){
       header('location: login.php');
}else{
  //  header('location: index.php');
}




//update admin
if(isset($_GET['update_id'])){

    $update_id = $_GET['update_id'];
    $select = "SELECT * FROM admin WHERE id='$update_id'";
    $select_run = mysqli_query($conn,$select);
    $data = mysqli_fetch_array($select_run);
          $id = $data['id'];
          $username = $data['username'];
          $email = $data['email'];
          $password = $data['password'];

}
     if(isset($_GET['update'])){

         $id = $_GET['update_id'];
         $username = $_GET['username'];
         $email = $_GET['email'];

         $update = "UPDATE admin SET username='$username', email='$email' WHERE id ='$id'";
         $update_run = mysqli_query($conn,$update);
         if($update_run){
               echo "<script>alert('Record Update Successfully')</script>";
               header("location: admin.php");
                  exit;
         }else{

            echo "<script>alert('Sorry! Try Agin Later')</script>";
            exit;
         }

     }

     // admin delete

     if(isset($_GET['delete_id'])){

        $delete_id = $_GET['delete_id'];

        $delete_admin = "DELETE FROM admin WHERE id='$delete_id'";
        $delete_run = mysqli_query($conn, $delete_admin);
        if($delete_run){

          echo "<script>alert('Record Deleted Successfully')</script>";
          header("location: admin.php");
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

        <div class="container-fluid no-gutters">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="header_iner d-flex justify-content-between align-items-center">
                        <div class="sidebar_icon d-lg-none">
                            <i class="ti-menu"></i>
                        </div>
                        <div class="serach_field-area">
                            <h4 class="text-muted">Welcome to OPClinic Dashboard</h4>

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
                                <h4>Admin</h4>
                                <div class="box_right d-flex lms_block">


                                </div>
                            </div>

                            <div class="QA_table mb_30 table-responsive">
                                <!-- table-responsive -->
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">UserName</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Created Date</th>
                                            <th scope="col">Setting</th>


                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
                                // get admin record form db
                                 $get_admin = "SELECT * FROM admin";
                                 $get_admin = mysqli_query($conn, $get_admin);
                                 if(mysqli_num_rows($get_admin)){
                                  while($admin = mysqli_fetch_array($get_admin)){

                                  $id = $admin['id'];
                                  $username = $admin['username'];
                                  $email = $admin['email'];
                                  $created_date = $admin['created_date'];
                                          

                                
                                ?>

                                        <tr>

                                            <td><?php  echo $id; ?></td>
                                            <td><?php  echo $username; ?></td>
                                            <td><?php  echo $email; ?></td>
                                            <td><?php  echo $created_date; ?></td>
                                            <td><a href="admin.php?delete_id=<?php echo $id;?>"
                                                    class="btn btn-danger text-white">Delete</a>

                                                <button class="btn btn-info" data-toggle="modal" type="button"
                                                    data-target="#update_modal<?php echo $id;?>"><span
                                                        class="glyphicon glyphicon-edit"></span> Edit</button>
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



        <div class="modal fade  " id="update_modal<?php echo $id;?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="GET" action="" class="">
                        <div class="modal-header">
                            <h3 class="modal-title">Update Admin</h3>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-group ">
                                    <label>UserName</label>
                                    <input type="hidden" name="update_id" value="<?php echo $id;?>" />
                                    <input type="text" name="username" value="<?php echo $username;?>"
                                        class="form-control" required="required" />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?php echo $email;?>" class="form-control"
                                        required="required" />
                                </div>

                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="modal-footer">
                            <button name="update" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span>
                                Update</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal"><span
                                    class="glyphicon glyphicon-remove"></span> Close</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
        </div>





        <!-- footer part -->
        <?php  include('includes/footer.php')?>
</body>


</html>