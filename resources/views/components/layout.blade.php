<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"
            integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="css/style.css">
    <title>System Dashboard</title>
</head>
<body>
    <div class="overlay">
    <nav class="sidenav">
        <div class="nav-wrapper">
            <span>
                <img src="img/default-img-light.png" alt="">
                <button class="btn btn-close-nav">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </span>
            <ul>
                <a href="/dashboard"><li><i class="fa-solid fa-house"></i> Dashboard</li></a>
                <a href="/map"><li><i class="fa-solid fa-map"></i> Map</li></a>
                <a href="/accounts"><li><i class="fa-solid fa-user-group"></i> Users</li></a>
                <a href="/responders"><li><i class="fa-solid fa-user-group"></i> Responders</li></a>
                <a href="/requests"><li><i class="fa-solid fa-circle-exclamation"></i> Emergencies</li></a>
                <a href="/settings"><li><i class="fa-solid fa-gear"></i> Settings</li></a>
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-right-from-bracket"></i> 
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <a href="/export" class="btn btn-pdf">Download PDF</a>
    </nav>
    </div>

    <div class="container">
    {{$slot}}
    
    </div> <!-- Container div closing tag -->
    <footer class="footer">
        <small>All Rights Reserved</small>
        <small>Copyrights by Sugod</small>
    </footer>
</body>
</html>