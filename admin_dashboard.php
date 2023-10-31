<?php 
  session_start(); 
  define('DB', 'db.txt');
  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container bg-info">
        <div class="row">
            <div class="col-md-10 mx-auto mt-5">
                <div>
                    <div class="text-center"> 
                        <!-- <img src="https://cdn.ostad.app/public/upload/2022-11-27T06-52-05.802Z-logo%20ostad.png" alt="Centered Image" class="img-fluid"> -->
                    </div>
                    <!-- <h3 class="text-center">PHP & Laravel Batch 2- Assignment (Module-05)</h3> -->
                    <!-- <h3 class="text-center alert-info">Admin Dashboard-Role Management Page</h3> -->
                    <div style="margin: 20px; padding: 10px; background-color: white;">
                    <div class="row">
                        <div class="col-md-12 mx-auto mt-2">
                            <div class="card-header d-flex align-items-center justify-content-between" >
                                  <h2 class="text-left alert-success">Welcome: <?php echo $_SESSION['name'];?>(<?php echo $_SESSION['role'];?>)</h2>
                                    <div class="small text-white">
                                    <button type="button" class="btn bg-danger btn-sm text-white" onClick="performLogout()">Logout</button>
                                    </div>
                                </div>
                                <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between" >
                                    <h3 class="card-title">Users list</h3>
                                    <div class="small text-white">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_newUser">
                                            <i class="fa fa-plus"></i>Add New User</button>
                                    </div>
                                </div>
                            <div class="card-body">

                            <table id="myTable_User" class="table table-bordered table-striped table-hover">
                                    <thead style="background:#009688; color: white;">
                                        <tr>
                   -                         <th style="5%">Sl</th>
                                            <!-- <th style="5%">ID</th> -->
                                            <th style="30%">Name</th>
                                            <th style="30%">Email</th>
                                            <th style="15%">Role</th>
                                            <th class="text-center" style="20%" colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        // define('DB', 'db.txt');
                                        $select_data_run = @file(DB, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                                        $i = 1;

                                        foreach ($select_data_run as $row) {
                                            $expData = explode('|', $row);
                                            $Role = $expData[4];

                                            // Check if the role is "User"
                                            if ($Role !== 'Admin') {
                                                $id = $expData[0];
                                                $Nama = $expData[1];
                                                $Email = $expData[2];
                                                ?>
                                                <tr>	
                                                    <td class="text-center"><?=$i;?></td>
                                                    <!-- <td class="text-center"><?=$id;?></td> -->
                                                    <td><?=$Nama;?></td>
                                                    <td><?=$Email;?></td> 
                                                    <td><?=$Role;?></td> 
                                                    <td class="text-center">
                                                        <form action="update.php" method="GET">
                                                            <input type="text" value="<?php echo $id;?>" name="id" class="d-none"/>
                                                            <button type="submit" class="editBtn btn btn-success btn-sm">
                                                            Edit
                                                            </button>
                                                        </form>
                                                    </td> 
                                                    <td class="text-center">
                                                        <button type="button" onclick="Delete(<?php echo $id;?>)" class="deleteBtn btn btn-danger btn-sm">
                                                        Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }

                                        if ($i === 1) {
                                            // If no "User" records were found, display a message
                                            echo '<tr class="text-center"><td colspan="6">No records found for "User".</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                </div>
                            </div>
                                <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between" >
                                    <h3 class="card-title">Admin list</h3>
                                    <div class="small text-white">
                                        <!-- Button trigger modal -->
                                        <!-- <button type="button" class="btn btn-primary text-right text-white" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus"></i>Create User</button> -->
                                    </div>
                                </div>
                            <div class="card-body">

                            <table id="myTable_admin" class="table table-bordered table-striped table-hover">
                                    <thead style="background:#009688; color: white;">
                                        <tr>
                                            <th style="5%">Sl</th>
                                            <!-- <th style="5%">ID</th> -->
                                            <th style="30%">Name</th>
                                            <th style="30%">Email</th>
                                            <th style="20%">Role</th>
                                            <th class="text-center" style="20%" colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                        $select_data_run = @file(DB, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                                        $i = 1;

                                        foreach ($select_data_run as $row) {
                                            $expData = explode('|', $row);
                                            $Role = $expData[4];

                                            // Check if the role is "User"
                                            if ($Role === 'Admin') {
                                                $id = $expData[0];
                                                $Nama = $expData[1];
                                                $Email = $expData[2];
                                                
                                                // Check if the ID is 1
                                                $idIsOne = ($id == 1);
                                            
                                                ?>
                                                <tr>	
                                                    <td class="text-center"><?=$i;?></td>
                                                    <td><?=$Nama;?></td>
                                                    <td><?=$Email;?></td> 
                                                    <td><?=$Role;?></td> 
                                                    <td class="text-center">
                                                        <form action="update.php" method="GET">
                                                            <input type="text" value="<?php echo $id;?>" name="id" class="d-none"/>
                                                            <!-- Disable the Edit button if the ID is 1 -->
                                                            <button type="submit" class="editBtn btn btn-success btn-sm" <?= ($idIsOne) ? 'disabled' : '' ?>>
                                                                Edit
                                                            </button>
                                                        </form>
                                                    </td> 
                                                    <td class="text-center">
                                                        <!-- Disable the Delete button if the ID is 1 -->
                                                        <button type="button" onclick="Delete(<?php echo $id;?>)" class="deleteBtn btn btn-danger btn-sm" <?= ($idIsOne) ? 'disabled' : '' ?>>
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }

                                        if ($i === 1) {
                                            // If no "Admin" records were found, display a message
                                            echo '<tr class="text-center"><td colspan="6">No records found for "Admin".</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                </div>
                            </div>

                           
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


  <!-- Add New Modal -->
<div class="modal" id="add_newUser">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New User</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form id="form_data">
            <div class="form-group">
                <label for="c_user_name">User Name</label>
                <input type="text" name="c_user_name" id="c_user_name"  class="form-control" placeholder="Enter User Name" required>
            </div>
            <div class="form-group">
                <label for="c_email">Email</label>
                <input type="email" name="c_email" id="c_email"  class="form-control" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="c_password">
                    Password
                </label>
                <input type="password" name="c_password" id="c_password"  class="form-control" placeholder="Enter Password" required>
            </div>
            
      </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" onclick="AddUser()" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
  <!-- Edit User Modal -->
  <div class="modal" id="edit_newUser">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New User</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form id="form_update">
            <div class="form-group">
                <label for="edit_user_name">User Name</label>
                <input type="text" name="edit_user_name" id="edit_user_name"  class="form-control" placeholder="Enter User Name" required>
            </div>
            <div class="form-group">
                <label for="edit_email">Email</label>
                <input type="email" name="edit_email" id="edit_email"  class="form-control" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="edit_role">
                    Role
                </label>
                <input type="password" name="edit_role" id="edit_role"  class="form-control" placeholder="Enter Role" required>
            </div>
            
      </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" onclick="EditUser()" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Make sure these scripts are properly included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script>
        function performLogout() {
            // Redirect to the logout page
            window.location.href = 'logout.php';
        }
    </script>
    <script>
    //for insert code starts here
function AddUser(){
    var c_user_name = $("#c_user_name").val();
    var c_email = $("#c_email").val();
    var c_password = $("#c_password").val();
    // Regular expression pattern for email validation
    var emailPattern = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;

    if (emailPattern.test(c_email)) {
        // alert("Valid email address");
        $.ajax({
        url:"crud_code.php",
        method:"post",
        data:{
            c_user_name:c_user_name,
            c_email:c_email,
            c_password:c_password

        } ,
        success:function(data){
            
            $('#add_newUser').modal('hide');
            $('#form_data')[0].reset();
            // var targetURL = 'admin_dashboard.php'; // Adjust the URL as needed
            // $('#myTable_User').load(targetURL + " #myTable_User");
             $('#myTable_User').load(location.href + " #myTable_User");
             $('#myTable_admin').load(location.href + " #myTable_admin");
            setTimeout(function() {
                alert(data);
            }, 200);  // Adjust the delay time (in milliseconds) as needed
        }   
    });
    } else {
        alert("Invalid email address");
    }
}

// Delete User
function Delete(userID){
    $.ajax({
        url:"crud_code.php",
        method:"post",
        data:{ userID:userID } ,
        success:function(data){
             $('#myTable_User').load(location.href + " #myTable_User");
             $('#myTable_admin').load(location.href + " #myTable_admin");
            setTimeout(function() {
                alert(data);
            }, 200);  // Adjust the delay time (in milliseconds) as needed
        }   
    });
}

</script>
</body>
</html>

