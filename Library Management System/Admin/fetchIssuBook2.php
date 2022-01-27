<?php
include("connect.php");
if(isset($_POST['request'])){
$request=$_POST['request'];
if($request==1){
	$query ="SELECT students.StudentId,students.name,books.Book_Name,books.ISBN,Issuedbooks.IssuesDate,Issuedbooks.ExpectedReturnDate,Issuedbooks.ReturnStatus,Issuedbooks.fine,Issuedbooks.ReturnDate,Issuedbooks.id as rid from  Issuedbooks inner join students on students.StudentId=Issuedbooks.StudentId inner join books on books.id=Issuedbooks.BookId order by Issuedbooks.id desc";
	$result=mysqli_query($conn,$query);
}elseif($request==2){
	$query ="SELECT students.StudentId,students.name,books.Book_Name,books.ISBN,Issuedbooks.IssuesDate,Issuedbooks.ExpectedReturnDate,Issuedbooks.ReturnStatus,Issuedbooks.fine,Issuedbooks.ReturnDate,Issuedbooks.id as rid from  Issuedbooks inner join students on students.StudentId=Issuedbooks.StudentId inner join books on books.id=Issuedbooks.BookId where Issuedbooks.IssuesDate >= CURRENT_DATE() order by Issuedbooks.id desc";
	$result=mysqli_query($conn,$query);
}elseif($request==3){
	$query ="SELECT students.StudentId,students.name,books.Book_Name,books.ISBN,Issuedbooks.IssuesDate,Issuedbooks.ExpectedReturnDate,Issuedbooks.ReturnStatus,Issuedbooks.fine,Issuedbooks.ReturnDate,Issuedbooks.id as rid from  Issuedbooks inner join students on students.StudentId=Issuedbooks.StudentId inner join books on books.id=Issuedbooks.BookId where Issuedbooks.IssuesDate > DATE_SUB(DATE(NOW()), INTERVAL 1 WEEK) order by Issuedbooks.id desc";
	$result=mysqli_query($conn,$query);
}elseif($request==4){
	$query ="SELECT students.StudentId,students.name,books.Book_Name,books.ISBN,Issuedbooks.IssuesDate,Issuedbooks.ExpectedReturnDate,Issuedbooks.ReturnStatus,Issuedbooks.fine,Issuedbooks.ReturnDate,Issuedbooks.id as rid from  Issuedbooks inner join students on students.StudentId=Issuedbooks.StudentId inner join books on books.id=Issuedbooks.BookId where Issuedbooks.IssuesDate > DATE_SUB(DATE(NOW()), INTERVAL 1 MONTH) order by Issuedbooks.id desc";
	$result=mysqli_query($conn,$query);
}elseif($request==5){
	$query ="SELECT students.StudentId,students.name,books.Book_Name,books.ISBN,Issuedbooks.IssuesDate,Issuedbooks.ExpectedReturnDate,Issuedbooks.ReturnStatus,Issuedbooks.fine,Issuedbooks.ReturnDate,Issuedbooks.id as rid from  Issuedbooks inner join students on students.StudentId=Issuedbooks.StudentId inner join books on books.id=Issuedbooks.BookId where Issuedbooks.IssuesDate > DATE_SUB(DATE(NOW()), INTERVAL 1 YEAR) order by Issuedbooks.id desc";
	$result=mysqli_query($conn,$query);
}
				$cnt=1;
				$a=0;
				$b=0;
				if(mysqli_num_rows($result)>0){
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
				}?><?php if($request==3){?><tr>
						<th colspan="9">Total Fine: <?php  echo $a+$b;?></th>
						</tr> <?php }else{?><tr>
						<th colspan="9">Total Fine: <?php  echo $a+$b;?></th>
						</tr> <?php
				}
				}
				else
					echo "<h1>No Books are Issued<h1>";
				?>
				</table>
<?php }		
?>