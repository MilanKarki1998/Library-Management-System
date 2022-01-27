<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){   
		header('location:http://localhost/Summer%20Project/Home.php');
	}else{ 
		if(isset($_POST['issue'])){
			$studentid=strtoupper($_POST['studentid']);
			$bookid=$_POST['bookdetails'];
			$date=$_POST['date'];
			$sql="INSERT INTO Issuedbooks(StudentID,BookId,ExpectedReturnDate) VALUES('$studentid','$bookid','$date')";
			$result=mysqli_query($conn,$sql);
			if($result){
				$sql="UPDATE books SET Copies=Copies-1,TimeIssue=TimeIssue+1 WHERE id='$bookid'";
				$result=mysqli_query($conn,$sql);
				header('location:IssBooks.php');
			}else {
				echo '<script>alert("Something went wrong. Please try again")</script>';
			}
		}
	}
?>
<html>
	<link rel="icon" type="image/ico" href="images/2.png" />
	<body style="background-color:black;">
	<script>
			function valid(){
				if(document.f1.studentid.value!='' &&document.f1.bookid.value!='' &&document.f1.date.value!=''){
					return true;
				}else{
					alert("Input Field shouln't be empty!!");
					return false;
				}	
			}
		</script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script>
	// function for get student name
	function getstudent() {
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "get_student.php",
	data:'studentid='+$("#studentid").val(),
	type: "POST",
	success:function(data){
	$("#get_student_name").html(data);
	$("#loaderIcon").hide();
	},
	error:function (){}
	});
	}

	//function for book details
	function getbook() {
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "get_book.php",
	data:'bookid='+$("#bookid").val(),
	type: "POST",
	success:function(data){
	$("#get_book_name").html(data);
	$("#loaderIcon").hide();
	},
	error:function (){}
	});
	}
	</script> 
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
				<form name="f1" method="POST" onSubmit="return valid();">
						<center id='center'><h2>Issue a New Book</h2></center>
						Student ID:<br>
						<input type="text" name="studentid" id="studentid" onBlur="getstudent()" style="width: 100%;" autocomplete="off"><br>
						<span id="get_student_name" style="font-size:20px;"></span> <br>
						ISBN Number:<br>
						<input type="text" name="bookid" id="bookid" onBlur="getbook()" style="width: 100%;" autocomplete="off"><br>
						<select  name="bookdetails" id="get_book_name" style="width: 100%;" readonly>
						</select><br>
						Expected Returned Date:<input type="datetime-local"  name="date" value="<?php $date = date("Y-m-d\TH:i:s", strtotime("+1 day")); echo $date; ?>" min="<?php $date = date("Y-m-d\TH:i:s", strtotime("+1 day")); echo $date; ?>" id="date"><br><br>
						<button class="button" type="submit" name="issue" id="issue">Issue Book </button>
				</form>
			</div>
		</div>
	</body>
</html>