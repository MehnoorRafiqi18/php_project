<?php include('header.php'); ?>
<?php include('dbconnect.php') ; ?>
<?php include('insert.php'); ?>

<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql="SELECT * FROM `admin` where `sno` = '$id'";
    $result = mysqli_query($conn,$sql);
    if(!$result){
        die("Query failed ".mysqli_error());
    }
    else{
        $row = mysqli_fetch_assoc($result);

        }
    }
    
    ?>
<?php
if(isset($_POST['update_admin'])){
    if(isset($_GET['id_new'])){
        $idnew = $_GET['id_new'];
    }
    $emp_id=$_POST['emp_id'];
    $emp_name=$_POST['emp_name'];
    $Ph_no=$_POST['Ph_no'];
    $Salary=$_POST['Salary'];
    $Position = $_POST['Position'];

    $sql = "UPDATE `admin` set `emp_name` = '$emp_name', `Ph_no`= '$Ph_no', `Salary` = '$Salary', `Position` = '$Position' where `sno`= '$idnew'";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die("Query failed ".mysqli_error());
    }
    else{
        header('location: welcome.php?update_msg= You have successfully updated the data.');

        }
}
?>
<form action="update.php?id_new=<?php echo $id;?>" method="POST">
    <h2>Enter the Changes </h2>
  
  <div class="form-group mb-3 col-md-6 ">
    <label for="emp_name">emp_name</label>
    <input type="text" class="form-control"  name="emp_name" value="<?= $row['emp_name']?>">
  </div>
  <div class="form-group mb-3 col-md-6">
    <label for="Ph_no">Ph_no</label>
    <input type="number" class="form-control" name="Ph_no" value="<?php echo $row['Ph_no'] ?>">
  </div>
  <div class="form-group mb-3 col-md-6">
    <label for="Salary">Salary</label>
    <input type="number" class="form-control" name="Salary" value="<?php echo $row['Salary']?>">
  </div>
  <div class="form-group mb-3 col-md-6 ml-6">
  <label for="Position" >Position</label>
  <select  name="Position" value="<?php echo $row['Position'];?>">
  <option value="Front-end block">Front-end block</option>
  <option value="Back-end block">Back-end block</option>
  <option value="Software testing">Software testing</option>
</select>
  </div>
</div>
  <div class="button">
  <input type="submit" class="btn btn-primary" name="update_admin" value="update"></button>
</div>
</form>

<?php include('footer.php'); ?>