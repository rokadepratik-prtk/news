<?php
include 'db_connect.php'; // Database connection
$cn = mysqli_connect("localhost", "root", "", "updates");

if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["b1"])) {
    $em = $_POST['username'];
    $pwd = $_POST['password'];

    // Prepared statement to prevent SQL injection
    $qS = $cn->prepare("SELECT * FROM admins WHERE username=?");
    $qS->bind_param("s", $em); // "s" means the parameter is a string
    $qS->execute();
    $result = $qS->get_result();

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();

        // Verifying the password hash
        if (password_verify($pwd, $data['Password'])) {
            session_start();
            $_SESSION['id'] = $data['id'];
            echo "<script>
                alert('Login Successfully');
                window.location.href='form.php';
            </script>";
        } else {
            echo "<script>
                alert('Incorrect password');
                window.location.href='login.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Invalid username');
            window.location.href='login.php';
        </script>";
    }

    $qS->close();
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