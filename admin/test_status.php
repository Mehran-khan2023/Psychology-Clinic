<?php
include('includes/connection.php');
 if(isset($_GET['status_id']))
 {   
    echo $status_id = $_GET['status_id'];
     $status = "SELECT status FROM patients where id='$status_id'";
     $status_run = mysqli_query($conn, $status);
     $status_db = mysqli_fetch_array($status_run);
    echo $status_name = $status_db['status'];
     
     if($status_name == 0){
        $query = "UPDATE patients SET status = 1 WHERE id='$status_id'";
         $query_run = mysqli_query($conn, $query);
         header("location:total_patient.php");
        
     }else if($status_name == 1){
        $query = "UPDATE patients SET status = 0 WHERE id='$status_id'";
        $query_run = mysqli_query($conn, $query);
        header("location:total_patient.php");

     }
 }

?>