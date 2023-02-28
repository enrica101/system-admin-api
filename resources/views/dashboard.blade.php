<x-layout>
 
    <header>
        <button class="btn btn-menu">
            <i class="fa-solid fa-bars"></i>
        </button>
        <h2>Dashboard</h2>
        <div class="right-header">
            <!--PROFILE -->
            <div class="profile">
                <div class="avatar">
                    <span>
                        <small>Hey, {{auth()->user()->fname}}</small>
                        <small>Admin</small>
                    </span>
                    <img src="img/avatar.png" alt="avatar">
                </div>
            </div>
        </div>
        {{-- PROFILE AREA --}}
        <div class="profile-overview">
            <img style="width:50px;margin:auto;" src="{{asset('img/avatar.png')}}" alt="avatar"><br>
            <h4>{{auth()->user()->fname}} {{auth()->user()->lname}}</h4>
            <h5 style="font-weight: 400;">{{auth()->user()->email}}</h5><br>
            <a href="/settings" style="font-weight: 400; font-size:12px; color:blue;">Update your info</a>
        </div>
    </header>

<div class="below-header">
    <div class="date-border-wrap">
        <button class="prev"><i class="fa-solid fa-chevron-left"></i></button>
        <div class="date">
            <p class="month"></p><p class="day"></p>
        </div>
        <button class="next"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
</div>

<div class="center">
<div class="left">
    <div class="top">
        <h3 class="title">Responders Overview</h3>
        <div class="responders-data">
            <div class="square">
                <canvas id="chart1"></canvas>
                <h3 class="chart1Tally"></h3>
            </div>

            <div class="square">
                <canvas id="chart2"></canvas>
                <h3 class="chart2Tally"></h3>
            </div>

            <div class="square">
                <canvas id="chart3"></canvas>
                <h3 class="chart3Tally"></h3>
            </div>
        </div>
    </div><br>
    <div class="bottom">
        <canvas id="barChart"></canvas>
    </div>
</div>
<div class="right">
    <h3 class="title">Requests Overview</h3>
    <div class="requests-data">
        <div class="rectangle">
            <div class="content">
                <p class="label"><i class="fa-solid fa-rectangle-list"></i> All Requests</p>
                <h3 class="request1Tally"></h3>
            </div>
            
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label"><i class="fa-solid fa-circle-exclamation"></i> Available Requests</p>
                <h3 class="request2Tally"></h3>
            </div>
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label"><i class="fa-solid fa-car-side"></i> Ongoing Requests</p>
                <h3 class="request3Tally"></h3>
            </div>
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label"><i class="fa-solid fa-circle-check"></i> Completed Requests</p>
                <h3 class="request4Tally"></h3>
            </div>
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label"><i class="fa-sharp fa-solid fa-ban"></i>Cancelled Requests</p>
                <h3 class="request5Tally"></h3>
            </div>
        </div>
    </div>
</div>
</div>

<script src="scripts/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.js"></script>

<script>
const menuBtn = document.querySelector('.btn-menu');
const nav = document.querySelector('.overlay')
const closeBtnNav = document.querySelector('.btn-close-nav')

const profileBtn = document.querySelector('.avatar');
const profileOverView = document.querySelector('.profile-overview')
// const notifBtn = document.querySelector('.icon-bell')
// const notifOverview = document.querySelector('.notif')
const chart1 = document.getElementById('chart1').getContext('2d')

const chart2 = document.getElementById('chart2').getContext('2d')
const chart3 = document.getElementById('chart3').getContext('2d')
const barChart = document.getElementById('barChart').getContext('2d')

const dateWrapper = document.querySelector('.date')
let monthHolder = document.querySelector('.month') 
let dayHolder = document.querySelector('.day') 
const prevBtn = document.querySelector('.prev')
const nextBtn = document.querySelector('.next')

let chart1Tally = document.querySelector('.chart1Tally')
let chart2Tally = document.querySelector('.chart2Tally')
let chart3Tally = document.querySelector('.chart3Tally')

