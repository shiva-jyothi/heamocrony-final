<?php
$host = 'localhost';  
$user = 'root';  
$pass = '';  
$dbname = 'heamocrony';  
$conn = mysqli_connect($host, $user, $pass,$dbname);  
if(!$conn){  
  die('Could not connect: '.mysqli_connect_error());  
} 
session_start();
$bg=$_POST['bgRequire'];
$_SESSION['bgRequire']=$bg;
$addr=$_POST['addressValue'];
if($bg=='A+') 
$sql="select * from donor where blood_group in ('A-','A+','O-','O+')";
if($bg=='A-') 
$sql="select * from donor where blood_group in ('A-','O-')";
if($bg=='B+') 
$sql="select * from donor where blood_group in ('B-','B+','O-','O+')";
if($bg=='B-') 
$sql="select * from donor where blood_group in ('B-','O-')";
if($bg=='AB+') 
$sql="select * from donor";
if($bg=='AB-') 
$sql="select * from donor where blood_group in ('AB-','A-','O-','B-')";
if($bg=='O+') 
$sql="select * from donor where blood_group in ('O-','O+')";
if($bg=='O-') 
$sql="select * from donor where blood_group in ('O-')";
$res1=mysqli_query($conn,$sql);
if(mysqli_query($conn, $sql)){  
}
else{  
echo "Not able to send it: ". mysqli_error($conn);  
}  
$result1=mysqli_fetch_all($res1,MYSQLI_ASSOC);
mysqli_free_result($res1);
// mysqli_close($conn);
// $len:=$result1.length;
?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<script>
	  var dList=[];
	  <?php foreach($result1 as $resu){ ?>
		var add="<?php echo $resu['address']?>";
    	dList.push(add);
	  <?php }?>
      //console.log(dList);
      function initMap() 
      {
        var origin1 ="<?php echo $addr?>";
        var service = new google.maps.DistanceMatrixService;
        service.getDistanceMatrix(
          {
          origins: [origin1],
          destinations: dList,
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
            } 
            else 

            {
              var originList = response.originAddresses;
              var destinationList = response.destinationAddresses;
              for (var i = 0; i < originList.length; i++) 
              {
                var results = response.rows[i].elements;
                console.log(results.length);
                console.log(results);
                for (var j=0;j<results.length;j++)
                {
                  document.cookie='dist='+results[j].distance.text;
                  document.cookie='addre='+dList[j];
                  console.log(results[j].distance.text);
                  console.log(dList[j]);
                  //console.log($_COOKIE["dist"]);
                  <?php 
                  //echo "Hello";
                  if(isset($_COOKIE["dist"]))
                  { 
                    $dist=$_COOKIE["dist"];
                    $addre=$_COOKIE["addre"];
                    //echo "Hello";
                    $sql2="update donor set distance={$dist} where address={$addre}" ;
                    $resultDummy=mysqli_query($conn,$sql2);
                    if(mysqli_query($conn,$sql2)){
                      echo "updated";
                    }
                    else{
                      echo "failed to update";
                    }
                  }
                  else{
                    echo "cookie not set";
                  }
                  ?>
                }
              }
            }
        });  
      }
</script>
<script async defer 
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCV8ro3-SJ5y0JA5zRkQh_MmpUWqa0DiQ&callback=initMap">
</script>
<?php
if($bg=='A+') 
$sql3="select * from donor where blood_group in ('A-','A+','O-','O+')";
if($bg=='A-') 
$sql3="select * from donor where blood_group in ('A-','O-')";
if($bg=='B+') 
$sql3="select * from donor where blood_group in ('B-','B+','O-','O+')";
if($bg=='B-') 
$sql3="select * from donor where blood_group in ('B-','O-')";
if($bg=='AB+') 
$sql3="select * from donor";
if($bg=='AB-') 
$sql3="select * from donor where blood_group in ('AB-','A-','O-','B-')";
if($bg=='O+') 
$sql3="select * from donor where blood_group in ('O-','O+')";
if($bg=='O-') 
$sql3="select * from donor where blood_group in ('O-')";
$res3=mysqli_query($conn,$sql3);
$donors = mysqli_fetch_all($res3,MYSQLI_ASSOC);
mysqli_free_result($res3);
// $sql4="update donor set distance=0 ";
// mysqli_query($conn,$sql4);
mysqli_close($conn);
?>
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