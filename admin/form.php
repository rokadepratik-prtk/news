<?php
include "db_connect.php"; // Database connection
session_start();

// Check if the session is active
if (!isset($_SESSION['id'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

// Debug form data
// var_dump($_POST);
// var_dump($_FILES);

if (isset($_POST['b1'])) {
    // Sanitize and retrieve form inputs
    $title = mysqli_real_escape_string($cn, $_POST['title']);
    $sub = mysqli_real_escape_string($cn, $_POST['sub']);

    $details = mysqli_real_escape_string($cn, $_POST['details']);
    $category = mysqli_real_escape_string($cn, $_POST['category']);
    $youtube_link = mysqli_real_escape_string($cn, $_POST['link']);
    
    // Handle file uploads
    $thumbnail = NULL;
    $image = NULL;
    $other_photos = NULL;

    // Create uploads directory if it doesn't exist
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Upload thumbnail
    if (isset($_FILES['Thumbnail']) && $_FILES['Thumbnail']['error'] == 0) {
        $thumbnail = 'uploads/' . basename($_FILES['Thumbnail']['name']);
        move_uploaded_file($_FILES['Thumbnail']['tmp_name'], $thumbnail);
    }

    // Upload image
    if (isset($_FILES['images']) && $_FILES['images']['error'] == 0) {
        $image = 'uploads/' . basename($_FILES['images']['name']);
        move_uploaded_file($_FILES['images']['tmp_name'], $image);
    }

    // Upload other photos (multiple)
    if (isset($_FILES['other_photos']['name'][0]) && $_FILES['other_photos']['error'][0] == 0) {
        $other_photos = [];
        foreach ($_FILES['other_photos']['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($_FILES['other_photos']['name'][$key]);
            $other_photo_path = 'uploads/' . $file_name;
            move_uploaded_file($tmp_name, $other_photo_path);
            $other_photos[] = $other_photo_path;
        }
        // Convert array to JSON for storage
        $other_photos = json_encode($other_photos);
    }

   // Prepare the SQL insert statement
$stmt = $cn->prepare("INSERT INTO news (title, sub, details, image, link, thumbnail, other_photos, category, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
if ($stmt === false) {
    echo "Error preparing statement: " . $cn->error;
    exit();
}

// Check if other_photos is NULL
if (empty($other_photos)) {
    $other_photos = NULL; // explicitly set to NULL
}

// Bind parameters
$stmt->bind_param("ssssssss", $title, $sub, $details, $image, $youtube_link, $thumbnail, $other_photos, $category);

// Execute statement and check for errors
if (!$stmt->execute()) {
    echo "<script>alert('SQL Error: " . $stmt->error . "');</script>";
} else {
    echo "<script>alert('News posted successfully');</script>";
}

$stmt->close();

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>


<body>
    


<div class="col-md-12">
   

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


<div class="col-sm-8 mx-auto shadow-lg p-4 m-4 text-center bg-white">
    <div class="bg-danger p-2 m-2 text-white">
        <h1 class="text-center">Post News</h1>
    </div>

    <div class="p-4">
        <form action="form.php" method="post" enctype="multipart/form-data">
           <div class="bg-secondary p-4 mb-5">
             <label for="title" class="shadow-sm "><h3 class="text-white">Headline</h3></label>
            <input type="text" name="title" id="title" class="form-control mb-4 shadow-sm" placeholder="Headline" required>
            </div>

            <div class="bg-secondary p-4 mb-5">
            <label for="category" class="shadow-sm p-2"><h3 class="text-white">News category</h3></label>
            <select name="category" class="form-select mb-3 shadow-sm" aria-label="Default select example" required>
                <option selected hidden>News category</option>
                <option value="Satara">Satara</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Politics">Politics</option>
                <option value="Sports">Sports</option>
                <option value="Agriculture">Agriculture</option>
            </select>
           </div>


           <div class="bg-secondary p-4 mb-5">

<label for="sub" class="shadow-sm p-2"><h3 class="text-white">Sub Title</h3></label>
<textarea name="sub" id="sub" class="form-control mb-3" placeholder="Enter Sub Title" required></textarea>
 </div>


           <div class="bg-secondary p-4 mb-5">

            <label for="details" class="shadow-sm p-2"><h3 class="text-white">News Details</h3></label>
            <textarea name="details" id="details" class="form-control mb-3" placeholder="Enter news details" required></textarea>
             </div>

             <div class="bg-secondary p-4 mb-5">

            <label for="Thumbnail" class="shadow-sm p-2"><h3 class="text-white">Thumbnail Image</h3></label><br>
            <input type="file" name="Thumbnail" id="Thumbnail" class="form-control mb-3 shadow-sm">
                </div>


             <div class="bg-secondary p-4 mb-5">

            <label for="images" class="shadow-sm p-2"><h3 class="text-white">Other Image</h3></label><br>
            <input type="file" name="images" id="images" class="form-control mb-3 shadow-sm">
            </div>


            <div class="bg-secondary p-4 mb-5">
            <label for="link" class="shadow-sm p-2"><h3 class="text-white">YouTube Link</h3></label><br>
            <input type="url" name="link" id="link" class="form-control mb-3 shadow-sm">
            </div>

            <button type="submit" name="b1" class="btn btn-primary btn-block my-3 text-center mx-auto">Post</button>
        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>




