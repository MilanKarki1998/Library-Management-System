<?php 
	include("connect.php");
	if(!empty($_POST["email"])) {
		$email= $_POST["email"];
		if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
			echo "<span style='color:red'>error : You did not enter a valid email.</span>";
			echo "<script>$('#signup').prop('disabled',true);</script>";
		}else {
			$sql ="SELECT email FROM students WHERE email='$email'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)> 0){
				echo "<span style='color:red'> Email already exists .</span>";
				echo "<script>$('#signup').prop('disabled',true);</script>";
			}else{
				echo "<span style='color:green'> Email available for Registration .</span>";
				echo "<script>$('#signup').prop('disabled',false);</script>";
			}
		}
	}
?>