let request1Tally = document.querySelector('.request1Tally')
let request2Tally = document.querySelector('.request2Tally')
let request3Tally = document.querySelector('.request3Tally')
let request4Tally = document.querySelector('.request4Tally')
let request5Tally = document.querySelector('.request5Tally')

menuBtn.addEventListener('click', () => {
    nav.classList.add('active')
})

closeBtnNav.addEventListener('click', () => {
    nav.classList.remove('active')
})

profileBtn.addEventListener('click', () => {
    profileOverView.classList.toggle('active');
})


//---------------CHART 1------------------
const data ={
    labels:['All'],
    datasets:[{
        // label: 'Responders',
        data: [],
        backgroundColor: [
            '#FB993570',
            // 'rgb(245, 245, 245)',
            // 'rgb(245, 245, 245)'
        ],
        hoverOffset: 4,
    }],
}

const config = {
type: 'doughnut', 
data,
options: {
    responsive: true,
    plugins: {
        title:{
            display: true,
            text: 'All Responders'
        },
        legend: false,
        // tooltip:{
        //     enabled: false
        // },
    },
    }
}

const doughnutChart1 = new Chart(chart1, config)
let doughnutChart2 = new Chart(chart2,{
    type: 'doughnut', 
    data: {
        labels:['Idle', 'Handling'],
        datasets:[{
            // label: 'Responders',
            data: [],
            backgroundColor: [
                // 'rgb(245, 245, 245)',
                '#3ABA5E70',
                'rgba(245, 245, 245, 0.7)'
            ],
            hoverOffset: 4,
        }],
    },
    options: {
        responsive: true,
        plugins: {
            title:{
                display: true,
                text: 'Idle Responders'
            },
            legend: false,
            // tooltip:{
            //     enabled: false
            // }
        },
  },
})

let doughnutChart3 = new Chart(chart3,{
    type: 'doughnut', 
    data: {
        labels:['Idle', 'Handling'],
        datasets:[{
            // label: 'Responders',
            data: [],
            backgroundColor: [
                // 'rgb(245, 245, 245)',
                'rgba(245, 245, 245, 0.7)',
                '#4384CF70',
            ],
            hoverOffset: 4,
        }],
    },
    options: {
        responsive: true,
        plugins: {
            title:{
                display: true,
                text: 'Handling Responders'
            },
            legend: false,
            // tooltip:{
            //     enabled: false
            // }
        },
  },
})

const barChart1 = new Chart(barChart,{
    type: 'bar',
    data:{
        labels: ['All', 'Users', 'Responders', 'Admins'],
        datasets: [{
            axis: 'y',
            // label: 'My First Dataset',
            data: [],
            fill: false,
            backgroundColor: [
            'rgba(255, 99, 132, 0.5)',
            'rgba(255, 159, 64, 0.5)',
            'rgba(255, 205, 86, 0.5)',
            'rgba(75, 192, 192, 0.5)',
            ],
            borderColor: [
            'rgba(255, 99, 132, 0.5)',
            'rgba(255, 159, 64, 0.5)',
            'rgba(255, 205, 86, 0.5)',
            'rgba(75, 192, 192, 0.5)',
            ],
            borderWidth: 1
        }]
        },
        options: {
        responsive: true,
        plugins: {
            title:{
                display: true,
                text: 'Accounts'
            },
            legend: false,
            // tooltip:{
            //     enabled: false
            // }
        },
        indexAxis: 'y',
        maintainAspectRatio: false
  },
});

month = [
    // '',
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
]
lastDayofMonth = [
    // '',
    31,
    28,
    31,
    30,
    31,
    30,
    31,
    31,
    30,
    31,
    30,
    31,
]
date = new Date()
monthToday = date.getMonth() 
dateToday = date.getDate() 
yearToday = date.getFullYear()
monthHolder.innerHTML = month[monthToday]
dayHolder.innerHTML = dateToday

