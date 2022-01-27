<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){   
	header('location:http://localhost/Summer%20Project/Home.php');
	}else{ 
		if(isset($_POST['Add'])){
			$txt=$_POST['text'];
			$sql="INSERT INTO news(announcement) VALUES('$txt')";
			$result=mysqli_query($conn,$sql);
			if($result){
				header("Location:announcement.php");
			}else{
				echo '<script>alert("Has occur problem while inserting value")</script>';
			}
		}if(isset($_POST['del'])){
			$id=$_POST['id'];
			$sql="DELETE from news where News_Id = $id";
			$result=mysqli_query($conn,$sql);
			if($result){
				header("Location:announcement.php");
			}else{
				echo '<script>alert("Has occur problem while deleteing value")</script>';
			}
		}if(isset($_POST['delete'])){
			$id=$_POST['bid'];
			$sql="DELETE from bookreq where id = $id";
			$result=mysqli_query($conn,$sql);
			if($result){
				header("Location:announcement.php");
			}else{
				echo '<script>alert("Has occur problem while deleteing value")</script>';
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
			<?php
				include("connect.php");
				$query = "SELECT * from news";
				$result = mysqli_query($conn,$query);
				$cnt=1;
				if(mysqli_num_rows($result)>0){
					echo '<center id="center"><h2>Published Announcements</h2></center>';
					echo '<section id="table-scroll">';
					echo '<table border="2" align="center" id="table" cellpadding="2" cellspacing="2">';
					echo '<tr>';
					echo '<th> S.N </th>';
					echo '<th> Announcement </th>';
					echo '<th> Delete </th>';
					echo '</tr>';
					while($row = mysqli_fetch_assoc($result)){  ?>
						<tr>
						<td><?php echo $cnt; ?></td>
						<td><?php echo $row["announcement"]; ?></td>
						<form method='POST' action='announcement.php'>
							<input type='hidden' value="<?php echo $row['News_Id']; ?>" name='id'>
						<td><button name='del' type='submit' value='Delete' onclick='return Delete()'>DELETE</button></td>
						</form>
						</tr><?php
						$cnt=$cnt+1;
					}
				}
				?>
				</table>
				</section>
				<form method="POST">
						<center id="center"><h2>Publish New Announcements</h2></center>
						Announcement:<br>
						<textarea name="text" rows="4" cols="90"></textarea><br>
						<button type="submit"  name="Add" id="Add" style="float: right;">Submit </button>
				</form>
			</div>
		</div>
		<?php
				include("connect.php");
				$query = "SELECT * from bookreq";
				$result = mysqli_query($conn,$query);
				$cnt=1;
				if(mysqli_num_rows($result)>0){
					echo '<center id="center"><h2>Book Request</h2></center>';
					echo '<table border="2" align="center" id="table" cellpadding="2" cellspacing="2">';
					echo '<tr>';
					echo '<th> S.N </th>';
					echo '<th> Student Name </th>';
					echo '<th> Student ID </th>';
					echo '<th> Book Name </th>';
					echo '<th> Author </th>';
					echo '<th> Book Information </th>';
					echo '<th> Delete</th>';
					echo '</tr>';
					while($row = mysqli_fetch_assoc($result)){  ?>
						<tr>
						<td><?php echo $cnt; ?></td>
						<td><?php echo $row["Student_Name"]; ?></td>
						<td><?php echo $row["Student_ID"]; ?></td>
						<td><?php echo $row["Book_Name"]; ?></td>
						<td><?php echo $row["Author"]; ?></td>
						<td><?php echo $row["Information"]; ?></td>
						<form method='POST' action='announcement.php'>
							<input type='hidden' value="<?php echo $row['id']; ?>" name='bid'>
						<td><button name='delete' type='submit' value='Delete' onclick='return Delete()'>DELETE</button></td>
						</form>
						</tr><?php
						$cnt=$cnt+1;
					}
				}
				?>
				</table>
	</body>
</html>