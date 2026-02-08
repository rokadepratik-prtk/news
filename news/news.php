<?php
include "db_connect.php"; // Include database connection




// Get the news ID from the URL
if (isset($_GET['id'])) {
    $news_id = $_GET['id'];
    // Query to fetch details of the news item with the given ID
    $query = "SELECT * FROM news WHERE id = ?";
    $stmt = $cn->prepare($query);
    $stmt->bind_param("i", $news_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // If the news item exists, fetch its details
    if ($result->num_rows > 0) {
        $news_item = $result->fetch_assoc();
    } else {
        echo "News item not found.";
        exit();
    }
} else {
    echo "Invalid news ID.";
    exit();
}
// Function to extract YouTube video ID from the URL
function extractYoutubeId($url) {
    $parsedUrl = parse_url($url);

    // Handle youtube.com links
    if (strpos($parsedUrl['host'], 'youtube.com') !== false) {
        parse_str($parsedUrl['query'], $queryParams);
        return $queryParams['v'] ?? '';
    }

    // Handle youtu.be short links
    if (strpos($parsedUrl['host'], 'youtu.be') !== false) {
        return ltrim($parsedUrl['path'], '/');
    }

    return '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($news_item['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <meta property="og:title" content="<?php echo htmlspecialchars($news_item['title']); ?>">
<meta property="og:description" content="<?php echo substr(htmlspecialchars($news_item['details']), 0, 250); ?>...">
<meta property="og:image" content="https://yourwebsite.com/admin/<?php echo htmlspecialchars($news_item['image']); ?>">
<meta property="og:url" content="https://yourwebsite.com/news.php?id=<?php echo $news_item['id']; ?>">
<meta property="og:type" content="article">


<style>
 
</style>
    
</head>
<body>

<!-- Header Section (Same as Main Page) -->
<a class="nav-link" href="index.php">
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


<!-- Main Content Section for News Details -->

        <div class="col-md-8 mt-2 shadow-lg p-2">
            <div class="col-md-12 news-item-wrapper p-2 mb-4">
                
                <div class="news-item">
                    <div class="row ">
                       

                        <div class="news-title text-center p-2">
                    <h3><B><?php echo htmlspecialchars($news_item['title']); ?></B></h3>
                </div>

                    <!-- YouTube Video Embed Section -->
      <?php if (!empty($news_item['link'])): ?>
                    <div class="youtube-video">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo extractYoutubeId($news_item['link']); ?>" 
                                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen></iframe>
                    </div>
                <?php endif; ?>


                <div class="col-md-12 p-4">
                            <p><?php echo nl2br(htmlspecialchars($news_item['sub'])); ?></p>
                        </div>


                <div class="col-md-12 p-2 text-center">
                            <img src="admin/<?php echo htmlspecialchars($news_item['image']); ?>" alt="News Image" class="img-fluid custom-img img-thumbnail">
                        </div>


                        <div class="col-md-12 letters p-4">
                            <p><?php echo nl2br(htmlspecialchars($news_item['details'])); ?></p>
                        </div>



  
                       <!-- WhatsApp Share Button -->
                       
                       <div class="text-center mb-4">
    <button type="button" class="btn btn-lg btn-success">
        <a href="https://api.whatsapp.com/send?text=<?php 
            echo urlencode("Check out this news: https://yourwebsite.com/news.php?id=" . $news_item['id']); 
        ?>" 
           target="_blank" 
           class="text-white" 
           style="text-decoration: none;">
            Share on WhatsApp
        </a>
    </button>
</div>




<!-- WhatsApp Subscribe Button -->
<div class="text-center mb-4">
    <button type="button" class="btn btn-lg btn-primary">
        <a href="https://chat.whatsapp.com/yourChannelInviteLink" 
           target="_blank" 
           class="text-white" 
           style="text-decoration: none;">
            Subscribe to WhatsApp Channel
        </a>
    </button>
</div>






                        <div class=" text-center"><button type="button" class="btn btn-lg btn-danger" > 
                    <a href="index.php " class="btn btn-lg btn-danger">Home Page</a>
                </button></div>
               
                    </div>
                </div>
            </div>
         

            .
   
        </div>

        <!-- Advertisement Section -->
        <div class="col-md-2 p-2 mb-4">
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
<div class="col-8 col-md-2 mx-auto row social">
     <div class="col-3 text-center">
        <img src="images/whatsapp.png" width="90%" alt="whatsapp">
    </div>
    <div class="col-3 text-center">
        <img src="images/facebook.png" width="90%" alt="facebook">
    </div>
    <div class="col-3 text-center">
        <img src="images/instagram.png" width="90%" alt="instagram">
    </div>
    <div class="col-3 text-center">
        <img src="images/youtube.png" width="90%" alt="youtube">
    </div>
</div>


<!-- Footer (Same as Main Page) -->
<div class="footer">
    <p>&copy; 2024 9TV SATARA. All Rights Reserved.</p>
</div> <script>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
