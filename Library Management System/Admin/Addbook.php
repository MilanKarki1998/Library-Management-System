<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){   
		header('location:http://localhost/Summer%20Project/Home.php');
	}else{ 

		if(isset($_POST['Add'])){
			$name=$_POST['name'];
			$cat=$_POST['Category'];
			$aut=$_POST['Author'];
			$isbn=$_POST['ISBN'];
			$price=$_POST['Price'];
			$copies=$_POST['Copies'];
			$sql="INSERT INTO books(Book_Name,Category,Author,ISBN,Price,TCopies,Copies) VALUES('$name','$cat','$aut','$isbn','$price','$copies','$copies')";
			$result=mysqli_query($conn,$sql);
			if($result){
				header("Location:Books.php");
			}else{
				echo '<script>alert("Has occur problem while inserting value")</script>';
			}
		}
		mysqli_close($conn);
	}
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
		<?php include('menu.php'); ?>
			<div class="text-block">
				<form method="POST" name='Add' enctype="multipart/form-data">
						<center id='center'><h2>New Book Add Form</h2></center>
						<table id='table'>
						<tr><td><label>Book Name:</label></td><td><input type="text" name="name" autocomplete="off" required></td></tr>
						<tr><td><label>Category:</label></td><td><select  name="Category">
							<option>History</option>
							<option>Comics</option>
							<option>Fiction</option>
							<option>Non-Fiction</option>
							<option>Biography</option>
							<option>Medical</option>
							<option>Fantasy</option>
							<option>Education</option>
							<option>Sports</option>
							<option>Technology</option>
							<option>Literature</option>
						</select></td></tr>
						<tr><td><label>Author:</label></td><td><input type="text" name="Author" autocomplete="off" required></td></tr>
						<tr><td><label>ISBN:</label></td><td><input type="text" name="ISBN" autocomplete="off" required></td></tr>
						<tr><td><label>Price:</label></td><td><input type="number" name="Price" autocomplete="off" required min="0" oninput="validity.valid||(value='');"></td></tr>
						<tr><td><label>Copies:</label></td><td><input type="number" name="Copies" autocomplete="off" required min="0" oninput="validity.valid||(value='');"></td></tr>
						</table><br>
						<button class="button" type="submit" name="Add" id="Add">Add Now </button>
				</form>
			</div>
		</div>
	</body>
</html>