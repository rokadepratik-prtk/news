<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Header Styling */
        .header-title {
            background: linear-gradient(135deg, #f66e06, #dd2476);
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            height: 100px; /* Original height */
            transition: height 0.5s ease, padding 0.5s ease; /* Smooth transition for height and padding */
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            width: 100%;
            margin-bottom: 30px; /* Space for navbar */
        }

        /* Reduced height on scroll */
        .header-title.shrink {
            height: 60px; /* 70% reduction */
            padding: 10px; /* Reduce padding to match smaller height */
            margin-bottom: 10px; /* Reduce margin bottom when shrunk */
        }
        </style>
        <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="header-title" id="header">
        <h1 class="animated-title">9TV MAHARASHTRA NEWS</h1>
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

</body>
</html>