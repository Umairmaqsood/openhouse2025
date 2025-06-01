<?php

echo "<style>";
include 'CSS/main.css'; 
echo "</style>";
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>FUSST Open House 2025</title>
  <link rel="icon" type="image/png" href="img/oh_favicon-removebg.png">
  <link rel="shortcut icon" href="img/logo.png" />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/main.css" />
  <link rel="stylesheet" type="text/css" href="css/cdstyle.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i" rel="stylesheet">
</head>

<body>
  <!--script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script-->
	<script src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
    integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"></script>


   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-2">
    <div class="container-fluid">
  
      <!-- Logo + Title -->
      <a class="navbar-brand d-flex align-items-center" href="index.html">
        <img src="img/openhouse2024_nobg.png" alt="Logo" style="width: 80px; height: 80px;" class="mr-2">
        <span class="font-weight-bold ml-2">Open House 2025</span>
      </a>
  
      <!-- Toggler for mobile -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <!-- Links and Button inside collapsible area -->
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mx-auto">
          <a class="nav-item nav-link active" style="font-weight: bold;" href="index.html">Home</a>
          <a class="nav-item nav-link" style="font-weight: bold;" href="department.html">Departments</a>
          <a class="nav-item nav-link" style="font-weight: bold;" href="./Schedule.html">Schedule</a>
          <a class="nav-item nav-link" style="font-weight: bold;" href="./sponsorship_categories.html">Support Opportunities</a>
          <a class="nav-item nav-link" style="font-weight: bold;" href="sponsors.html">Sponsors</a>
          <!-- <a class="nav-item nav-link" style="font-weight: bold;" href="#participants">Participating Companies</a> -->
          <a class="nav-item nav-link" style="font-weight: bold;" href="contact_us.html">Contact Us</a>
        </div>
    
    
        <!-- Logout on right inside collapse -->
     <div class="navbar-nav ml-auto">
                  <a class="btn btn-outline-primary btn-sm" href="logout.php">Logout</a>
                </div>
      
      </div>

     
  
    </div>
  </nav>




<?php

if(empty($_POST))
	echo '<script>window.location="adminlogin.html";</script>';
else {
	$comp_email=$_POST['compEmail'];
	// $admin_pass=$_POST['adminPassword'];
  //admin type feature
//   $admin_type='';

}



include 'conn.php'; 
//$conn=new mysqli('localhost','root','','registration');

if($conn->connect_error){
    die('Connection Failed :' .$conn->connect_error);
    
}


else if(isset($_POST['Login']))

    {
       
    
      $query="select * from company_rest where comp_email='$comp_email'";
      $done=mysqli_query($conn,$query);
      $get_admin_data=mysqli_fetch_assoc($done);
   


   
      if(mysqli_num_rows($done)==1){
      $query="SELECT stu_dept,proj_title, superv_name, mem1_name, mem2_name, mem3_name, cv_path1, cv_path2, cv_path3
		FROM student
		ORDER BY stu_dept asc";


        $data=mysqli_query($conn,$query);    
        $total=mysqli_num_rows($data);

        if($total!=0)
        {

        ?>
        <!-- end of php code and table starting -->

    <!-- table code -->
    <table border="3"   align="center" class="stutable">

    <tr >
            <th colspan="10" style="text-align:center">List of Projects</th>
           </tr> 
            
            <tr>
				<th>Sr. No.</th>
                <th>Department</th>
                <th>Project Title</th>
                <th>Supervisor Name</th>
                <th>Group Members</th>
                <th>CVs </th>
                
                
            </tr>
            
    
    <!-- start of new php code -->
        <?php
		$count = 1;
        // fetch data to display records 
        while($result=mysqli_fetch_assoc($data))
        
        {   
            
            $path1=$result['cv_path1'];
            $cv_name1=substr($path1, 4);
            $path2=$result['cv_path2'];
            $cv_name2=substr($path2, 4);
            $path3=$result['cv_path3'];
            $cv_name3=substr($path3, 4);
            
            echo 
                "<tr>
                        <td>".$count."</td>".
						"<td>".$result['stu_dept']."</td>"."
                        <td>".$result['proj_title']."</td>"."
                        <td>".$result['superv_name']."</td>"."
                        <td><ul>".
							"<li>".$result['mem1_name']."</li>".
							"<li>".$result['mem2_name']."</li>".
							"<li>".$result['mem3_name']."</li>".
							"</ul></td>".
						"<td><ul>".
                        "<li>".
                        "<a href='$path1'>$cv_name1</a>"
                        ."</li>".
                        "<li>".
                        "<a href='$path2'>$cv_name2</a>"
                        ."</li>".
                        "<li>".
                        "<a href='$path3'>$cv_name3</a>"
                        ."</li>".
                        "</ul></td>".
                        "</a>
				</tr>";
			$count++;	
        
        }
            // end of while
	?>
	</table>
	<footer style="background-color: #f5f5f5; bottom: 0; width: 100%;" class=" mt-auto py-3 text-center">
	  <hr>
        <strong>&copy; 2025 </strong> Faculty of Engineering & IT, FUSST
      </footer>
	  
	<?php
	//echo "<br><hr><a href='index.html'><h3 style='text-align:center;'>Home Page</h3></a>";
    }
	else
    {
        echo "<br>No projects record to display.";
		 ?>
		<br><br>
		<footer style="background-color: #f5f5f5; bottom: 0; width: 100%;" class=" mt-auto py-3 text-center">
	  <hr>
        <strong>&copy; 2025 </strong> Faculty of Engineering & IT, FUSST
      </footer>
	  <?php
    }
	
     }  //  for admin type 0 start 

else
 
        echo "<h3 style='text-align:center; margin:30px 0px !important; color:red;'>Invalid username.</h3>";
		echo "<a href='companyLogin.html'><h3 style='text-align:center;'>Login Page</h3></a>";
		?>
		<footer style="background-color: #f5f5f5; position: fixed; bottom: 0; width: 100%;" class=" mt-auto py-3 text-center">
	  <hr>
        <strong>&copy; 2025 </strong> Faculty of Engineering & IT, FUSST
      </footer>
	  <?php
      }

    
	
    //end of else if
 

    $conn->close();
    ?>

	</body>

</html>
	







