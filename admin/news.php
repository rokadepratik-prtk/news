<?php
include 'db_connect.php'; // Database connection

$cn = mysqli_connect("localhost", "root", "", "updates");

if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle deletion if delete request is received
if (isset($_POST['delete'])) {
    $id = mysqli_real_escape_string($cn, $_POST['id']);
    
    // Fetch the image path to delete the file from the server
    $query = "SELECT image FROM news WHERE id = ?";
    $stmt = $cn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $imagePath = $row['image'];
        
        // Delete the image file from the server
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    // Delete the record from the database
    $deleteQuery = "DELETE FROM news WHERE id = ?";
    $deleteStmt = $cn->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $id);
    if ($deleteStmt->execute()) {
        echo "<script>alert('News deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting news');</script>";
    }
}

// Prepared statement to prevent SQL injection
$query = "SELECT * FROM news ORDER BY created_at DESC";
$result = $cn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Admin News Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="images/penegg.png">My Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item ">
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
   
    <div class="container">
        <div class="col-12 col-sm-12 mx-auto mt-5 shadow-lg p-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="info">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Title</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Details</th>
                            <td scope="col">Link</td>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if ($result->num_rows > 0) {
                            // Loop through each row and display the news
                            while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Image" class="img-fluid" style="max-width: 100px;"></td>
                            <td><?php echo htmlspecialchars($row['details']); ?></td>
                            <td><a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank">View</a></td>
                            <td>
                                <!-- Delete Button Form -->
                                <form method="POST" action="" onsubmit="return confirmDelete();">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script> 
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> 
    <script>
        new DataTable('#info');

        function confirmDelete() {
            return confirm("Are you sure you want to delete this news item?");
        }
    </script>
</body>
</html>
