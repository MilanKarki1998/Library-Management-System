<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){   
		header('location:http://localhost/Summer%20Project/Home.php');
	}else{
		if(isset($_POST['update'])){
			$id=$_GET['id'];
			$date=$_POST['date'];
			$sql="SELECT * from Issuedbooks where id='$id'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_assoc($result)){
					$sql="UPDATE Issuedbooks SET ExpectedReturnDate='$date', ReturnDate='' where id='$id'";
					$result=mysqli_query($conn,$sql);
					if($result){
						header("Location:IssBooks.php");
					}else{
						echo "has problem updating value.".mysqli_error($conn);
					}
				}
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
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		
		<?php include('menu.php'); ?>
			<div class="text-block">
				<form name="f1" method="POST">
				<center id='center'><h2>Renew Return Date</h2></center>
				<?php
				include("connect.php");
				$rid=$_GET['id'];
				$query = "SELECT students.name,books.Book_Name,books.ISBN,Issuedbooks.IssuesDate,Issuedbooks.ExpectedReturnDate,Issuedbooks.id as rid from  Issuedbooks inner join students on students.StudentId=Issuedbooks.StudentId inner join books on books.id=Issuedbooks.BookId WHERE Issuedbooks.id='$rid'";
				$result = mysqli_query($conn,$query);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){  ?>
						<b>Student Name:</b><i><?php echo $row['name'];?></i><br>
						<b>Book Name:</b><i><?php echo $row['Book_Name'];?></i><br>
						<b>ISBN:</b><i><?php echo $row['ISBN'];?></i><br>
						<b>Book Issue Date:</b><i><?php echo $row['IssuesDate'];?></i><br>
						<b>New Expected Book Return Date:</b><input type="datetime-local"  name="date" id="date" min="<?php $date = date("Y-m-d\TH:i:s", strtotime($row['ExpectedReturnDate']));echo $date;?>" value="<?php $date = date("Y-m-d\TH:i:s", strtotime($row['ExpectedReturnDate']));echo $date;?>"><br><br>
						<input type="submit" name="update" id="update" value="Update Return Date"><?php }} ?>	
				</form>
			</div>
		</div>
	</body>
</html>