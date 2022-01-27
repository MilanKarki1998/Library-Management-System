<html>
<head>
<title> Home </title>
</head>
	<link rel="icon" type="image/ico" href="images/2.png" />
	<body style="background-color:black;" onLoad="auto();">
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
		<script language="javascript">
			var flag=0;
			function changeimage(){
				if(flag==0){
					flag=1;
					document.getElementById("myimage").src="images/1.jpg";
				}else{
					flag=0;
					document.getElementById("myimage").src="images/5.jpg";
				}
			}
			function auto()
			{
				setInterval(changeimage,2500);
			}
		</script>
		<?php include('menu.php'); ?>
			<div class="text-block" style="opacity: 0.5;">
				<h1>Welcome to Library</h1>
				<center><h2>Opens at: 09:00am</h2>
				<center><h2>Closes at: 05:00pm</h2>
				
			</div>
		</div>
		<?php
				include("connect.php");
				$query = "SELECT * from news";
				$result = mysqli_query($conn,$query);
				$cnt=1;
				if(mysqli_num_rows($result)>0){
					echo '<center id="center"><h2>Announcements</h2></center>';
					echo '<table border="2" align="center" id="table" cellpadding="2" cellspacing="2">';
					echo '<tr>';
					echo '<th> S.N </th>';
					echo '<th> Announcement </th>';
					echo '</tr>';
					while($row = mysqli_fetch_assoc($result)){  ?>
						<tr>
						<td><?php echo $cnt; ?></td>
						<td><?php echo $row["announcement"]; ?></td>
						</tr><?php
						$cnt=$cnt+1;
					}
				}
				?>
				</table>
	</body>
</html>