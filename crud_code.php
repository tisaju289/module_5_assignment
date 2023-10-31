<?php
require('function.php');
define('DB', 'db.txt');
if (isset($_POST['c_user_name']) && isset($_POST['c_email']) &&  isset($_POST['c_password'] )) {
    $nama = $_POST['c_user_name'];
    $email = $_POST['c_email'];
    $password = $_POST['c_password'];

    // Initialize $loadDB
    $loadDB = array();

    // Check if the email already exists in the database.
    $emailExists = false;

    if (file_exists(DB)) {
        $loadDB = @file(DB, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($loadDB as $line) {
            $data = explode('|', $line);
            $storedEmail = $data[2];

            if ($email === $storedEmail) {
                $emailExists = true;
                break;
            }
        }
    }

    if ($emailExists) {
        // Email already exists, show an alert message.
        // echo '<script>alert("Email already exists. Please use a different email.");</script>';
         // Set the error message
         echo "Email already exists. Please use a different email.";
    } else {
        // Email is not in the database, proceed to add the new record.
        // if (!file_exists(DB)) {
        //     saveTxt(DB, "1|Abdur Rahim|rahim@gmail.com|12345|Admin|" . PHP_EOL, 'a');
        // }

        $total = explode("|", $loadDB[count($loadDB) - 1]);

        $id = $total[0] + 1;
        $role = "User";

        $saveTxt(DB, "$id|$nama|$email|$password|$role|" . PHP_EOL, 'a');

        // header('location: login.php');
        echo "New User Added Successfully";
        exit;
    }
}

// Edit data
if(!empty($_GET['id'])){
	$loadEdit = edit($_GET['id']);
	$explEdit = explode('|',$loadEdit);
	$nama = $explEdit[1];
	$email = $explEdit[2];
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


// Delete User
if(isset($_POST['userID'])){
	dell($_POST['userID']);
    echo "User Data Deleted Successfully";
}else{
	echo 'User Data Not Deleted';
}

function dell($userID){
	$loadDB = @file(DB, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($loadDB as $data){
		$exp = explode('|',$data);
		$myid = $exp[0];
		if($myid==$userID){
			$out = $data;
			$dell = str_replace($out.PHP_EOL,'',file_get_contents(DB));
			saveTxt(DB,$dell,'w');
			break;
		}else{
			$out = null;
		}
		
	}
	
return $out;
}
?>