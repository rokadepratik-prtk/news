<?php 
include "db_connect.php"; // Database connection

$query = "SELECT * FROM news ORDER BY created_at DESC";
$result = $cn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>9TV SATARA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">9TV SATARA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Advertise</a></li>
                </ul>
            </div>
        </div>
    </nav>
     

    <div class="row">
        <div class="col-md-2 p-2 text-cenetr">
            <div class=" bg-primary mx-auto ">
                <div class="row">
                    <div class="bg-danger text-center">Headline</div>
                </div>
            </div>
        </div>
        <div class="col-md-8 "> 
        <!-- News Items Section -->
        <div class=" my-4  ">
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



        <button class="ad-btn text-center mt-2 view-news-btn" data-id="<?php echo $row['id']; ?>">Read More</button>
                 
               

               
            </div>
       
    </div>
    
    <?php
        }
    }
    ?>
    
</div>
       
    </div>
    <div class="col-md-2 ">2</div>
    <div class="container mt-5 pt-4">
        <!-- Header Section -->
        <div class="header-title" id="header">
            <h1 class="animated-title">9TV MAHARASHTRA NEWS</h1>
        </div>



        <!-- Advertisement Section -->
        <div class="advertisement-section my-4 p-3 text-center">
            <h4 class="ad-title">Advertise with Us</h4>
            <p>Reach out to our audience with a banner advertisement here!</p>
            <a href="#" class="ad-btn">Learn More</a>
        </div>

        <!-- Modal to Display News Details -->
        <div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newsModalLabel">News Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Content will be loaded dynamically -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>&copy; 2024 9TV SATARA. All rights reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.view-news-btn').click(function(){
                var newsId = $(this).data('id');

                // AJAX request
                $.ajax({
                    url: 'fetch_news.php',
                    type: 'GET',
                    data: { id: newsId },
                    success: function(data){
                        $('#newsModal .modal-body').html(data);
                        $('#newsModal').modal('show');
                    }
                });
            });
        });
    </script>
</body>
</html>
