<?php
$name=$_POST['name'];
$date=$_POST['date'];
$BloodGroup=$_POST['BloodGroup'];
$phno=$_POST['phno'];
$gender=$_POST['gender'];
$email=$_POST['mail'];
//$area=$_POST['address'];
$latitude1=$_POST['latitude'];
$longitude1=$_POST['longitude'];
 $current_year = date('Y'); // Get Current Year
 $dob = date_parse($date); // Yours Dob
 $year = $dob["year"]; // Get dob Year "1995" 
 $age = ($current_year - $year); // 2017-1995 is Yours Age 

$conn=new mysqli('localhost','root','','heamocrony');
if($conn->connect_error)
{
	die('Connection Failed : '.$conn->connect_error);
}
else
{
	$stmt=$conn->prepare("insert into donar(name,age,blood_group,ph_no,gender,email_id,latitude,longitude) values(?,?,?,?,?,?,?,?)");
	$stmt->bind_param("sissssss",$name,$age,$BloodGroup,$phno,$gender,$email,$latitude1,$longitude1);
	$stmt->execute();
	echo "successful submission";
}
   ?>