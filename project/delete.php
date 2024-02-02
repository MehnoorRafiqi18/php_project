 <?php
include 'dbconnect.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
   $sql= "DELETE from `admin` where `sno` = '$id'";
   $result = mysqli_query($conn, $sql);
   if(!$result){
    die("Query failed".mysqli_error());
   }
   else{
    header("location: welcome.php?delete_msg=You have deleted the record.");
   }
    
}
?>



