<?php
include 'dbconnect.php';
$showalert=false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"]== "POST"){
   $emp_name = $_POST["emp_name"];
   $password = $_POST["password"];
   $cpassword = $_POST["cpassword"];
   //check whether the emp_name exists or not
   $sqlexists ="SELECT * FROM `users` WHERE `emp_name` = '$emp_name'";
   $result = mysqli_query($conn, $sqlexists);
   $numexists = mysqli_num_rows($result);
   if($numexists > 0){
    $showerror = "emp_name already Exists";
   }
   else{
     if($password == $cpassword){
      $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users` ( `emp_name`, `password`, `dt`) VALUES ( '$emp_name', '$hash', current_timestamp())";
    $result = mysqli_query($conn,$sql);
    if($result){
    $showalert = true;
    }
   }
   else{
     $showerror = "passwords do not match";
   }
   }
  
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sign Up</title>
  </head>
  <body>
    <?php
    require 'partials/navbar.php';
    if($showalert){
        echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is now created, you can login now.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($showerror){
        echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong> Error!</strong> Your account is not created because '. $showerror . 
  '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    ?>
<div class="container mt-5 ">
<form action="/project/signup.php" method="post">
    <h2>Sign Up</h2>
  <div class="mb-3 col-md-6">
    <label for="emp_name" class="form-label">emp_name</label>
    <input type="text" maxlength="12" class="form-control" id="emp_name" name="emp_name" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 col-md-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" maxlength="22"  class="form-control" id="password" name="password">
  </div>
  <div class="mb-3 col-md-6">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
  </div>
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>



</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>