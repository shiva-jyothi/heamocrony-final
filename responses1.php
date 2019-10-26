<?php
$host = 'localhost';  
$user = 'root';  
$pass = '';  
$dbname = 'heamocrony';  
$conn = mysqli_connect($host, $user, $pass,$dbname);  
if(!$conn){  
  die('Could not connect: '.mysqli_connect_error());  
} 
$bg=$_POST['bgRequire'];
$latitude=$_POST['latitude1'];
$longitude=$_POST['longitude1'];
$addr=$_POST['addressValue'];
if($bg=='A+') 
$sql="select * from donar where blood_group in ('A-','A+','O-','O+')";
if($bg=='A-') 
$sql="select * from donar where blood_group in ('A-','O-')";
if($bg=='B+') 
$sql="select * from donar where blood_group in ('B-','B+','O-','O+')";
if($bg=='B-') 
$sql="select * from donar where blood_group in ('B-','O-')";
if($bg=='AB+') 
$sql="select * from donar";
if($bg=='AB-') 
$sql="select * from donar where blood_group in ('AB-','A-','O-','B-')";
if($bg=='O+') 
$sql="select * from donar where blood_group in ('O-','O+')";
if($bg=='O-') 
$sql="select * from donar where blood_group in ('O-')";
$res1=mysqli_query($conn,$sql);
if(mysqli_query($conn, $sql)){  
  echo "connected succesflly";
}
else{  
echo "Not able to send it: ". mysqli_error($conn);  
}  
$result1=mysqli_fetch_all($res1,MYSQLI_ASSOC);
mysqli_free_result($res1);
?>
<div id="r" ></div>
<script>
  <?php foreach ($result1 as $res): ?>
    //session_start();
    //$_SESSION['lat']=$res['latitude'];
    //$_SESSION['long']=$res['longitude'];
  
      function initMap() 
      {
        var o="<?php echo $latitude?>";
        var oo="<?php echo $longitude?>";
        var origin1 =new google.maps.LatLng(o,oo);
        var latt="<?php echo $res['latitude']?>";
        var longg="<?php echo $res['longitude']?>";
        var destination1=new google.maps.LatLng(latt,longg);
        var service = new google.maps.DistanceMatrixService;
        service.getDistanceMatrix(
          {
          origins: [{lat:o,lng:oo},'Greenwich, England'],
          destinations:[{lat:latt,lng:longg},'Stockholm, Sweden'],
         // origin:[{lat:o1,lng:o2}],
        // destination:[{lat:latt,lng:longg}],
          travelMode: 'DRIVING',
          unitSystem: google.maps.UnitSystem.METRIC,
          avoidHighways: false,
          avoidTolls: false
          }, 
          function(response, status) 
          {
            if (status !== 'OK') 
            {
              alert('Error was: ' + status);
              console.log(error);
            } 
            else 
            {
              var originList = response.originAddresses;
              var destinationList = response.destinationAddresses;
              console.log(response);
              var results = response.rows.elements[0].distance.text;  
              document.getElementById("r").innerHTML=results;

            }
        });
      }
        <?php $sql2="update donar set distance=results where latitude={$res['latitude']}and longitude={$res['longitude']}";
         mysqli_query($conn,$sql2);?>
  <?php endforeach ?>
</script>
// <?php 
if($bg=='A+') 
$sql3="select * from donar where blood_group in ('A-','A+','O-','O+') order by distance";
if($bg=='A-') 
$sql3="select * from donar where blood_group in ('A-','O-') order by distance";
if($bg=='B+') 
$sql3="select * from donar where blood_group in ('B-','B+','O-','O+') order by distance";
if($bg=='B-') 
$sql3="select * from donar where blood_group in ('B-','O-') order by distance";
if($bg=='AB+') 
$sql3="select * from donar order by distance";
if($bg=='AB-') 
$sql3="select * from donar where blood_group in ('AB-','A-','O-','B-') order by distance";
if($bg=='O+') 
$sql3="select * from donar where blood_group in ('O-','O+') order by distance";
if($bg=='O-') 
$sql3="select * from donar where blood_group in ('O-') order by distance";
 		$res3=mysqli_query($conn,$sql3);
 		$donors = mysqli_fetch_all($res3,MYSQLI_ASSOC);
 		mysqli_free_result($res3);
		$sql4="update location set distance=0 ";
		mysqli_query($conn,$sql4);
		mysqli_close($conn);
?>
<script async defer 
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCV8ro3-SJ5y0JA5zRkQh_MmpUWqa0DiQ&callback=initMap">
</script>
<!DOCTYPE html>
<html>
<head>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
	<body>
	<h4 class="center grey-text">Eligible donars</h4>
	<div class="container">
		<div class="row">
			<?php foreach($donors as $don){ ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($don['name']); ?></h6>
							<div>Ph.no:<?php echo htmlspecialchars($don['ph_no']); ?></div>
							<div>Email_id:<?php echo htmlspecialchars($don['email_id']); ?></div>
							<div>Distance in km:<?php echo htmlspecialchars($don['distance']); ?></div>
							<div>Blood group:<?php echo htmlspecialchars($don['blood_group']); ?></div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	</body>
</html>