<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){   
		header('location:http://localhost/Summer%20Project/Home.php');
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
				<center id="center"><h2>Edit Book</h2></center>
				<?php
				include("connect.php");
				$id=$_GET['id'];
				$query = "SELECT * FROM books WHERE id=$id";
				$result = mysqli_query($conn,$query);
				if(mysqli_num_rows($result)>-1){
					while($row = mysqli_fetch_assoc($result)){ ?>
						<form action="update.php?id=<?php echo $id ?>" method="POST">
						<table id="table">
							<tr><td><label>Book Name:</label></td><td><input type="text" name="Name" value="<?php echo $row['Book_Name'] ?>" autocomplete="off"></td></tr>
							<tr><td><label>Category:</label></td><td><select  name="Cat">
							<option <?php if($row['Category']=="History"){echo "selected";}?>>History</option>
							<option <?php if($row['Category']=="Comics"){echo "selected";}?>>Comics</option>
							<option <?php if($row['Category']=="Fiction"){echo "selected";}?>>Fiction</option>
							<option <?php if($row['Category']=="Non-Fiction"){echo "selected";}?>>Non-Fiction</option>
							<option <?php if($row['Category']=="Biography"){echo "selected";}?>>Biography</option>
							<option <?php if($row['Category']=="Medical"){echo "selected";}?>>Medical</option>
							<option <?php if($row['Category']=="Fantasy"){echo "selected";}?>>Fantasy</option>
							<option <?php if($row['Category']=="Education"){echo "selected";}?>>Education</option>
							<option <?php if($row['Category']=="Sports"){echo "selected";}?>>Sports</option>
							<option <?php if($row['Category']=="Technology"){echo "selected";}?>>Technology</option>
							<option <?php if($row['Category']=="Literature"){echo "selected";}?>>Literature</option>
							</select></td></tr>
							<tr><td><label>Author:</label></td><td><input type="text" name="Aut" value="<?php echo $row['Author'] ?>" autocomplete="off"></td></tr>
							<tr><td><label>ISBN:</label></td><td><input type="text" name="isbn" value="<?php echo $row['ISBN'] ?>" autocomplete="off"></td></tr>
							<tr><td><label>Price:</label></td><td><input type="text" name="pri" value="<?php echo $row['Price'] ?>" autocomplete="off"></td></tr>
							<tr><td><label>Copies:</label></td><td><input type="text" name="copies" value="<?php echo $row['Copies'] ?>" autocomplete="off"></td></tr>
						</table><br>
							<input class="button" type="submit" value="Update">
						</form>
						<?php
					}
				}mysqli_close($conn);
				?>
			</div>
		</div>
	</body>
</html>