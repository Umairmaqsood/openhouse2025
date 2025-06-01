<?php
	include 'conn.php'; 
	if (!empty($_GET)) {
		$proj_title = urldecode($_GET['projTitle']);
		
		$sql1 = "SELECT cv_path1, cv_path2, cv_path3 FROM student WHERE proj_title = '$proj_title'";
		$result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
		$row = mysqli_fetch_array($result1);
		
		
		unlink($row['cv_path1']); //deleting file from the specified folder
		if($row['cv_path2']!= $row['cv_path1']) 
			unlink($row['cv_path2']); //deleting file from the specified folder
		if(($row['cv_path3']!= $row['cv_path2']) && ($row['cv_path3']!= $row['cv_path1']))
			unlink($row['cv_path3']); //deleting file from the specified folder
					
		$sql2 = "DELETE FROM student WHERE proj_title='$proj_title'";
		if (mysqli_query($conn, $sql2)) {
			echo 1;
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($connection);
		}
		
	}
	else
		echo "<script>alert('Error in deletion.')</script>"; 
		
?>	