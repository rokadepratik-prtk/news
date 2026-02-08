<?php 

include 'db_connect.php'; 


$cn =mysqli_connect("localhost","root","","updates");
    if(!isset( $_SESSION['id']))
    {
        echo "<script>
       
        window.location.href='login.php';
        </script>";
    }
    else
    {
        $id =$_SESSION['id'];
        $qca = "SELECT * FROM admins WHERE id = $id";
        $resultA = mysqli_query($cn,$qca);
        $dataA=mysqli_fetch_assoc($resultA);
 
    }
    ?>