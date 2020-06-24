<!doctype html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="style-admin.css">
		<script src="myscripts.js"></script>
	</head>
    <body>
        <h1>Admin Page</h1>
<?php
include "config.php";

$query="SELECT id,username,complaint,status FROM users";

$response=mysqli_query($con,$query);

if($response){
    echo'<table align="left" cellspacing="5" cellpadding="8">

    <tr> <td align="left"><b> User </b></td>
    <td align="left"><b> Id </b></td>
    <td align="left"><b> Complaint </b></td>
    <td align="left"><b> Status </b></td></tr>';

    while($row=mysqli_fetch_array($response)){
        echo '<tr><td align="left">'.
        $row['username'].'<td align="left">'. 
        $row['id'].'<td align="left">'.
        $row['complaint'].'<td align="left">'.
        $row['status'].'<td align="left">';
        echo'</tr>';
    }
    echo'</table>';
    }else{
        function alert($msg) {
			echo "<script type='text/javascript'>alert('$msg');</script>";
			}
			alert("Failed to connect");
    echo mysqli_error($con);
}


if(isset($_POST['but_submit_u'])){

    $status_update=$_POST['update'];
    $status_id=$_POST['id'];

    $sql="UPDATE users  SET status='$status_update' WHERE id='$status_id' ";
    
    if(mysqli_query($con,$sql)) {
        
        function alert($msg) {
			echo "<script type='text/javascript'>alert('$msg');</script>";
		}
			alert("New record created successfully");
    
    }else{
        
        echo "Error:". $sql . "</br>" . mysqli_error($con);
    }

}
mysqli_close($con);


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
        <div class="Updatebox">
        <form method='post'action="">
        <p>Update Status:</p>
        <p><input type="text" id="update" name="update" placeholder="Update status here" required></p>
        <p>Id:</p>
        <p><input type="text" id="update" name="id" placeholder="Input Id here" required></p>
        <p>
			<input type="submit" value="Update" name="but_submit_u" id="but_submit_u" />
        </p>
        </form>
        </div>
    </body>
</html>
