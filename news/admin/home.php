<?php
include 'db_connect.php'; // Database connection

$cn = mysqli_connect("localhost", "root", "", "updates");

if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM news ORDER BY created_at DESC"; 
$result = $cn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="col-md-12 text-center p-4 my-5 text-white shadow-lg"> 
    <h1 class="mt-2 text-dark">News</h1>
</div>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">My Website</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="form.php">Form</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="news.php">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- News Table -->
<div class="container-fluid">
    <div class="col-12 mx-auto mt-5 shadow-lg p-4">
        <div class="table-responsive">
            <table class="table table-bordered" id="info">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Title</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Details</th>
                        <th scope="col">Link</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><img src="<?php echo $row['image']; ?>" alt="Image" class="img-fluid" style="max-width: 100px;"></td>
                        <td><?php echo $row['details']; ?></td>
                        <td><?php echo $row['link']; ?></td>
                        <td><button class="btn btn-danger">Delete</button></td>
                    </tr>
                    <?php
                        $i++;
                    }}
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap 5 Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script>
    new DataTable('#info', {
        responsive: true
    });
</script>
</body>
</html>
