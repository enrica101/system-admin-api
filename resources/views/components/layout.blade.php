<!DOCTYPE html>

<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js" integrity="sha512-LUKzDoJKOLqnxGWWIBM4lzRBlxcva2ZTztO8bTcWPmDSpkErWx0bSP4pdsjNH8kiHAUPaT06UXcb+vOEZH+HpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="css/grid.css">
    <title>System Dashboard</title>
</head>
<body>
    <main class="container">
    <nav class="sidenav">
        <div class="logo">
            <img src="img/default-img-dark.png" alt="">
        </div>
            <ul class='lists'>
                <a href="/dashboard">
                    <li><img 
                        src="icons/dashboard.svg" 
                        alt="Dashboard">
                        Dashboard</li></a>
                <a href="/map">
                    <li><img 
                        src="icons/map.svg" 
                        alt="Map"> 
                        Map</li></a>
                <a href="/accounts">
                    <li><img 
                        src="icons/users.svg" 
                        alt="Users">
                        Users</li></a>
                        <a href="/user-entry">
                    <li><img 
                        src="icons/users.svg" 
                        alt="User Entry">
                        User Entry</li></a>
                <a href="/responders">
                    <li><img 
                        src="icons/speakerphone.svg" 
                        alt="Speakerphone"> 
                        Responders</li></a>
                <a href="/requests">
                    <li><img 
                        src="icons/ambulance.svg" 
                        alt="Ambulance"> 
                        Requests</li></a>
                <a href="/settings">
                    <li><img 
                        src="icons/settings.svg" 
                        alt="Settings"> 
                        Settings</li></a>
                {{-- <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="btn" type="submit">
                            <img src="icons/logout.svg" alt="Logout"> 
                            Logout
                        </button>
                    </form>
                </li> --}}
            </ul>
        <button class="btn btn-pdf">
            <i style="margin-right: 10px" class="fa-regular fa-paper-plane"></i>
            Send PDF via Email</button>

        
    </nav>
    <div class="overlay">
        <form method="POST" action="/send-email" class="modal pdf-modal">
            @csrf
            <span class="btn-close-modal">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <h4 style="color:#323232; margin-bottom:25px">
                Send 91Watch Request Reports via Email
            </h4>
            <label>Email Address:</label>
            <input type="email" name="email" id="email" placeholder="test@example.com" value={{auth()->user()->email}} />
            <label style="display: flex; flex-direction:row; align-items:center; margin-top:10px;">Filename: 
                <a href="/export"  style="display: flex; align-items:center; margin-left:10px;">
                    <img 
                    src="icons/download-pdf.svg" 
                    alt="Download-PDF" style="height:15px"> 
                    91Watch-data.pdf
                </a>
            </label>
            <small>
                Or click on the file attachment above to download
            </small>
            <input type="submit" value='Send file' class="btn btn-send">
        </form>
    </div>

    <section class="wrapper">
        {{$slot}}
    </section>
    </main> 
    <!-- Container div closing tag -->
    {{-- <footer class="footer">
        <small>Developed by Sugod</small>
    </footer> --}}

    <script>
        const closeBtn = document.querySelector('.btn-close-modal')
        const pdfModal = document.querySelector('.overlay')
        const openBtn = document.querySelector('.btn-pdf')

        console.log(closeBtn)
        closeBtn.addEventListener('click', ()=>{
            pdfModal.classList.remove('show')
        })

        openBtn.addEventListener('click', ()=>{
            pdfModal.classList.add('show')
        })
    </script>
</body>
</html>