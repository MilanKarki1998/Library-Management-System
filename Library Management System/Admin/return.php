<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){   
	header('location:http://localhost/Summer%20Project/Home.php');
	}else{
		if(isset($_POST['return'])){
			$rid=$_GET['rid'];
			$rstatus=1;
			$stat=0;
			$sql="SELECT * from Issuedbooks where id='$rid'";
			$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){
					$c= strtotime(date("Y-m-d"));
					$d= strtotime($row['ExpectedReturnDate']);
					$diff= $c-$d;
					if($diff>=0){
						$day= ceil($diff/(60*60*24)); 
						$fine= $day*.10;
						}else{
							$fine=0;
						}
					}
				}
			$sql="UPDATE Issuedbooks SET fine='$fine',ReturnStatus='$rstatus' where id='$rid'";
			$result=mysqli_query($conn,$sql);
			if($result){
				$sql="SELECT BookId From Issuedbooks where id='$rid'";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){
						$bid=$row['BookId'];
						$sql="UPDATE books SET Copies=Copies+1 where id='$bid'";
						$result=mysqli_query($conn,$sql);
					}
				}
				header("Location:IssBooks.php");
			}else{
				echo "has problem updating value.".mysqli_error($conn);
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
				<form name="f1" method="POST">
				<center id='center'><h2>Issued Books Details</h2></center>
				<?php
				include("connect.php");
				$rid=$_GET['rid'];
				$query = "SELECT students.name,books.Book_Name,books.ISBN,Issuedbooks.IssuesDate,Issuedbooks.ExpectedReturnDate,Issuedbooks.ReturnDate,Issuedbooks.ReturnStatus,Issuedbooks.fine,Issuedbooks.id as rid from  Issuedbooks inner join students on students.StudentId=Issuedbooks.StudentId inner join books on books.id=Issuedbooks.BookId WHERE Issuedbooks.id='$rid'";
				$result = mysqli_query($conn,$query);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){  ?>
						<b>Student Name:</b><i><?php echo $row['name'];?></i><br>
						<b>Book Name:</b><i><?php echo $row['Book_Name'];?></i><br>
						<b>ISBN:</b><i><?php echo $row['ISBN'];?></i><br>
						<b>Book Issue Date:</b><i><?php echo $row['IssuesDate'];?></i><br>
						<b>Expected Book Return Date:</b><i><?php echo $row['ExpectedReturnDate'];?></i><br>
						<b>Book Return Date:</b><i><?php if($row['ReturnDate']==""||$row['ReturnDate']=="0000-00-00 00:00:00"){
                                        echo "Not Return Yet";
                                  } else {
                                       echo $row['ReturnDate'];
									}	?></i><br>
						<b>Fine (in Rs.):</b><i><?php 
					$c= strtotime(date("Y-m-d"));
					$d= strtotime($row['ExpectedReturnDate']);
					$diff= $c-$d;
					if($diff>=0){
						$day= ceil($diff/(60*60*24)); 
						$fine= $day*.10;
						}else{
							$fine=0;
						}
						echo $fine;
							?></i><br><br>
							<input type="submit" name="return" id="return" value="Return Book">
							<a href="IssBooks.php"><input type="button" name="back" id="back" value="Back"></a><?php }} ?>
				</form>
			</div>
		</div>
	</body>
</html>