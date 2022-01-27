<?php 
	include("connect.php");
	if(!empty($_POST["Email"])) {
		$email= $_POST["Email"];
			$sql ="SELECT * FROM students WHERE email='$email'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)> 0){
				while($rows = mysqli_fetch_assoc($result)){
				if($rows['Status']==0){
						echo "<input style='color:red' value='Student ID Blocked ' readonly>";
						echo "<script>$('#Send').prop('disabled',true);</script>";
					} else {
						echo "<input name='id' value=".$rows['StudentId']." readonly>";
						echo "<script>$('#Send').prop('disabled',false);</script>";
					}
				}
			}else{
			echo "<input size='40' style='color:red' value='Invaid Student Id. Please Enter Valid Student id' readonly>";
			echo "<script>$('#Send').prop('disabled',true);</script>";
		}
	}
?>
