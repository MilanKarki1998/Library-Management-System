<?php
include("connect.php");
	if(isset($_POST['Send'])){
		$name=$_POST['name'];
		$id=$_POST['id'];
		$bname=$_POST['bname'];
		$author=$_POST['author'];
		$text=$_POST['text'];
		$sql="INSERT INTO bookreq(Student_Name,Student_ID,Book_Name,Author,Information) VALUES('$name','$id','$bname','$author','$text')";
		$result=mysqli_query($conn,$sql);
			if($result){
				header("Location:BookReq.php");
			}else{
				echo '<script>alert("Has occur problem while requesting book")</script>';
			}
	}
	mysqli_close($conn);
?>
<html>
<head>
	<title>Book Request</title>
</head>
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
		</style>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script>
			function getstudent() {
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "get_student.php",
	data:'Email='+$("#Email").val(),
	type: "POST",
	success:function(data){
	$("#get_student_id").html(data);
	$("#loaderIcon").hide();
	},
	error:function (){}
	});
	}

		</script> 
	<link rel="icon" type="image/ico" href="images/2.png" />
	<body style="background-color:black;">
		<?php include('menu.php'); ?>
			<div class="text-block">
				<form name="Send" method="POST" onSubmit="return check()">
					<center id="center"><h2>Book Request Form</h2></center>
					Student Name:<input type="text" id="name" name="name" autocomplete="off" required><br>
					Student Email:<input type="email" id="Email" onBlur="getstudent()" name="Email" autocomplete="off" required><br>
					Student ID:<span  id="get_student_id" name="id" ></span><br>
					Book Name:<input type="text" id="bname" name="bname" autocomplete="off" required><br>
					Author:<input type="text" id="author" name="author" autocomplete="off"><br>
					Information about book I am requesting:<br><textarea name="text" rows="4" cols="90"></textarea><br><br>
					<button class="button" type="submit" id="Send" name="Send">Send</button>
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
					echo '<table border="2" align="center" id="table" cellpadding="5" cellspacing="5">';
					echo '<tr>';
					echo '<th> S.N </th>';
					echo '<th> Student Name </th>';
					echo '<th> Student ID </th>';
					echo '<th> Book Name </th>';
					echo '<th> Author </th>';
					echo '<th> Book Information </th>';
					echo '</tr>';
					while($row = mysqli_fetch_assoc($result)){  ?>
						<tr>
						<td><?php echo $cnt; ?></td>
						<td><?php echo $row["Student_Name"]; ?></td>
						<td><?php echo $row["Student_ID"]; ?></td>
						<td><?php echo $row["Book_Name"]; ?></td>
						<td><?php echo $row["Author"]; ?></td>
						<td><?php echo $row["Information"]; ?></td>
						</tr><?php
						$cnt=$cnt+1;
					}
				}
				?>
				</table>
	</body>
</html>