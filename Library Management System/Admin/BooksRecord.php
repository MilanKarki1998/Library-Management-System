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
			.table-scroll {
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
			.b{
				font-family: "Times New Roman", Times, serif;
				font-size:x-large;
				background-color: Red;
				color: #2196F3;
				padding: 1px 2px 2px 1px;
				border: 2px solid green;
			}
			.info {
				border-color: #2196F3;
				color: dodgerblue;
			}
			.info:hover {
			background: #2196F3;
			color: white;
			}
			.block {
			width: 100%;
		}
		</style>
		<script>
			$(document).ready(function(){
				alert("working");
			});
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
		<script language="javascript">
	
		function printPage(printContent) {
		var display_setting="toolbar=yes,menubar=yes,";
		display_setting+="scrollbars=yes,width=650, height=600, left=100, top=25";

		var printpage=window.open("","",display_setting);
		printpage.document.open();
		printpage.document.write('<html><head><title>Print Page</title></head>');
		printpage.document.write('<h2>Book Record</h2>');
		printpage.document.write('<body onLoad="self.print()" align="center">'+ printContent +'</body></html>');
		printpage.document.close();
		printpage.focus();
		}
		</script>
		<?php include('menu.php'); ?>
		<div class="text-block">
		<center id="center"><h2>Books Lists</h2></center>
		<form method="POST" action="">
		<table align="left">
			<tr>
			<td><p style="color:green;font-size:x-large;">Book Category:<p></td>
			</tr>
			<tr>
			<td><select  class="block" id="fetchval" id="fetchval">
					<option value="2" >All</option>
					<option value="History">History</option>
					<option value="Comics">Comics</option>
					<option value="Fiction">Fiction</option>
					<option value="Non-Fiction">Non-Fiction</option>
					<option value="Biography">Biography</option>
					<option value="Medical">Medical</option>
					<option value="Fantasy">Fantasy</option>
					<option value="Education">Education</option>
					<option value="Sports">Sports</option>
					<option value="Technology">Technology</option>
					<option value="Literature">Literature</option>
			</select></td>
			</tr>
			</table><br>
		<p align="right">
		<input type="text" name="keyword" id="keyword" placeholder="Search...">
		<input type="submit" name="Search" value="Search">
		</p></form>
			
				<?php
				include("connect.php");
				if(isset($_POST['Search'])){
					$search=$_POST['keyword'];
					$query = "SELECT * FROM books WHERE Book_Name like '%{$search}%' ||Category like '%{$search}%' ||Author like '%{$search}%' ||ISBN like '$search'";
					$result = mysqli_query($conn,$query);
				}else{
				$query = "select * from books";
				$result = mysqli_query($conn,$query);
				}
				$cnt=1;
				if(mysqli_num_rows($result)>0){
		
					echo '<section class="table-scroll" id="printsection">';
					echo '<table border="2" align="center" id="table" cellpadding="2" cellspacing="2">';
					echo '<tr>';
					echo '<th> S.N </th>';
					echo '<th> Book Name </th>';
					echo '<th> Category </th>';
					echo '<th> Author</th>';
					echo '<th> ISBN </th>';
					echo '<th> Price (in Rs) </th>';
					echo '<th> Total Copies </th>';
					echo '<th> Available Copies </th>';
					echo '<th> Issue Copies </th>';
					echo '<th> Times Issue </th>';
					echo '</tr>';
					while($row = mysqli_fetch_assoc($result)){ ?>
						<tr>
						<td><?php echo $cnt; ?></td>
						<td><?php echo $row["Book_Name"]; ?></td>
						<td><?php echo $row["Category"]; ?></td>
						<td><?php echo $row["Author"]; ?></td>
						<td><?php echo $row["ISBN"]; ?></td>
						<td><?php echo $row["Price"]; ?></td>
						<td><?php echo $row["TCopies"]; ?></td>
						<td><?php if($row['Copies']=="0"){
										echo "<p>No</p>";
									}else{
										echo $row['Copies'];
									} ?></td>
						<td><?php $x=$row['TCopies']-$row['Copies']; echo $x; ?></td>
						<td><?php echo $row["TimeIssue"]; ?></td><?php 
						echo '<tr>';
						$cnt=$cnt+1;
					}
				}else
					echo "<h1>No Books<h1>";
				?>
				</table>
				</section><br>
				<a href="javascript:void(0);" onClick="printPage(printsection.innerHTML)" class="b info">Print Preview</a> <button class="b info"  id="export_button">Export</button>
			</div>
		</div>
		<script type="text/javascript">
		$(document).ready(function(){
	$("#fetchval").on('change',function(){
		var value = $(this).val();
		//alert(value);
		$.ajax({
			url:"fetchBook.php",
			type:"POST",
			data:'request=' + value,
			beforeSend:function(){
				$(".table-scroll").html("<span>Working..</span>");
			},
			success:function(data){
				$(".table-scroll").html(data);
			}
		});
	});
});
		</script>
	</body>
</html>
<script>
    function html_table_to_excel(type)
    {
        var data = document.getElementById('table');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'RegisterStudent Record.' + type);
    }

    const export_button = document.getElementById('export_button');

    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });

</script>