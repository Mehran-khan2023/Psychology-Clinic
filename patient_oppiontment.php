<?php

include('includes/connection.php');
 
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

        if ($responce) {
         	header('Location: admin/login.php');
         }else{
         	echo'error';
         }

    
         
}}
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

<br>
<div class="container mt-5">
	<div class="row justify-content-center pt-5">
		<div class="col-md-8">
			<form method="post" action="patient_oppiontment.php" style="background: lightgray">

				<div class="modal-header">
					<h3 class="modal-title">Patient Registration</h3>

				</div>
				<div class="modal-body">
					<div class="col-md-12"></div>
					<div class="col-md-12">

				<?php
				if (isset($_GET['doctor_patient_id'])) {
					echo $doctor_id = $_GET['doctor_patient_id'];

					$query= "select * from doctor where id='$doctor_id'";
					$exicute = mysqli_query($conn,$query);

					$fetch = mysqli_fetch_array($exicute);

					echo $fetch['1'];
					?>
				

						<div class="form-group ">
							<label>Name</label>
							<input type="hidden" value="<?php echo $fetch['0'];?>" name="doctor_id" >
							<?php
							}
							?>
							<input type="text" name="username"  class="form-control" required="required"/>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password"  class="form-control" required="required" />
						</div>
                        <div class="form-group">
                                            <select class="form-select form-control" name="blood_group" aria-label="Default select example" required="required">
                                            <option selected>Select Blood Group</option>
                                            <option value="a">A</option>
                                            <option value="b">B</option>
                                            <option value="o">O</option>
                                            <option value="a+">A+</option>
                                            <option value="a-">A-</option>
                                            <option value="b+">B+</option>
                                            <option value="b-">B-</option>
                                            <option value="o+">O+</option>
                                            <option value="o-">O-</option>
                                            </select>
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
							<label>Date Of Birth</label>
							<input type="date" name="age"  class="form-control" required="required" />
						</div>
                        <div class="form-group">
							<label>WhatsApp</label>
							<input type="text" name="whatsapp"  class="form-control" />
						</div>
                        <div class="form-group">
							<label>Mobile No</label>
							<input type="text" name="mobile"  class="form-control" required="required" />
						</div>
                        <div class="form-group">
							<label>Village</label>
							<input type="text" name="village"  class="form-control" required="required" />
						</div>
                        <div class="form-group">
							<label>City</label>
							<input type="text" name="city"  class="form-control" required="required" />
						</div>
                        <div class="form-group">
							<label>District</label>
							<input type="text" name="district"  class="form-control" required="required" />
						</div>

                         <div class="form-group">
                        <label>What Kind Of Problem </label>
                        <select class="form-select form-control" name="problem" aria-label="Default select example" required="required">
                        <option selected>----Select---- </option>
                        <option value="male">Stress</option>
                        <option value="male">Anxiety</option>
                        <option value="Career Selection">Career Selection</option>
                        <option value="Kid Development Style">Kid Development Style</option>
                  
                        </select>
                        </div>

                       
						
					</div>
				</div>
				<div style="clear:both;"></div>
				<div class="modal-footer">
					<button name="booking" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span>Booking</button>
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