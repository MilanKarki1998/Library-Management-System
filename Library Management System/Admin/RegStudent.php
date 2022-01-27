<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){   
	header('location:http://localhost/Summer%20Project/Home.php');
	}else{
		if(isset($_GET['inid'])){
			$id=$_GET['inid'];
			$status=0;
			$sql = "update students set Status='$status'  WHERE id='$id'";
			$result=mysqli_query($conn,$sql);
			if($result){
				header('location:RegStudent.php');
			}
		}
		//code for active students
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$status=1;
			$sql = "update students set Status='$status'  WHERE id='$id'";
			$result=mysqli_query($conn,$sql);
			if($result){
				header('location:RegStudent.php');
			}
		}
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
			<center id='center'><h2>Register Student's Lists</h2></center>
			<form method="POST" action="">
			<p align="right">
			<input type="text" name="keyword" id="keyword" placeholder="Search...">
			<input type="submit" name="Search" value="Search">
			</p>
			</form>
				<?php
				include("connect.php");
				if(isset($_POST['Search'])){
					$search=$_POST['keyword'];
					$query = "SELECT * FROM students WHERE StudentId like '%{$search}%' ||name like '%{$search}%' ||email like '$search' ||mobile like '$search' ";
					$result = mysqli_query($conn,$query);
				}else{
					$query = "select * from students";
					$result = mysqli_query($conn,$query);
				}
				$cnt=1;
				if(mysqli_num_rows($result)>0){
					echo '<section id="table-scroll">';
					echo '<table border="2" align="center" id="table" cellpadding="2" cellspacing="2">';
					echo '<tr>';
					echo '<th> S.N </th>';
					echo '<th> Student ID </th>';
					echo '<th> Name </th>';
					echo '<th> Email </th>';
					echo '<th> Mobile </th>';
					echo '<th> RegDate </th>';
					echo '<th> Status </th>';
					echo '<th> Action </th>';
					echo '</tr>';
					while($row = mysqli_fetch_assoc($result)){?>
						<tr>
						<td><?php echo $cnt ?></td>
						<td><?php echo $row["StudentId"]?></td>
						<td><?php echo $row["name"]?></td>
						<td><?php echo $row["email"]?></td>
						<td><?php echo $row["mobile"]?></td>
						<td><?php echo $row["RegDate"]?></td>
						<td><?php if($row['Status']==1){
                                                echo "Active";
                                            } else {
												echo "<p>Blocked</p>";
											}?></td>
						<td><?php if($row['Status']==1){?>
							<a href="RegStudent.php?inid=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to block this student?');" >  <button> Inactive</button>
						<?php } else {?>

							<a href="RegStudent.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to active this student?');"><button> Active</button> 
                        <?php } ?></td>
						</tr><?php $cnt=$cnt+1;
						}
					}else
						echo "<h1>0 Register Students<h1>";
					?>
				</table>
				</section>
			</div>
		</div>
	</body>
</html>