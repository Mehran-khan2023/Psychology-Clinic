<?php
error_reporting(0);
include('includes/connection.php');
session_start();

if(!isset($_SESSION['IS_LOGIN'])){
       header('location: login.php');
}else{
  //  header('location: index.php');
}
 
  
    
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "Doctors_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('FULL NAME', 'GENDER','BLOOD GROUP','AGE','WHATSAPP','MOBILE','SKYPE_ID','VILLAGE','CITY','DISTRICT','PROBLEM','VISTING DATE'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $conn ->query("SELECT * FROM patients ORDER BY id ASC"); 
if($query->num_rows > 0){ 
    // Output each row of the data
     
    while($row = $query->fetch_assoc()){ 
       // $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['name'], $row['gender'],$row['blood_group'],$row['age'],$row['whatsapp'],$row['mobile'],$row['village'],$row['city'],$row['district'],$row['problem'],$row['created_date']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}

 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;



    



?>