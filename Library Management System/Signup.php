<?php
  session_start();
	include('connect.php');
	error_reporting(0);
	if(isset($_POST['signup'])){
		$count_my_page = ("studentid.txt");
		$hits = file($count_my_page);
		$hits[0] ++;
		$fp = fopen($count_my_page , "w");
		fputs($fp , "$hits[0]");
		fclose($fp); 
		$sid= $hits[0];
		$name=$_POST['name'];
		$mobile=$_POST['mobile'];
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		$status=1;
		// for the database
		$profileImageName = time() . '-' . $_FILES["image"]["name"];
		// For image upload
		$target_dir = "User/images/";
		$target_file = $target_dir . basename($profileImageName);
		// VALIDATION
		// validate image size. Size is calculated in Bytes
		if($_FILES['image']['size'] < 200000) {
			// Upload image only if no errors
			if (empty($error)) {
				if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
					$sql = "INSERT INTO students(profile_image,StudentId,name,mobile,email,password,Status) VALUES('$profileImageName','$sid','$name','$mobile','$email','$password','$status')";
					$result=mysqli_query($conn,$sql);
					if($result){
						echo '<script>alert("Your Registration successfull and your student id is  "+"'.$sid.'")</script>';
					}else{
						echo '<script>alert("Has occur problem while inserting value")</script>';
					}	
				}else {
					$sql = "INSERT INTO students(StudentId,name,mobile,email,password,Status) VALUES('$sid','$name','$mobile','$email','$password','$status')";
					$result=mysqli_query($conn,$sql);
					if($result){
						echo '<script>alert("Your Registration successfull and your student id is  "+"'.$sid.'")</script>';
					}else{
						echo '<script>alert("Has occur problem while inserting value")</script>';
					}	
				}
			}
		}else{
			echo '<script>alert("Image size should not be greated than 200Kb")</script>';
		}
	}
?>
<html>
<head>
	<title>User Signup</title>
</head>
	<link rel="icon" type="image/ico" href="images/2.png" />
	<body style="background-color:black;">
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript">
			function valid(){
				var a = document.signup.mobile.value;
				var regName = /^[a-zA-Z]+ [a-zA-Z]+$/;
				var name = document.signup.name.value;
				if(!regName.test(name)){
					alert('Invalid name given.');
					return false;
				}
					if(document.signup.password.value!= document.signup.confirmpassword.value){
						alert("Password and Confirm Password Field do not match  !!");
						document.signup.confirmpassword.focus();
						return false;
					}if(isNaN(a)){
						alert("Enter the valid Mobile Number(Like :9566137117)");
						document.signup.mobile.focus();
						return false;
					}if((a.length!=10)){
						alert(" Your Mobile Number must be of 10 Integers and must start with 98");
						document.signup.mobile.select();
						return false;
					}if(a.charAt(1)!=8){
						alert(" Your Mobile Number must start with 98");
						document.signup.mobile.select();
						return false;
					}if(a.charAt(1)!=8){
						alert(" Your Mobile Number must start with 98");
						document.signup.mobile.select();
						return false;
					}return true;
				}
			function checkAvailability() {
				$("#loaderIcon").show();
				jQuery.ajax({
				url:"check_availability.php",
				data:'email='+$("#email").val(),
				type: "POST",
				success:function(data){
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
				},
				error:function (){}
				});
			}
			var loadFile = function(event) {
			var image = document.getElementById('profileImage');
			image.src = URL.createObjectURL(event.target.files[0]);
			};		
			$(document).ready(function(){
			$("#pass").keyup(function(){
			check_pass();
		 });
		});
		function check_pass(){
			var val=document.getElementById("pass").value;
			var no=0;
			if(val!=""){
				// If the password length is less than or equal to 6
				if(val.length<=6)no=1;
				// If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
				if(val.length>6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))no=2;
				  // If the password length is greater than 6 and contain alphabet,number,special character respectively
				  if(val.length>6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))no=3;
				  // If the password length is greater than 6 and must contain alphabets,numbers and special characters
				  if(val.length>6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))no=4;
				  if(no==1){
					document.getElementById("pass_type").innerHTML="Very Weak";
				  }
				  if(no==2){
					document.getElementById("pass_type").innerHTML="Weak";
				  }
				  if(no==3){
					document.getElementById("pass_type").innerHTML="Good";
				  }
				  if(no==4){
					document.getElementById("pass_type").innerHTML="Strong";
				  }
			 }else{
				document.getElementById("pass_type").innerHTML="";
			 }
		}
		</script>		
		<style>
			#body ul {
				float:right;
			}
			#body li {
				display:inline;
				border-radius: 30px;
				background: Black;
				padding: 15px; 
			}
			#body a {
				text-decoration:none; //defult is underline border
				font-weight:bolder;
				font-size:x-large;
				color:white;
			}
			#body li:hover {
				background:red;
			}
			#body {
				width:100%;
			}
			#header-1-1 {
				height:14%;
				float:left;
				width:10%;
			}
			#header-1-2 {
				height:14%;
				float:right;
				width:90%;
			}
			input,select{
				font-size:14pt;
				height:30px;
			}
			h1,h4,h3,p {
				color:red;
			}
			th{
				color:Peru  ;
			}
			.text-block {
				position: absolute;
				top: 33%;
				left:25%;
				background-color: black;
				color: white;
				padding-left: 100px;
				padding-right: 100px;
				font-size:x-large;
			}
			#table{
				color:blue;
				width:100%;
			}
			#center{
				background-color:orange;
			}
			.button {
				display: inline-block;
				padding: 5px 5px;
				font-size: 20px;
				cursor: pointer;
				text-align: center;
				text-decoration: none;
				outline: none;
				color: #fff;
				background-color: #4CAF50;
				border: none;
				border-radius: 10px;
				box-shadow: 0 9px #999;
			}
			.button:hover {
				background-color: #3e8e41
			}
			.button:active {
				background-color: #3e8e41;
				box-shadow: 0 5px #666;
				transform: translateY(4px);
			}
			#table-scroll {
				height:200px;
				overflow:auto;  
			}
			#pass_type
			{
				font-size:20px;
				color:grey;
			}
		</style>
		<?php include('menu.php'); ?>
			<div class="text-block">
			<form name="signup" method="POST" enctype="multipart/form-data" onSubmit="return valid();">
					<center id="center"><h2>Signup Form</h2></center>
					<center><input type="file"  name="image" id="image"  onchange="loadFile(event)" style="display: none;">
						<label for="image" style="cursor: pointer;color:blue;" ><u><-Upload Your Photo-></u></label></p>
						<img id="profileImage" width="200" /></center>
					Full Name:<input type="text" name="name" autocomplete="off" required><br>
					Mobile No.:<input type="text" name="mobile" autocomplete="off" required><br>
					Email:<input type="text" name="email" id="email" onBlur="checkAvailability()" autocomplete="off" required>
					<span id="user-availability-status" style="font-size:20px;"></span> <br>
					Password:<input type="password" name="password" id="pass" autocomplete="off" required> <span id="pass_type"></span><br>
					Confirm Password:<input type="password" name="confirmpassword" autocomplete="off" required><br><br>
					<button class="button" type="submit" name="signup" id="signup">Register Now </button>
			</form>
			</div>
		</div>
	</body>
</html>