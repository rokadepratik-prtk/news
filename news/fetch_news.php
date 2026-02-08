<?php
include "db_connect.php";

if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    // Check for valid numeric ID
    if (!is_numeric($news_id)) {
        echo "Invalid news ID.";
        exit();
    }

    $query = "SELECT * FROM news WHERE id = ?";
    $stmt = $cn->prepare($query);
    if ($stmt === false) {
        echo "Failed to prepare statement.";
        exit();
    }

    $stmt->bind_param("i", $news_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $news_item = $result->fetch_assoc();
        $video_id = extractYoutubeId($news_item['link']);
        ?>

        <div class="text-center">
            <h3><?php echo htmlspecialchars($news_item['title']); ?></h3>
            <?php if ($video_id): ?>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php endif; ?>
            <p><?php echo nl2br(htmlspecialchars($news_item['sub'])); ?></p>
            <img src="admin/<?php echo htmlspecialchars($news_item['image']); ?>" alt="News Image" class="img-fluid custom-img img-thumbnail my-3">
            <p><?php echo nl2br(htmlspecialchars($news_item['details'])); ?></p>
        </div>

        <?php
    } else {
        echo "News item not found.";
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}

// Function to extract YouTube video ID from the URL
function extractYoutubeId($url) {
    $parsedUrl = parse_url($url);
    if (strpos($parsedUrl['host'], 'youtube.com') !== false) {
        parse_str($parsedUrl['query'], $queryParams);
        return $queryParams['v'] ?? '';
    }
    if (strpos($parsedUrl['host'], 'youtu.be') !== false) {
        return ltrim($parsedUrl['path'], '/');
    }
    return '';
}
?>
