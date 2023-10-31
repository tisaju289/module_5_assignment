<?php 
session_start(); 

  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

require('function.php');
define('DB','db.txt');
if(isset($_POST['name'])){
	$id = $_POST['id'];
	$nama = $_POST['name'];
	$email = $_POST['email'];
    $password = $_POST['password']; 
	$role = $_POST['role'];
	$dataLast = edit($_POST['id']);
	$content = str_replace($dataLast,"$id|$nama|$email|$password|$role|",file_get_contents(DB));
	saveTxt(DB,$content,'w');
	header('location:admin_dashboard.php');
	//exit;
	
}

if(!empty($_GET['id'])){
	$loadEdit = edit($_GET['id']);
	$explEdit = explode('|',$loadEdit);
    $id = $explEdit[0];
	$nama = $explEdit[1];
	$email = $explEdit[2];
    $password = $explEdit[3];
	$role = $explEdit[4];
	
}

function edit($id){
	$loadDB = @file(DB, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($loadDB as $data){
		$exp = explode('|',$data);
		$myid = $exp[0];
		if($myid==$id){
			$out = $data;
			break;
		}else{
			$out = null;
		}
		
	}
	
return $out;
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
                        <img src="https://cdn.ostad.app/public/upload/2022-11-27T06-52-05.802Z-logo%20ostad.png" alt="Centered Image" class="img-fluid">
                    </div>
                    <h3 class="text-center">PHP & Laravel Batch 2- Assignment (Module-05)</h3>
                    <h3 class="text-center alert-info">Admin Dashboard-Role Management Page</h3>
                    <div style="margin: 20px; padding: 10px; background-color: white;">
                    <div class="row">
                        <div class="col-md-12 mx-auto mt-2">
                            <div class="card-header d-flex align-items-center justify-content-between" >
                                  <h2 class="text-left alert-success">Welcome: <?php echo $_SESSION['name'];?>(<?php echo $_SESSION['role'];?>)</h2>
                                    <div class="small text-white">
                                    <button type="button" class="btn bg-danger btn-sm text-white" onClick="performLogout()">Logout</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="container">
                            <div class="row justify-content-center">
                            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                                <div class="card form-signup">
                                    <div class="card-header" >
                                        <h3 class="card-title">Edit & Update User Role</h3>
                                    </div>
                                <div class="card-body p-5">
                                    <form action="update.php" method="POST">
                                        <input type="text" id="id" name="id" class="form-control d-none" value="<?=$id;?>"/>
                                        <input type="text" id="id" name="password" class="form-control d-none" value="<?=$password;?>"/>

                                        <div class="form-floating mb-4">
                                        <input type="text" id="name" name="name" class="form-control" value="<?=$nama;?>" placeholder="Enter User Name" />
                                        <label class="form-label" for="name">User Name</label>
                                        </div>                  

                                    <div class="form-floating mb-4">
                                        <input type="email" id="email" name="email" class="form-control " value="<?=$email;?>" placeholder="Your Email" />
                                        <label class="form-label" for="email">User Email</label>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">

                                        <div class="form-floating">
                                            <select class="form-select" name="role" id="floatingSelectGrid" aria-label="Floating label select example">
                                            <option value="<?=$role;?>" selected><?=$role;?></option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Guest">Guest</option>
                                            </select>
                                            <label for="floatingSelectGrid">Roll</label>
                                        </div>


                                        </div>
                                    </div>

                                    <div class="submit form text-center">
                                        <a href="#"><button type="submit" class="btn btn-info btn-block">Update</button></a>
                                        <a href="admin_dashboard.php"><button type="button" class="btn btn-secondary btn-block">Cancel</button></a>
                                    </div>
                                </form>

                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
<!-- Make sure these scripts are properly included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function performLogout() {
            // Redirect to the logout page
            window.location.href = 'logout.php';
        }
    </script>
</body>
</html>

