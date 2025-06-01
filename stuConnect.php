<style>
<?php 
	session_start();
	include 'CSS/main.css'; ?>
</style>


<?php

$stu_email=$_POST['stuEmail'];
$stu_pass=$_POST['stuPassword'];
// $stu_pass="furc123";

//$conn=new mysqli('localhost','root','','registration');
include 'conn.php'; 

if($conn->connect_error){
    die('Connection Failed :' .$conn->connect_error);
    
}

else if(isset($_POST['Login']))
    {
 
      $query="select * from admin where admin_username='$stu_email' and admin_password='$stu_pass'";
      $done=mysqli_query($conn,$query);
      if(mysqli_num_rows($done)==1){
        // redirect to project registration page
		//$_SESSION['username'] = $stu_email;
        echo '<script>window.location="register.html";</script>';
     }
      else{
        echo "<h1 style='text-align:center; color:red; margin-top:30px;'>Invalid username or password.</h1>";

		// echo "Registration is closed! Thank you.";
		//echo "<a href='projectlogin.html'><h3 style='text-align:center;'>Login Page</h3></a>";
		echo "<a href='index.html'><h3 style='text-align:center;'>Home Page</h3></a>";
    // echo mysqli_num_rows($done);
      }
    }
	
   //end of else if
    $conn->close();
    ?>
    <!-- end of php code -->







