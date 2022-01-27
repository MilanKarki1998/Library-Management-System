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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
		<script language="javascript">
	
		function printPage(printContent) {
		var display_setting="toolbar=yes,menubar=yes,";
		display_setting+="scrollbars=yes,width=650, height=600, left=100, top=25";

		var printpage=window.open("","",display_setting);
		printpage.document.open();
		printpage.document.write('<html><head><title>Print Page</title></head>');
		printpage.document.write('<h2>Issued Books Record</h2>');
		printpage.document.write('<body onLoad="self.print()" align="center">'+ printContent +'</body></html>');
		printpage.document.close();
		printpage.focus();
		}
		</script>
		<?php include('menu.php'); ?>
			<div class="text-block">
			<center id="center"><h2>Issued Books Lists</h2></center>
			<form method="POST" action="">
			<table align="left">
			<tr>
			<td><p style="color:green;font-size:x-large;">Return Status:<p></td>
			<td><p style="color:green;font-size:x-large;">Issue Date:<p></td>
			<td><p style="color:green;font-size:x-large;">Return Date:<p></td>
			</tr>
			<tr>
			<td><select  class="block" id="fetchval" >
					<option value="1" selected="selected">All</option>
					<option value="2">Return</option>
					<option value="3">Not Return</option>
			</select></td>
			<td><select  class="block" id="fetchval1" >
					<option value="1" selected="selected">All</option>
					<option value="2">Today</option>
					<option value="3">Last Week</option>
					<option value="4">Last Month</option>
					<option value="5">Last Year</option>
			</select></td>
			<td><select  class="block" id="fetchval2" >
					<option value="1" selected="selected">All</option>
					<option value="2">Today</option>
					<option value="3">Last Week </option>
					<option value="4">Last Month</option>
					<option value="5">Last Year</option>
			</select></td>
			</tr>
			</table><br>
			<p align="right">
			<input type="text" style="align:right;" name="keyword" id="keyword" placeholder="Search...">
			<input type="submit" style="align:right;" name="Search" value="Search"></p>
			</form>
				<?php
				include("connect.php");
				if(isset($_POST['Search'])){
					$search=$_POST['keyword'];
					$query = "SELECT students.StudentId,students.name,books.Book_Name,books.ISBN,Issuedbooks.IssuesDate,Issuedbooks.ExpectedReturnDate,Issuedbooks.ReturnDate,Issuedbooks.fine,Issuedbooks.id as rid from  Issuedbooks inner join students on students.StudentId=Issuedbooks.StudentId inner join books on books.id=Issuedbooks.BookId WHERE students.StudentId like '$search' || students.name like '$search' || books.Book_Name like '%{$search}%' || books.ISBN like '$search' order by Issuedbooks.id desc";
					$result = mysqli_query($conn,$query);
				}else{
				$query = "SELECT students.StudentId,students.name,books.Book_Name,books.ISBN,Issuedbooks.IssuesDate,Issuedbooks.ExpectedReturnDate,Issuedbooks.ReturnStatus,Issuedbooks.fine,Issuedbooks.ReturnDate,Issuedbooks.id as rid from  Issuedbooks inner join students on students.StudentId=Issuedbooks.StudentId inner join books on books.id=Issuedbooks.BookId order by Issuedbooks.id desc";
				$result = mysqli_query($conn,$query);
				}
				$cnt=1;
				$a=0;
				$b=0;
				if(mysqli_num_rows($result)>0){
					echo '<section  class="table-scroll" id="printsection">';
					echo '<table border="2" align="center" id="table" cellpadding="2" cellspacing="2">';
					echo '<tr>';
					echo '<th> S.N </th>';
					echo '<th> Std ID </th>';
					echo '<th> Student Name </th>';
					echo '<th> Book Name </th>';
					echo '<th> ISBN </th>';
					echo '<th> Issued Date </th>';
					echo '<th> Expected Return Date </th>';
					echo '<th> Return Date </th>';
					echo '<th> Fine </th>';
					echo '</tr>';
					while($row = mysqli_fetch_assoc($result)){  ?>
						<tr>
						<td><?php echo $cnt; ?></td>
						<td><?php echo $row["StudentId"]; ?></td>
						<td><?php echo $row["name"]; ?></td>
						<td><?php echo $row["Book_Name"]; ?></td>
						<td><?php echo $row["ISBN"]; ?></td>
						<td><?php echo $row["IssuesDate"]; ?></td>
						<td><?php echo $row["ExpectedReturnDate"]; ?></td>
						<td><?php if($row['ReturnDate']==""||$row['ReturnDate']=="0000-00-00 00:00:00"){?>
							<span style="color:red"><?php
                                        echo "Not Return Yet"; ?></span><?php
                                  } else {
                                       echo $row['ReturnDate'];
									}	?></td>
						<td><?php if($row['ReturnDate']==""||$row['ReturnDate']=="0000-00-00 00:00:00"){ 
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
							$b=$b+$fine;
							}else echo $row['fine']; ?></td>
						</tr>
						<?php
						$cnt=$cnt+1;
						$a=$a+$row['fine'];
					}?><tr>
						<th colspan="9">Total Fine: <?php echo $a+$b; ?></th>
						</tr> <?php
				}
				else
					echo "<h1>No Books are Issued<h1>";
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
			url:"fetchIssuBook.php",
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
	$("#fetchval1").on('change',function(){
		var value = $(this).val();
		//alert(value);
		$.ajax({
			url:"fetchIssuBook2.php",
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
	$("#fetchval2").on('change',function(){
		var value = $(this).val();
		//alert(value);
		$.ajax({
			url:"fetchIssuBook3.php",
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
$('#fetchval').change(function(){
	$('#fetchval1').val(function () {
    return $(this).find('option').filter(function () {
        return $(this).prop('defaultSelected');
    }).val();
	});$('#fetchval2').val(function () {
    return $(this).find('option').filter(function () {
        return $(this).prop('defaultSelected');
    }).val();
	});
});
$('#fetchval1').change(function(){
	$('#fetchval').val(function () {
    return $(this).find('option').filter(function () {
        return $(this).prop('defaultSelected');
    }).val();
	});$('#fetchval2').val(function () {
    return $(this).find('option').filter(function () {
        return $(this).prop('defaultSelected');
    }).val();
	});
});
$('#fetchval2').change(function(){
	$('#fetchval').val(function () {
    return $(this).find('option').filter(function () {
        return $(this).prop('defaultSelected');
    }).val();
	});$('#fetchval1').val(function () {
    return $(this).find('option').filter(function () {
        return $(this).prop('defaultSelected');
    }).val();
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

        XLSX.writeFile(file, 'IssuedBooks Record.' + type);
    }

    const export_button = document.getElementById('export_button');

    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });

</script>