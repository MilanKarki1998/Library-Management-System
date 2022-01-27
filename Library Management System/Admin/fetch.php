<?php
include("connect.php");
if(isset($_POST['request'])){
$request=$_POST['request'];
if($request==2){
	$query = "select * from students";
				$result = mysqli_query($conn,$query);
}else{
$query = "select * from students where Status='$request'";
				$result = mysqli_query($conn,$query);
}
				$cnt=1;
				if(mysqli_num_rows($result)>0){
					echo '<table border="2" align="center" id="table" cellpadding="2" cellspacing="2">';
					echo '<tr>';
					echo '<th> S.N </th>';
					echo '<th> Student ID </th>';
					echo '<th> Name </th>';
					echo '<th> Email </th>';
					echo '<th> Mobile </th>';
					echo '<th> RegDate </th>';
					echo '<th> Status </th>';
					echo '</tr>';
					while($row = mysqli_fetch_assoc($result)){?>
						<tr>
						<td><?php echo $cnt ?></td>
						<td><?php echo $row["StudentId"]?></td>
						<td><?php echo $row["name"]?></td>
						<td><?php echo $row["email"]?></td>
						<td><?php echo $row["mobile"]?></td>
						<td><?php echo $row["RegDate"]?></td>
						<td><?php if($row['Status']==1){
                                                echo "Active";
                                            } else {
												echo "<p>Blocked</p>";
											}?></td>
						</tr><?php $cnt=$cnt+1;
						}
					}else
						echo "<h1>0 Register Students<h1>";
					?>
				</table>
<?php }		
?>