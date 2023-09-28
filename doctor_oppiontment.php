<?php
include('includes/connection.php');

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
                            <a class="nav-link active text-primary" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#About">About us</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#Services" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Our Services
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#Services">Services</a></li>
                                <li><a class="dropdown-item" href="#Services">1: Students</a></li>
                                <li><a class="dropdown-item" href="#Services">2: Elderss</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#Consultants">Our Consultants</a>
                        </li>
                        <li class="nav-item">
                            
                            <button class="btn btn-info p-2 m-2" data-toggle="modal" type="button" data-target="#exampleModal<?php echo $doctor_id;?>"><span class="glyphicon glyphicon-edit"></span>Doctor Registration</button>
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

<br>
<div class="container mt-5">
	<div class="row justify-content-center pt-5">
		<div class="col-md-8">
			 <form method="post" action="index.php" enctype="multipart/form-data" style="background: lightgray">
        <div class="modal-header">
          <h3 class="modal-title">Doctor Registration</h3>
        </div>
        <div class="modal-body">
          <div class="col-md-12"></div>
          <div class="col-md-12">
            <div class="form-group ">
              <label>Name</label>
              <input type="hidden" value="<?php echo $doctor_id;?>" name="doctor_id" >
              <input type="text" name="name"  class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password"  class="form-control" required="required" />
            </div>
                        

                                            <div class="form-group">
                                            <select class="form-select form-control" name="gender" aria-label="Default select example" required="required">
                                            <option selected>Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                          
                                            </select>
                                            </div>
                            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email"  class="form-control" required="required" />
                 </div>
                            <div class="form-group">
              <label>Mobile No</label>
              <input type="text" pattern=".{12,}" placeholder="no like 923xxxxxxxxx" title="no like 923xxxxxxxxx" name="mobile"  class="form-control" required="required" />
                 </div>
                        <div class="form-group">
              <label>WhatsApp</label>
              <input type="text" name="whatsapp"  class="form-control" required="required" />
            </div>
                        
                        <div class="form-group">
              <label>Skype Id</label>
              <input type="text" name="skype"  class="form-control" required="required" />
            </div>
                        <div class="form-group">
              <label>Unavalible Date</label>
              <input type="date" name="Unavalible"  class="form-control" required="required" />
            </div>
                        
                        <div class="form-group">
                        <label>Specialty</label>
              <textarea name="quality" class="form-control" cols="3" rows="3" required="required"></textarea>
            </div>
                        <div class="form-group">
                        <label>Appointment Fee</label>
              <input type="text" name="appointment_fee" class="form-control"  required="required"></input>
            </div>

                        <div class="form-group">
                        <label class="form-label">Upload Your Latest Images</label>
                         <input class="form-control" type="file" name="doctor_image" required="required" />
                        </div>

                        <div class="form-group">
                        <label class="form-label">Upload Your Latest Degree</label>
                         <input class="form-control" type="file" name="degree" required="required" />
                        </div>
                      
                        <div class="form-group">
                        <label class="form-label">Any Other Certificate</label>
                         <input class="form-control" type="file" name="certificate" />
                        </div>
            
          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="modal-footer">
          <button name="doctor_reg" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span>Registration</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
        </div>
        </div>
      </form>
		</div>
	</div>
	
</div>
			


<!--end form-->


    <?php
    
    include('includes/footer.php');
   ?>

    <!-- aos ended here-->

</body>

</html>