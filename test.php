<?php 

   $conn  = mysqli_connect('localhost','root','','opc');


 
        // header('Location:test.php');
        // header('Location: admin/login.php');

      /

// $id = "rchexpertxdev";
// $pass = "BrandedSMS2";
// $lang = "English";
// $mask = "Xpertz Dev";

$id = "rchprimeggs";
$pass = "WebSol@938";
$lang = "English";
$mask = "Prime Eggs";

// Prepare data for POST request
//Data for text message
$to =  "923103388069";
$message = "Plase Check Patient oppointment of the  in OPC ";
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

echo"oppointment is complete";

 ?>

 <div class="modal fade bd-example-modal-l" id="exampleModal<?php echo $doctor_id;?>" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="" enctype="multipart/form-data">
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