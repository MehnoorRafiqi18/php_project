<?php
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true ){
    header('location: login.php');
    exit;
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
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="welcomenavbar.css" rel="stylesheet">
    <title>Welcome  <?php echo $_SESSION['emp_name']?></title>
    <script>
      document.getElement
    </script>
    <style>
      .box h2{
    float: left;
   }
.box button{
   float: right;

}
    </style>
  </head>
  <body>

    <div class="wrapper">
      <div class="sidebar">
        <h2>YARIKUL INFOTECH</h2>
        <ul>
          <li><a href="#"><i class="fas fa-home" style="color: #f2f4f7;"></i>Home</a></li>
          <li><a href="#"><i class="fas fa-solid fa-book-open" style="color: #fcfcfc;"></i>Payroll List</a></li>
          <li><a href="#"><i class="fas fa-list-alt" style="color: #f0f2f4;"></i>Allowance List</a></li>
          <li><a href="#"><i class="fas fa-solid fa-flag" style="color: #f9fafb;"></i>Deduction List</a></li>
          <li><a href="#"><i class="fas fa-solid fa-user-lock" style="color: #fafcff;"></i>Log Out</a></li>
        </ul>
      </div>
      <div class="main_content">
        <div class="container mt-3 col-md-7">
  <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Welcome!</h4>
  <p> How're you doing? You've successfully logged in as <?php echo  $_SESSION['emp_name']; ?>. </p>
  <hr>
  <p class="mb-0"><?php
  if(isset($_GET['message'])){
    echo "<h6>". $_GET['message']. "<h6>";
}
   else if(isset($_GET['insert_msg'])){
        echo "<h6>". $_GET['insert_msg']. "<h6>";
   }
   else if(isset($_GET['update_msg'])){
        echo "<h6>". $_GET['update_msg']. "<h6>";
   }
  else if(isset($_GET['delete_msg'])){
        echo "<h6>". $_GET['delete_msg']. "<h6>";
   }
?></a></p>
</div>
  </div>

  
  <div class="box mt-5">
    <h2>Employee List</h2>
   <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add employee</button>
  <table class="table " id="myTable">
  <thead>
    <tr>
    <th scope="col">sno</th>
      <th scope="col">emp_id</th>
      <th scope="col">emp_name</th>
      <th scope="col">Ph.no</th>
      <th scope="col">Salary</th>
      <th scope="col">Position</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
          include 'dbconnect.php';
          $sql="SELECT us.emp_id, ad.* from  users us, admin ad where us.emp_id = ad.emp_id";
          $result = mysqli_query($conn,$sql);
          while( $row = mysqli_fetch_assoc($result))
          {
            ?>
           <tr>
      <th><?php echo  $row['sno']; ?></th>
      <td><?php echo $row['emp_id']; ?></td>
      <td><?php echo $row['emp_name']; ?></td>
      <td><?php echo $row['Ph_no']; ?></td>
      <td><?php echo $row['Salary']; ?></td>
      <td><?php echo $row['Position']; ?> </td>
     <td>
     <a href='update.php?id=<?php echo  $row['sno'] ;?>' class='btn btn-primary'> Update</a><a href='delete.php?id=<?php echo  $row['sno'] ;?>' class='btn btn-danger'> Delete</a></td>
     </td>
     </tr>
<?php
    
              }
?>


  </tbody>
</table></div>
<?php

$sql= "select max(emp_id)+1 as new_emp_code from admin order by sno desc limit 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$newEmployeeCode = "";
if(null === $row['new_emp_code']) {
  $newEmployeeCode = "YI-"."10001";
}else{
  $newEmpCode= $row['new_emp_code'];
  $newEmployeeCode = "YI-". $newEmpCode ;
}


?>


</div>
      </div>
    </div>
  <!-- Add Modal -->
  <form action="insert.php" method="POST">
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
  <div class="mb-3">
    <label for="emp_id" class="form-label">employee code</label>
    <input type="text" class="form-control" value="<?=  $newEmployeeCode; ?>" name="emp_id" readonly class="form-control" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="emp_name" class="form-label">emp_name</label>
    <input type="text" class="form-control" id="emp_name" name="emp_name" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="Ph_no" class="form-label">Ph_no</label>
    <input type="text" class="form-control" id="Ph_no" name="Ph_no" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="Salary" class="form-label">Salary</label>
    <input type="text" class="form-control" id="Salary" name="Salary" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
  <label for="Position" >Position</label>
  <select  id="Position"  name="Position">
  <option value="Front-end block">Front-end block</option>
  <option value="Back-end block">Back-end block</option>
  <option value="Software testing">Software testing</option>
</select></div>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name="add_employee" value="Add">
      </div>
    </div>
  </div>
</div></form>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function(){
       $('#myTable').DataTable();
    });
      </script>
      <!-- <script>
        document.getElementsByClassName('update');
        array.from(update).forEach((elements)=>{
        element.addEventListener("click", (e)=>{
          console.log("update",);
          tr = e.target.parentNode.parentNode;
          emp_id = tr.getElementsByTagName('td')[0].innerText;
          emp_name = tr.getElementsByTagName('td')[1].innerText;
          Ph.no = tr.getElementsByTagName('td')[2].innerText;
          Salary = tr.getElementsByTagName('td')[3].innerText;
          console.log(emp_id,emp_name,dept_id,Ph.no,Salary);
          emp_idupdate.value = emp_id;
          emp_nameupdate.value = emp_name;
          Ph.noupdate.value = Ph.no_id;
          Salaryupdate.value = Salary_id;
          $('#updateModal').modal('toggle');
        })
        })
      --> 

      </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>