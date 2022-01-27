<?php 
	require_once("connect.php");
	if(!empty($_POST["bookid"])) {
		$bookid=$_POST["bookid"];
		$sql ="SELECT * FROM books WHERE ISBN='$bookid'";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while($rows = mysqli_fetch_assoc($result)){
				if($rows['Copies']>0){?>
					<option value="<?php echo $rows['id'];?>"><b>Book Name:<b><?php echo $rows['Book_Name'];?></option>
					<?php  
					echo $rows['Book_Name'];
					echo "<script>$('#issue').prop('disabled',false);</script>";
				}else{ ?>
					<option> Not Available</option><?php
					echo "<script>$('#issue').prop('disabled',true);</script>";
				}
			}
		}else{?>
			<option> Invalid ISBN Number</option>
			<?php
			 echo "<script>$('#issue').prop('disabled',true);</script>";
		}
	}
?>