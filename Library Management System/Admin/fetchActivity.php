<?php
include("connect.php");
if(isset($_POST['request'])){
$request=$_POST['request'];
if($request==1){
	$query ="select students.StudentId,students.name,students.email,students.mobile,students.RegDate,userlog.StdID,userlog.StdIP,userlog.LoginTime from userlog inner join students on students.StudentId=userlog.StdID ORDER BY userlog.LoginTime DESC";
	$result = mysqli_query($conn,$query);
}elseif($request==2){
	$query ="select students.StudentId,students.name,students.email,students.mobile,students.RegDate,userlog.StdID,userlog.StdIP,userlog.LoginTime from userlog inner join students on students.StudentId=userlog.StdID where userlog.LoginTime >= CURRENT_DATE() ORDER BY userlog.LoginTime DESC";
	$result = mysqli_query($conn,$query);
}elseif($request==3){
	$query ="select students.StudentId,students.name,students.email,students.mobile,students.RegDate,userlog.StdID,userlog.StdIP,userlog.LoginTime from userlog inner join students on students.StudentId=userlog.StdID where userlog.LoginTime > DATE_SUB(DATE(NOW()), INTERVAL 1 WEEK) ORDER BY userlog.LoginTime DESC";
	$result = mysqli_query($conn,$query);
}elseif($request==4){
	$query ="select students.StudentId,students.name,students.email,students.mobile,students.RegDate,userlog.StdID,userlog.StdIP,userlog.LoginTime from userlog inner join students on students.StudentId=userlog.StdID where userlog.LoginTime > DATE_SUB(DATE(NOW()), INTERVAL 1 MONTH) ORDER BY userlog.LoginTime DESC";
	$result = mysqli_query($conn,$query);
}elseif($request==5){
	$query ="select students.StudentId,students.name,students.email,students.mobile,students.RegDate,userlog.StdID,userlog.StdIP,userlog.LoginTime from userlog inner join students on students.StudentId=userlog.StdID where userlog.LoginTime > DATE_SUB(DATE(NOW()), INTERVAL 1 YEAR) ORDER BY userlog.LoginTime DESC";
	$result = mysqli_query($conn,$query);
}
				$cnt=1;
				if(mysqli_num_rows($result)>0){
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
				}else 
					echo '<h2>No record</h2>';
				?>
				</table>
<?php }		
?>