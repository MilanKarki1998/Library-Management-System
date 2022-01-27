<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['login'])==0){ 
		header("Location:http://localhost/Summer%20Project/Home.php");
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
			<center id="center"><h2>ISSUED BOOKS</h2></center>
			<form method="POST" action="">
			<p align="right">
			<input type="text" style="align:right;" name="keyword" id="keyword" placeholder="Search...">
			<input type="submit" style="align:right;" name="Search" value="Search"></p>
			</form>
				<?php
				$sid=$_SESSION['login'];
				if(isset($_POST['Search'])){
					$search=$_POST['keyword'];
					$query = "SELECT students.name,books.Book_Name,books.ISBN,Issuedbooks.IssuesDate,Issuedbooks.ReturnStatus,Issuedbooks.ExpectedReturnDate,Issuedbooks.ReturnDate,Issuedbooks.fine,Issuedbooks.id as rid from  Issuedbooks inner join students on students.StudentId=Issuedbooks.StudentId inner join books on books.id=Issuedbooks.BookId WHERE students.StudentId='$sid' AND (Issuedbooks.fine like '%{$search}%' || books.Book_Name like '%{$search}%' || books.ISBN like '$search') order by Issuedbooks.id desc";
					$result = mysqli_query($conn,$query);
				}else{
					$query = "SELECT students.name,books.Book_Name,books.ISBN,Issuedbooks.IssuesDate,Issuedbooks.ReturnStatus,Issuedbooks.ExpectedReturnDate,Issuedbooks.ReturnDate,Issuedbooks.fine,Issuedbooks.id as rid from  Issuedbooks inner join students on students.StudentId=Issuedbooks.StudentId inner join books on books.id=Issuedbooks.BookId WHERE students.StudentId='$sid' order by Issuedbooks.id desc";
					$result = mysqli_query($conn,$query);
				}
				$cnt=1;
				if(mysqli_num_rows($result)>0){
					echo '<section id="table-scroll">';
					echo '<table border="2" align="center" id="table" cellpadding="2" cellspacing="2">';
					echo '<tr>';
					echo '<th> S.N </th>';
					echo '<th> Student Name </th>';
					echo '<th> Book Name </th>';
					echo '<th> ISBN </th>';
					echo '<th> Issued Date </th>';
					echo '<th> Expected Return Date </th>';
					echo '<th> Return Date </th>';
					echo '<th> Fine (in Rs) </th>';
					echo '<th> Action  </th>';
					echo '</tr>';
					while($row = mysqli_fetch_assoc($result)){  ?>
						<tr>
						<td><?php echo $cnt; ?></td>
						<td><?php echo $row["name"]; ?></td>
						<td><?php echo $row["Book_Name"]; ?></td>
						<td><?php echo $row["ISBN"]; ?></td>
						<td><?php echo $row["IssuesDate"]; ?></td>
						<td><?php echo $row["ExpectedReturnDate"]; ?></td>
						<td><?php if($row['ReturnDate']==""){?>
							<span style="color:red"><?php
                                        echo "Not Return Yet"; ?></span><?php
                                  } else {
                                       echo $row['ReturnDate'];
									}	?></td>
						<td><?php echo $row['fine']; ?></td>
						<td><?php if($row['ReturnStatus']==0){?>
						<?php 
						}else {
							?><a href="delete.php?id=<?php echo $row['rid']; ?>"><button>Delete</button><?php 
						} ?></td>
						<tr><?php
						$cnt=$cnt+1;
					}
				}
				?>
				</table>
				</section>
			</div>
		</div>
	</body>
</html>