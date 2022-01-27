<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['login'])==0){ 
		header("Location:http://localhost/Summer%20Project/Home.php");
	}else{ 
		if(isset($_POST['update'])){
			$sid=$_SESSION['login'];
			$name=$_POST['name'];
			$mobile=$_POST['mobile'];
			$profileImageName = time() . '-' . $_FILES["image"]["name"];
			$target_dir = "images/";
			$target_file = $target_dir . basename($profileImageName);
			if($_FILES['image']['size'] < 200000) {
				if (empty($error)) {
					if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
						$sql="UPDATE students SET profile_image='$profileImageName', name='$name' ,mobile='$mobile' where StudentId='$sid'";
						$result=mysqli_query($conn,$sql);
						if($result){
							echo '<script>alert("Your Profile have been updated")</script>';
						}else{
							echo '<script>alert("Error Updating your profile")</script>';
						}
					}else{
						$sql="UPDATE students SET name='$name' ,mobile='$mobile' where StudentId='$sid'";
						$result=mysqli_query($conn,$sql);
						if($result){
							echo '<script>alert("Your Profile have been updated")</script>';
						}else{
							echo '<script>alert("Error Updating your profile")</script>';
						}
					}
				}
			}
		}
	}mysqli_close($conn);
?>
<html>
	<link rel="icon" type="image/ico" href="images/2.png" />
	<body style="background-color:black;">
		<style>
		     #body ul {
				float:right;
			}
			#body a {
				text-decoration:none; //defult is underline border
				font-weight:bolder;
				font-size:x-large;
				color:white;
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
			h1,h2,h4,h3,p {
				color:red;
			}
			th{
				color:Peru  ;
			}
			input,select{
				font-size:14pt;
				height:30px;
			}
			label{
				font-size:x-large;
			}
			.text-block {
				position: absolute;
				top: 30%;
				left:12%;
				background-color: black;
				color: white;
				padding-left: 80px;
				padding-right: 80px;
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
			}.dropbtn {
				background-color: black;
				color: white;
				padding: 15px;
				font-size: 16px;
				border: none;
				border-radius: 30px;
				font-size:x-large;
				color:white;
				font-family: "Times New Roman", Times, serif;
			}.dropdown {
				position: relative;
				display: inline-block;
			}.dropdown-content {
				display: none;
				position: absolute;
				border-radius: 30px;
				background-color: green;
				min-width: 160px;
				box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
				z-index: 1;  
			}.dropdown-content a {
				color: black;
				padding: 12px 16px;
				text-decoration: none;
				display: block;
				border-radius: 30px;
			}.dropdown-content a:hover {background-color: red;
			}.dropdown:hover .dropdown-content {display: block;
			}.dropdown:hover .dropbtn {background-color: red;}
		</style>
<script type="text/javascript">
			function valid(){
				var a = document.f1.mobile.value;
				var regName = /^[a-zA-Z]+ [a-zA-Z]+$/;
				var name = document.f1.name.value;
				if(!regName.test(name)){
					alert('Invalid name given.');
					return false;
				}
				if(isNaN(a)){
						alert("Enter the valid Mobile Number(Like :9566137117)");
						document.f1.mobile.focus();
						return false;
					}if((a.length!=10)){
						alert(" Your Mobile Number must be of 10 Integers and must start with 98");
						document.f1.mobile.select();
						return false;
					}if(a.charAt(0)!=9){
						alert(" Your Mobile Number must start with 98");
						document.f1.mobile.select();
						return false;
					}if(a.charAt(1)!=8){
						alert(" Your Mobile Number must start with 98");
						document.f1.mobile.select();
						return false;
					}return true;
				}
				var loadFile = function(event) {
		var image = document.getElementById('profileImage');
		image.src = URL.createObjectURL(event.target.files[0]);
		};
</script>
		<?php include('menu.php'); ?>
			<div class="text-block">
			<form name="f1" method="POST" enctype="multipart/form-data" onSubmit="return valid();">
			<center id="center"><h2>Profile</h2></center>
			<?php include('connect.php');
			$sid=$_SESSION['login'];
			$sql="SELECT * from  students  where StudentId='$sid'";
			$results=mysqli_query($conn,$sql);
			if(mysqli_num_rows($results)>0){
				while($rows=mysqli_fetch_assoc($results)){
					foreach($results as $result){               ?>  
				<?php if($rows['profile_image']!=""){?>
				<center><input type="file"  name="image" id="image"   onchange="loadFile(event)" style="display: none;">
						<label for="image" style="cursor: pointer;color:blue;"><u><-Change Photo-></u></label></p>
						<img id="profileImage" width="200" src="<?php echo 'images/' . $rows['profile_image']; ?>"/></center><?php } else {?>
						<center><input type="file"  name="image" id="image"   onchange="loadFile(event)" style="display: none;">
						<label for="image" style="cursor: pointer;color:green;"><u><-Change Photo-></u></label></p>
						<img id="profileImage" width="200" height="150" src="images/p.jpg"/></center>
						</i><?php } ?><br>
				<b>Student ID :</b><i><?php echo $rows['StudentId']; ?></i><br>
				<b>Reg Date :</b><i><?php echo $rows['RegDate']; ?></i><br>
				<?php if($rows['UpdationDate']!=""){?>
					<b>Last Updation Date :</b><i><?php echo $rows['UpdationDate'];?>
				<?php } ?></i><br>
				<b>Profile Status :</b><i><?php if($rows['Status']==1){?>
					<span style="color: green">Active</span>
					<?php } else { ?>
					<span style="color: red">Blocked</span>
				<?php }?></i><br>
				<b>Enter Name :</b><i><input type="text" name="name" value="<?php echo $rows['name'] ?>"/></i><br>
				<b>Enter Mobile Number :</b><i><input type="text" name="mobile" value="<?php echo $rows['mobile']; ?>"/></i><br>
				<b>Email :</b><i><input type="email" name="email" value="<?php echo $rows['email'];?>" required readonly /></i><br><br>
				<button class="button" type="submit" name="update" id="update">Update Now </button>
				<?php } } } 
				mysqli_close($conn);?>
				</form>
			</div>
		</div>
	</body>
</html>