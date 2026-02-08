<?php
include "db_connect.php"; // brings in $cn

$query = "SELECT * FROM news ORDER BY created_at DESC";
$result = $cn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo $row['title'] . " - " . $row['created_at'] . "<br>";
    }
} else {
    echo "Query failed: " . $cn->error;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>9TV SATARA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

    
</head>
<body>
    <!-- Header Section -->
    <a  href="index.php">
    <div class="header-title" id="header">
        <h1 class="animated-title">9TV MAHARASHTRA NEWS</h1>
    </div>
    </a>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon navfix"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php"><h6>Home</h6></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><h6>Satara</h6></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="maharashtra.html"><h6>Maharashtra</h6></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sports.html"><h6>Sport</h6></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="entertainment.html"><h6>Entertainment</h6></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><h6>Agriculture</h6></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        More
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">About</a>
                        <a class="dropdown-item" href="#">Contact</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="container">
        <div class="row content-section">
            <!-- Advertisement Section -->
            <div class="col-md-2  p-2 mb-4">
                <div class="advertisement-section">
                    <div class="ad-container">
                        <h2 class="ad-title">Sponsored Ad</h2>
                        <div class="ad-content">
                            <img src="images/hotel2.jpg" alt="Ad Image" class="img-fluid mb-3">
                            <p>Your ad content goes here. Promote your brand or product with eye-catching visuals and engaging text!</p>
                            <a href="#" class="ad-btn">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News Items Section -->
<div class="col-md-8 my-4  ">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
<div class="col-md-12 news-item-wrapper   p-3 mb-4">
       
        
     <div class="row border border-secondary rounded p-2">
                <div class="col-md-4 p-2  text-center  ">
                        <img src="admin/<?php echo $row['image']; ?>" alt="News Image" class="img-fluid custom-img  img-thumbnail">
                 </div>
                <div class="news-title text-center col-md-8 p-2 ">
            <h5><b><?php echo $row['title']; ?></b></h5>

            
       
                <!-- Displaying only the first 3 lines of the news details -->
            <div class="letters">
            <p class="  sub ">
                    <?php
                        $newsDetails = $row['sub'];
                        // Limiting the details to a certain number of characters
                        echo substr($newsDetails, 0, 1000) . '...';
                    ?></p>
            </div>
                    
                    
                   
        </div>



        <a href="news.php?id=<?php echo $row['id']; ?>" class="ad-btn text-center"> <h6>Read More </h6></a>
            
               

               
            </div>
       
    </div>
    
    <?php
        }
    }
    ?>
    
</div>

            <!-- Advertisement Section at End -->
            <div class="col-md-2  p-2 mb-4">
                <div class="advertisement-section">
                    <div class="ad-container">
                        <h2 class="ad-title">Sponsored Ad</h2>
                        <div class="ad-content">
                            <img src="images/hotel2.jpg" alt="Ad Image" class="img-fluid mb-3">
                            <p>Your ad content goes here. Promote your brand or product with eye-catching visuals and engaging text!</p>
                            <a href="#" class="ad-btn">Learn More</a>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 9TV SATARA. All Rights Reserved.</p>
    </div>

    <script>
        window.onscroll = function() {
            var header = document.getElementById('header');
            if (window.pageYOffset > 100) { // When you scroll 100px
                header.classList.add('shrink');
            } else {
                header.classList.remove('shrink');
            }
        };
    </script>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
