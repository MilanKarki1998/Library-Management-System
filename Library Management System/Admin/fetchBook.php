<?php
include("connect.php");
if(isset($_POST['request'])){
$request=$_POST['request'];
if($request==2){
	$query = "select * from books";
				$result = mysqli_query($conn,$query);
}else{
				$query = "select * from books where Category='$request'";
				$result = mysqli_query($conn,$query);
				}
				$cnt=1;
				if(mysqli_num_rows($result)>0){
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
<?php }		
?>