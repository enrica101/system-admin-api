<x-layout>
 
    <header>
        <h2>Dashboard</h2>
        <div class="right-header">
            <!--PROFILE -->
            <div class="profile">
                <div class="avatar">
                    <span>
                        <small>Hey, John</small>
                        <small>Admin</small>
                    </span>
                    <img src="img/avatar.png" alt="avatar">
                </div>
                <span class="icon icon-bell"><i class="fa-solid fa-bell"></i><span class="dot dot-notif"></span></span>
            </div>
        </div>
        {{-- PROFILE AREA --}}
        <div class="profile-overview">
            <img style="width:50px;margin:auto;" src="{{auth()->user()->avatar ? asset('storage/'. auth()->user()->avatar) : asset('img/avatar.png')}}" alt="avatar"><br>
            <h4>{{auth()->user()->fname}} {{auth()->user()->lname}}</h4>
            <h5 style="font-weight: 400;">{{auth()->user()->email}}</h5><br>
            <a href="user/{{auth()->user()->id}}/settings" style="font-weight: 400; font-size:12px; color:blue;">Update your info</a>
        </div>
    </header>

<!-- Notifications -->
<div class="notif">
    <div class="recent-activity">
        <div class="item-activity">
            <img src="img/avatar.png" alt="">
            <span>
                <p class="message">
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco
                </p>
                <small>2 Minutes Ago</small>
            </span>
            
        </div>
        <div class="item-activity">
            <img src="img/avatar.png" alt="">
            <span>
                <p class="message">
                    Duis aute irure dolor in reprehenderit in
                </p>
                <small>4 Minutes Ago</small>
            </span>
        </div>
        <div class="item-activity">
            <img src="img/avatar.png" alt="">
            <span>
                <p class="message">
                    Excepteur sint occaecat cupidatat non proident
                </p>
                <small>5 Minutes Ago</small>
            </span>
        </div>
        <div class="item-activity">
            <img src="img/avatar.png" alt="">
            <span>
                <p class="message">
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco
                </p>
                <small>2 Minutes Ago</small>
            </span>
            
        </div>
        <div class="item-activity">
            <img src="img/avatar.png" alt="">
            <span>
                <p class="message">
                    Duis aute irure dolor in reprehenderit in
                </p>
                <small>4 Minutes Ago</small>
            </span>
        </div>
        <div class="item-activity">
            <img src="img/avatar.png" alt="">
            <span>
                <p class="message">
                    Excepteur sint occaecat cupidatat non proident
                </p>
                <small>5 Minutes Ago</small>
            </span>
        </div><div class="item-activity">
            <img src="img/avatar.png" alt="">
            <span>
                <p class="message">
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco
                </p>
                <small>2 Minutes Ago</small>
            </span>
            
        </div>
        <div class="item-activity">
            <img src="img/avatar.png" alt="">
            <span>
                <p class="message">
                    Duis aute irure dolor in reprehenderit in
                </p>
                <small>4 Minutes Ago</small>
            </span>
        </div>
        <div class="item-activity">
            <img src="img/avatar.png" alt="">
            <span>
                <p class="message">
                    Excepteur sint occaecat cupidatat non proident
                </p>
                <small>5 Minutes Ago</small>
            </span>
        </div>
    </div>
    <small class="see-more">See All</small>
</div>
<div class="below-header">
    <div class="date-border-wrap">
        <button><i class="fa-solid fa-chevron-left"></i></button>
        <div class="date">
            <p class="month">November</p><p class="day">8</p>
        </div>
        <button><i class="fa-solid fa-chevron-right"></i></button>
    </div>
</div>

<div class="center">
<div class="left">
    <div class="top">
        <h3>Responders Overview</h3>
        <div class="responders-data">
            <a href="/responders" class="square" id="responderAllChart">
                <div class="circle all"><h3>35</h3></div>
                <h5>All Responders</h5>
            </a>
            <a href="#" class="square" id="responderIdleChart">
                <div class="circle idle"><h3>35</h3></div>
                <h5>Idle Responders</h5>
            </a>
            <a href="#" class="square" id="responderHandlingChart">
                <div class="circle handling"><h3>35</h3></div>
                <h5>Handling Requests</h5>
            </a>
        </div>
    </div>
    <div class="bottom">
        <h3>Accounts Overview</h3>
        <div class="accounts-data">
            <div class="stack">
                <p class="label">All</p>
                <input type="range" name="line" id="line" class="line" min="0" max="100">
                <!-- <div class="line"></div> -->
            </div>
            <div class="stack">
                <p class="label">Users</p>
                <input type="range" name="line" id="line" class="line">
                <!-- <div class="line"></div> -->
            </div>
            <div class="stack">
                <p class="label">Responders</p>
                <input type="range" name="line" id="line" class="line">
                <!-- <div class="line"></div> -->
            </div>
            <div class="stack">
                <p class="label">Admins</p>
                <input type="range" name="line" id="line" class="line">
                <!-- <div class="line"></div> -->
            </div>
        </div>
    </div>
</div>
<div class="right">
    <h3>Requests Overview</h3>
    <div class="requests-data">
        <div class="rectangle">
            <div class="content">
                <p class="label"><i class="fa-solid fa-rectangle-list"></i> All Requests</p>
                <h3>34</h3>
            </div>
            
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label"><i class="fa-solid fa-circle-exclamation"></i> Available Requests</p>
                <h3>12</h3>
            </div>
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label"><i class="fa-solid fa-car-side"></i> Ongoing Requests</p>
                <h3>11</h3>
            </div>
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label"><i class="fa-solid fa-circle-check"></i> Completed Requests</p>
                <h3>5</h3>
            </div>
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label"><i class="fa-sharp fa-solid fa-ban"></i>Cancelled Requests</p>
                <h3>9</h3>
            </div>
        </div>
    </div>
</div>
</div>

</div> <!-- Container div closing tag -->
</div>
<script src="scripts/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const profileBtn = document.querySelector('.avatar');
const profileOverView = document.querySelector('.profile-overview')
const notifBtn = document.querySelector('.icon-bell')
const notifOverview = document.querySelector('.notif')
const responderAllChart = document.getElementById('responderAllChart')
const responderIdleChart = document.getElementById('responderIdleChart')
const responderHandlingChart = document.getElementById('responderHandlingChart')

profileBtn.addEventListener('click', () => {
    profileOverView.classList.toggle('active');
})

notifBtn.addEventListener('click', () => {
    notifOverview.classList.toggle('active');
})


const  data = {
    labels: [
        'Red',
        'Blue',
        'Yellow'
    ],
    datasets: [{
        label: 'My First Dataset',
        data: [300, 50, 100],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ],
        hoverOffset: 4
    }]
};
const config = {
    type: 'doughnut',
    data: data,
};

new Chart(responderAllChart, config)

</script>
</x-layout>