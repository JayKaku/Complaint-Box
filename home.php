<!doctype html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="style-home.css">
		<script src="myscripts.js"></script>
	</head>
    <body>
        <h1>Homepage</h1>
        <h2>Complaint Box</h2>

<?php
include "config.php";

$username=$_SESSION['uname'];
$pass=$_SESSION['password'];

$sql="SELECT username,complaint,status FROM users WHERE username='$username'";
$response=mysqli_query($con,$sql);

if($response){
    echo'<table align="left" cellspacing="5" cellpadding="8">

    <tr><td align="left"><b> Complaint </b></td>; 
    <td align="left"><b> Status</b></tb></tr>';

    while($row=mysqli_fetch_array($response)){
        echo '<tr><td align="left">'.
        $row['complaint'].'<td align="left">'. 
        $row['status'].'<td align="left">';
        echo'</tr>';
    }
    echo'</table>';
}

if(isset($_POST['but_submit_c'])){

$input=$_POST['input_box'];

$query="INSERT INTO users (username,password,complaint,status) VALUES ('$username','$pass','$input','')";

if(mysqli_query($con,$query)) {
    
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
        alert("New record created successfully");

}else{
    
    echo "Error:". $query . "</br>" . mysqli_error($con);
}



mysqli_close($con);

}

if(!isset($_SESSION['uname'])){
    header('Location: login.php');
}

if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: login.php');
}
?>

        <form method='post' action="">
            <input type="submit" value="Logout" name="but_logout" id="but_logout">
        </form>
        <div class="box">
        <form method='post'action="">
            <p>Drop your complaint (max 400 chracters):</p>
           <p> <textarea type="text" id="input_box" name="input_box" maxlength="400" placeholder="Type your complaint here" required></textarea>
            </p> 
            <p>
			<input type="submit" value="Send" name="but_submit_c" id="but_submit_c" />
			</p>
        </form>
        </div>
    </body>
</html>
