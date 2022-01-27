<?php 
	require_once("connect.php");
	if(!empty($_POST["studentid"])) {
		$studentid= strtoupper($_POST["studentid"]);
		$sql ="SELECT name,Status FROM students WHERE StudentId='$studentid'";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while($rows = mysqli_fetch_assoc($result)){
					if($rows['Status']==0){
						echo "<span style='color:red'> Student ID Blocked </span>"."<br />";
						echo "<b>Student Name-</b>" .$rows['name'];
						echo "<script>$('#issue').prop('disabled',true);</script>";
					} else {
						echo $rows['name'];
						echo "<script>$('#issue').prop('disabled',false);</script>";
					}
				}
		}else{
			echo "<span style='color:red'> Invaid Student Id. Please Enter Valid Student id .</span>";
			echo "<script>$('#issue').prop('disabled',true);</script>";
		}
	}
?>
