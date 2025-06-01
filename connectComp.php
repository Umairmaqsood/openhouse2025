<?php

// Retrieve form data
$u_count = isset($_POST['user_count']) ? (int)$_POST['user_count'] : 1;
$name = $_POST['compName'] ?? '';
$web = $_POST['compWeb'] ?? '';
$email = $_POST['compEmail'] ?? '';
$vehicleNo = $_POST['vehicleNo'] ?? '';
$comp_faculty_array = isset($_POST['departments']) ? $_POST['departments'] : []; // array of selected departments

// Initialize member data
$memname0 = $_POST['memberName0'] ?? '';
$mem_des0 = $_POST['memberDesig0'] ?? '';
$mem_email0 = $_POST['memberemail0'] ?? '';
$mem_phn0 = $_POST['memberPhone0'] ?? '';
$memname1 = '';
$mem_des1 = '';
$mem_email1 = '';
$mem_phn1 = '';
$memname2 = '';
$mem_des2 = '';
$mem_email2 = '';
$mem_phn2 = '';

// Populate additional member data based on user_count
if ($u_count >= 2) {
    $memname1 = $_POST['memberName1'] ?? '';
    $mem_des1 = $_POST['memberDesig1'] ?? '';
    $mem_email1 = $_POST['memberemail1'] ?? '';
    $mem_phn1 = $_POST['memberPhone1'] ?? '';
}
if ($u_count >= 3) {
    $memname2 = $_POST['memberName2'] ?? '';
    $mem_des2 = $_POST['memberDesig2'] ?? '';
    $mem_email2 = $_POST['memberemail2'] ?? '';
    $mem_phn2 = $_POST['memberPhone2'] ?? '';
}

// Faculty ID to Name mapping
$faculty_map = [
    "1" => "Faculty of Engineering & IT (Dept. of SE, ECE, ET, Bio-Medical)",
    "2" => "Faculty of Management Sciences (Dept. of BBA, E&F, Tourism & Hospitality)",
    "4" => "Department of English",
    "5" => "Department of Psychology",
    "6" => "Department of Arts and Media Sciences"
];

// Include the database connection
include 'conn.php';

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Prepare the SQL statement with 17 columns
$sql = "INSERT INTO company_rest (
            comp_email, comp_name, comp_web, vehicleNo, comp_faculty, 
            mem0_name, mem0_desg, mem0_email, mem0_phone, 
            mem1_name, mem1_desg, mem1_email, mem1_phone, 
            mem2_name, mem2_desg, mem2_email, mem2_phone
        ) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('SQL Error: ' . $conn->error);
}

// Arrays to store success and error departments
$successful_depts = [];
$failed_depts = [];

// Loop through the selected departments
foreach ($comp_faculty_array as $comp_faculty) {
    $stmt->bind_param(
        "sssssssssssssssss",
        $email,
        $name,
        $web,
        $vehicleNo,
        $comp_faculty,
        $memname0,
        $mem_des0,
        $mem_email0,
        $mem_phn0,
        $memname1,
        $mem_des1,
        $mem_email1,
        $mem_phn1,
        $memname2,
        $mem_des2,
        $mem_email2,
        $mem_phn2
    );

    if ($stmt->execute()) {
        $successful_depts[] = $faculty_map[$comp_faculty] ?? "Department $comp_faculty";
    } else {
        $failed_depts[] = "Department $comp_faculty: " . $stmt->error;
    }
}

// Show success message
if (!empty($successful_depts)) {
    $joined = implode(", ", $successful_depts);
    echo "<h3 style='text-align:center; color:green; margin-top:40px;'>Registration for $joined done successfully.</h3><br>";
    echo "<a href='index.html'><h3 style='text-align:center;'>Go to Home Page</h3></a>";
}

// Show error messages if any
if (!empty($failed_depts)) {
    foreach ($failed_depts as $err) {
        echo "<p style='color:red;'>Registration failed for $err</p>";
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
