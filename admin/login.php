<?php
include 'db_connect.php'; // Database connection
$cn = mysqli_connect("localhost","root","","updates");
session_start(); 
if(isset($_POST["b1"])){
    $em=$_POST['username'];
    $pwd=$_POST['password'];





$qS="SELECT * FROM  admins WHERE username='$em' AND Password='$pwd'";




$r= mysqli_query($cn,$qS);

$count =mysqli_num_rows($r);
$d=mysqli_query($cn,$qS);
if($count  ==1)
        {
            
             $data = mysqli_fetch_assoc($d);
           // var_dump($data);
            $_SESSION['id'] =$data['id'];
           echo "<script>
            alert('Login Successfully');
            window.location.href='form.php';
            </script>";

        }
    else
    {
        echo "<script>
        alert('faild');
        window.location.href='login.php';
        </script>";
    }
      

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="col-md-4 mx-auto text-center shadow-lg p-4 mt-4 rounded bg-white">
        <div class="bg-danger p-2 text-white rounded-top">
            <h2>Welcome</h2>
        </div>
     
       
        <form action="login.php" method="POST">
          
                <input type="text" name="username" id="username" class="form-control my-4" placeholder="User ID" required>
            
           
                <input type="password" name="password" id="password" class="form-control my-4" placeholder="Password" required>
       
            <button type="submit" name="b1" class="btn btn-primary btn-block my-3">Login</button>
        </form>
    </div>

</body>
</html>
