<?php
session_start();
$proname=$_POST['projName'];
$teamEmail=$_POST['teamEmail'];
$st_Dept=$_POST['st_department'];
$superv_name=$_POST['supervisor'];
$proDetails=$_POST['teamProjectDetails'];
$memname0=$_POST['memberName0'];
$memname1=$_POST['memberName1'];
$memname2=$_POST['memberName2'];



//$conn=new mysqli('localhost','root','','registration');
include 'conn.php'; 

if($conn->connect_error){
    die('Connection Failed :' .$conn->connect_error);
}


else if(isset($_POST['submit']))

    {
    
	$files = array();
	$i = 0;
	foreach($_FILES['cvFile1']['name'] as $key=>$val)
    {
		$files[$i]='Cvs/'.$val;
		
		move_uploaded_file($_FILES['cvFile1']['tmp_name'][$key],$files[$i]);
		
		$i++;
	}
        $stmt =$conn->prepare("insert into student(proj_title,stu_email,stu_dept,superv_name,proj_descrip,cv_path1,cv_path2,cv_path3,mem1_name,mem2_name,mem3_name)values(?,?,?,?,?,?,?,?,?,?,?)");
        
        $stmt->bind_param("sssssssssss",$proname,$teamEmail,$st_Dept,$superv_name,$proDetails,$files[0],$files[1],$files[2],$memname0,$memname1,$memname2);
    
     
        $stmt->execute();
        $stmt->close();
        

    if($stmt)
    {		if(isset($_SESSION["username"]))
				unset($_SESSION["username"]);
            print"\nRegistration done successfully.";
			echo "<a href='index.html'><h3 style='text-align:center;'>Home Page</h3></a>";
    }

    else
    {
        echo" Error: Registration failed. Please contact admin.";
    }


    }
    //end of else if
 

    $conn->close();
    ?>
    <!-- end of php code -->