const yesterday =1;
prevBtn.addEventListener('click', () => {
    dateToday=dateToday-yesterday
    dayHolder.innerHTML = ''
    dayHolder.innerHTML = dateToday

    if(dateToday==0){
        if(monthToday==0){
            monthToday=12
        }
        monthToday = monthToday-1
        dateToday = lastDayofMonth[monthToday]
        dayHolder.innerHTML = ''
        monthHolder.innerHTML = ''
        dayHolder.innerHTML = dateToday 
        monthHolder.innerHTML = month[monthToday]
        getDataFromDate(yearToday+'-'+(monthToday+1)+'-'+addLeadingZero(dateToday))
    }
    getDataFromDate(yearToday+'-'+(monthToday+1)+'-'+addLeadingZero(dateToday))
})

const tomorrow =1;
nextBtn.addEventListener('click', () => {
    dateToday =dateToday+tomorrow
    dayHolder.innerHTML = ''
    dayHolder.innerHTML = dateToday

    if(dateToday==lastDayofMonth[monthToday]+1){
        if(monthToday == 11){
            monthToday = 0
            dateToday = 1

            dayHolder.innerHTML = ''
            monthHolder.innerHTML = ''
            dayHolder.innerHTML = dateToday 
            monthHolder.innerHTML = month[monthToday]
            getDataFromDate(yearToday+'-'+(monthToday+1)+'-'+addLeadingZero(dateToday))
            
        }else{
            monthToday = monthToday+1
            dateToday = 1
            dayHolder.innerHTML = ''
            monthHolder.innerHTML = ''
            dayHolder.innerHTML = dateToday 
            monthHolder.innerHTML = month[monthToday]
            getDataFromDate(yearToday+'-'+(monthToday+1)+'-'+addLeadingZero(dateToday))
        }
    }

    getDataFromDate(yearToday+'-'+(monthToday+1)+'-'+addLeadingZero(dateToday))
})

getDataFromDate(yearToday+'-'+(monthToday+1)+'-'+addLeadingZero(dateToday))


async function getDataFromDate(selectedDate){

    axios.get('api/sysad/graphData/byDate/'+selectedDate)
    .then(res => {
        let data1 = res.data['data']['allResponders']
        let data2 = res.data['data']['allIdleRequests']
        let data3 = res.data['data']['allHandlingResponders']
        let barData1 = res.data['data']['allAccounts']
        let barData2 = res.data['data']['allRoleUsers']
        let barData3 = res.data['data']['allRoleResponders']
        let barData4 = res.data['data']['allRoleAdmin']
        let allRequestTally = res.data['data']['allRequests']
        let availableRequestTally = res.data['data']['allAvailableRequests']
        let ongoingRequestTally = res.data['data']['allOngoingRequests']
        let completedRequestTally = res.data['data']['allCompletedRequests']
        let cancelledRequestTally = res.data['data']['allCancelledRequests']
        chart1Tally.innerHTML = data1
        chart2Tally.innerHTML = data2
        chart3Tally.innerHTML = data3

        request1Tally.innerHTML = allRequestTally
        request2Tally.innerHTML = availableRequestTally
        request3Tally.innerHTML = ongoingRequestTally
        request4Tally.innerHTML = completedRequestTally
        request5Tally.innerHTML = cancelledRequestTally
        doughnutChart1.config.data.datasets.forEach(dataset => {dataset.data = [data1]})
        doughnutChart1.update();

        doughnutChart2.config.data.datasets.forEach(dataset => {dataset.data = [data2,data3]})
        doughnutChart2.update();

        doughnutChart3.config.data.datasets.forEach(dataset => {dataset.data = [data2,data3]})
        doughnutChart3.update();

        barChart1.config.data.datasets.forEach(dataset => {dataset.data = [barData1, barData2, barData3, barData4]})
        barChart1.update();
   
    }).catch(err => console.log(err))
}

// console.log(addLeadingZero(2))
function addLeadingZero(num){
    if(num<10){
        return String(num).padStart(2, '0')
    }else{
        return num
    }
}

</script>
</x-layout>
