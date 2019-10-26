<?php  
$host = 'localhost';  
$user = 'root';  
$pass = '';  
$dbname = 'startup';  
$conn = mysqli_connect($host, $user, $pass,$dbname);  
if(!$conn){  
  die('Could not connect: '.mysqli_connect_error());  
}  
echo 'Connected successfully<br/>';  
$username1=$_POST["mailid"];
$password1=$_POST["pwd"]; 
$sql = "SELECT * FROM organisation where email='$username1' and password='$password1'";  
$retval=mysqli_query($conn, $sql);  
  
if(mysqli_num_rows($retval) > 0){  
echo "you are a authorized user";
 
}
else{  
echo "Invalid Details";
}  
mysqli_close($conn);  
?>  