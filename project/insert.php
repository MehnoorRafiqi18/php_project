<?php
include 'dbconnect.php';
if(isset($_POST['add_employee'])){
    $employeeCode= str_replace('YI-','', $_POST['emp_id']);
    $emp_name=$_POST['emp_name'];
    $Ph_no=$_POST['Ph_no'];
    $Salary=$_POST['Salary'];
    $Position=$_POST['Position'];
    
    if($emp_name=="" || empty($emp_name)){
        header('location: welcome.php?message=You need to enter your name!');
 }
 else{
    $sql = "INSERT INTO `admin` ( `emp_id`,`emp_name`, `Ph_no`, `Salary`,`Position`) VALUES ( '$employeeCode','$emp_name', '$Ph_no', '$Salary','$Position')";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die("query failed".mysqli_error());
    }
    else{
        header('location: welcome.php?insert_msg=your data is added successfully');
    }
 }
}
?>