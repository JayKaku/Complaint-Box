<?php
include "config.php";

if(isset($_POST['but_submit'])){

    $uname = mysqli_real_escape_string($con,$_POST['txt_uname']);
    $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);
	
    if ($uname != "" && $password != ""){

        $sql_query = "select count(*) as cntUser from users where username='".$uname."' and password='".$password."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0 && $uname =="admin"){
            $_SESSION['uname'] = $uname;
            header('Location: admin.php');
        }elseif($count > 0){
			$_SESSION['uname'] = $uname;
			$_SESSION['password'] = $password;
            header('Location: home.php');
		}else{
            
			function alert($msg) {
			echo "<script type='text/javascript'>alert('$msg');</script>";
			}
			alert("Access Denied: Invalid username or password");
			
        }

    }

}
?>

<!doctype html>
<html>
	<head>
		<title>Login Form</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="myscripts.js"></script>
	</head>

	<body>		
		<div class = "loginbox center">
			<h1>Cyber Security Portal</h1>
			
			<img src="./kindpng_5493534.png" class="avatar">
			
			<h2 class = "center">Login</h2>
			<form action = "" method = "POST">
				<input id = "username" type="text" name="txt_uname" placeholder="Username" required>
				<input id = "username" type="password" name="txt_pwd" placeholder="Password" required>
			
				<p>
					<input type="submit" value="Login" name="but_submit" id="but_submit" />
				</p>
			</form>
		</div>
		
	</body>
</html>	