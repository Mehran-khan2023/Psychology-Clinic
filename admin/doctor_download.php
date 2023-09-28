<?php
error_reporting(0);
include('includes/connection.php');

 
  
    
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "Doctors_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('FULL NAME', 'GENDER','EMAIL','PHONE','WHATSAPP','SKYPE_ID','SPACIALTY','APPOINTMENT FEE','DATE OF JOIN'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $conn ->query("SELECT * FROM doctor ORDER BY id ASC"); 
if($query->num_rows > 0){ 
    // Output each row of the data
     
    while($row = $query->fetch_assoc()){ 
       // $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['name'], $row['gender'],$row['email'],$row['phone'],$row['whatsapp'],$row['skype_id'],$row['specialty'],$row['appointment_fee'],$row['created_date']); 
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