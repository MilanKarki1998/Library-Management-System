<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){ 
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
		printpage.document.write('<h2>User Activity Record</h2>');
		printpage.document.write('<body onLoad="self.print()" align="center">'+ printContent +'</body></html>');
		printpage.document.close();
		printpage.focus();
		}
		</script>
		<?php include('menu.php'); ?>
			<div class="text-block" >
			<center id="center"><h2>User Activity</h2></center>
			<form method="POST" action="" >
			<table align="left">
			<tr>
			<td><p style="color:green;font-size:x-large;">Login-Time:<p></td>
			</tr>
			<tr>
			<td><select  class="block" id="fetchval" >
					<option value="1">All Time</option>
					<option value="2">Today</option>
					<option value="3">1 Week ago</option>
					<option value="4">1 Month ago</option>
					<option value="5">1 Year ago</option>
			</select></td>
			</tr>
			</table><br>
			<p align="right">
			<input type="text" style="align:right;" name="keyword" id="keyword" placeholder="Search...">
			<input type="submit" style="align:right;" name="Search" value="Search"></p>
			</form>
				<?php
				if(isset($_POST['Search'])){
					$search=$_POST['keyword'];
					$query ="select students.StudentId,students.name,students.email,students.mobile,students.RegDate,userlog.StdID,userlog.StdIP,userlog.LoginTime from userlog inner join students on students.StudentId=userlog.StdID where students.StudentId like '%{$search}%' ||students.name like '%{$search}%' ||students.email like '$search' ||students.mobile like '$search' ORDER BY userlog.LoginTime DESC";
					$result = mysqli_query($conn,$query);
				}else{
					$query ="select students.StudentId,students.name,students.email,students.mobile,students.RegDate,userlog.StdID,userlog.StdIP,userlog.LoginTime from userlog inner join students on students.StudentId=userlog.StdID ORDER BY userlog.LoginTime DESC";
					$result = mysqli_query($conn,$query);
				}
				$cnt=1;
				if(mysqli_num_rows($result)>0){
					echo '<section class="table-scroll" id="printsection">';
					echo '<table border="2" align="center" id="table" cellpadding="2" cellspacing="2">';
					echo '<tr>';
					echo '<th> S.N </th>';
					echo '<th> Student ID </th>';
					echo '<th> Student Name </th>';
					echo '<th> Student Mobile </th>';
					echo '<th> Student Email </th>';
					echo '<th> Student RegDate </th>';
					echo '<th> Student IP</th>';
					echo '<th> Login-Time </th>';
					echo '</tr>';
					while($row = mysqli_fetch_assoc($result)){  ?>
						<tr>
						<td><?php echo $cnt;?></td>
						<td><?php echo $row['StdID'];?></td>
						<td><?php echo $row['name'];?></td>
						<td><?php echo $row['mobile'];?></td>
						<td><?php echo $row['email'];?></td>
						<td><?php echo $row['RegDate'];?></td>
						<td><?php echo $row['StdIP'];?></td>
						<td><?php echo $row['LoginTime'];?></td>
						<?php
						$cnt=$cnt+1;
					}
				}
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
			url:"fetchActivity.php",
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

        XLSX.writeFile(file, 'StudentActivity Record.' + type);
    }

    const export_button = document.getElementById('export_button');

    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });

</script>