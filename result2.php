<?php
$name1=$_POST['name'];
$ph_no1=$_POST['ph_no'];
$email_id1=$_POST['email_id'];
$distance1=$_POST['distance'];
$blood_group1=$_POST['blood_group'];

?>
<html>
<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	</head>
	<body>
		<img src="tenor.gif" width=400 height=400 alt=image style="float:right;padding-right: 100px;padding-top:50px;margin-right: 50px; ">
		<div class="card" style="width: 18rem;margin-top: 50px;margin-left: 50px;">
			
				<div class="card z-depth-0">
						<div class="card-body">

		<form action="heamocrony.php" method="POST">
			<div class="card-title" style="color:green">A personal note to donor </div>
			<div class="card-text"> Name of donor</div>
			<input type=text  class="card-text" name="name" value="<?php echo $name1;?>">
			<div class="card-text"> Phone no:</div>
			<input type=text class="card-text" name="ph_no" value="<?php echo $ph_no1;?>">
			<div class="card-text"> Emailid</div>
			<input type=text  class="card-text"name="email_id" value="<?php echo $email_id1;?>" size="30">
			<div class="card-text"> Distance</div>
			<input type=text  class="card-text"name="distance" value="<?php echo $distance1;?>">
			<div class="card-text">Blood_group</div>
			<input type=text class="card-text"name="blood_group" value="<?php echo $blood_group1;?>">
			<div class="card-text"> Message</div>
			<textarea rows="5" cols="25" name="message"></textarea>
			<br>
			<br>
			<button type="submit" class="btn btn-primary">send</button>


		</form>
	</div>
</div>
</div>
	</body>
</html>