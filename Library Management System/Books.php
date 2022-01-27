<html>
	<link rel="icon" type="image/ico" href="images/2.png" />
	<body style="background-color:black;">
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
		<?php include('menu.php'); ?>
			<div class="text-block">
				<?php
				include("connect.php");
				$query = "select * from books where Copies<>0";
				$result = mysqli_query($conn,$query);
				$cnt=1;
				if(mysqli_num_rows($result)>0){
					echo '<center id="center"><h2>Available Books Lists</h2></center>';
					echo '<section id="table-scroll">';
					echo '<table border="2" align="center" id="table" cellpadding="2" cellspacing="2">';
					echo '<tr>';
					echo '<th> S.N </th>';
					echo '<th> Book Name </th>';
					echo '<th> Category </th>';
					echo '<th> Author</th>';
					echo '<th> ISBN </th>';
					echo '<th> Price (in Rs) </th>';
					echo '<th> Copies </th>';
					echo '</tr>';
					while($row = mysqli_fetch_assoc($result)){
						echo '<tr>';
						echo '<td>'.$cnt.'</td>';
						echo '<td>'.$row["Book_Name"].'</td>';
						echo '<td>'.$row["Category"].'</td>';
						echo '<td>'.$row["Author"].'</td>';
						echo '<td>'.$row["ISBN"].'</td>';
						echo '<td>'.$row["Price"].'</td>';
						echo '<td>'.$row["Copies"].'</td>';
						echo '</tr>';
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