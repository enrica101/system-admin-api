<x-layout>
    <header class="header1">
        <h2>Dashboard</h2>
        <div class="dateContainer">
            <input type='date' class="startDate" value={{date("Y-m-d H:i:s")}} placeholder="Enter Start Date"/>
            <input type='date' class="endDate" placeholder="Enter End Date"/>
            <button class="filterDate">Filter</button>
        </div>

    </header>
<div class="dashboard">
        <h3 class="title">Responders Overview 
            <i class="fa-solid fa-circle-info"></i></h3>
        <div class="doughut-graphs">
            <div class="square">
                <canvas id="chart1"></canvas>
                <h3 class="chart1Tally">0</h3>
            </div>

            <div class="square">
                <canvas id="chart2"></canvas>
                <h3 class="chart2Tally">0</h3>
            </div>

            <div class="square">
                <canvas id="chart3"></canvas>
                <h3 class="chart3Tally">0</h3>
            </div>
        </div>
    <div class="linear-graph">
        <canvas id="barChart"></canvas>
    </div>
</div>
<header class="header2">
    <div class="avatar">
        <span>
            <small>Hey, {{auth()->user()->fname}}</small>
            <br/>
            <small class="accountType">Admin</small>
        </span>
        {{-- <img src="img/avatar.png" alt="avatar"> --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="#323232" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <circle cx="12" cy="12" r="9" />
            <circle cx="12" cy="10" r="3" />
            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
            </svg>
    </div>
    
    <div class="profile">
        <img style="width:50px;margin:auto;" src="{{asset('img/avatar.png')}}" alt="avatar"><br>
        <h4>{{auth()->user()->fname}} {{auth()->user()->lname}}</h4>
        <h5 style="font-weight: 400;">{{auth()->user()->email}}</h5><br>
        <a href="/settings" style="font-weight: 400; font-size:12px; color:blue;">Update your info</a>
    </div>
</header>
<div class="right">
    <h3 class="title">Requests Overview</h3>
    <div class="statistics">
        <div class="rectangle">
            <div class="content">
                <p class="label"> All Requests</p>
                <p class="request1Tally">0</p>
            </div>
            <span class="bar">
                <span class="progress1"></span>
            </span>
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label">Available Requests</p>
                <p class="request2Tally">0</p>
            </div>
            <span class="bar">
                <span class="progress2"></span>
            </span>
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label"> Ongoing Requests</p>
                <p class="request3Tally">0</p>
            </div>
            <span class="bar">
                <span class="progress3"></span>
            </span>
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label">Completed Requests</p>
                <p class="request4Tally">0</p>
            </div>
            <span class="bar">
                <span class="progress4"></span>
            </span>
        </div>
        <div class="rectangle">
            <div class="content">
                <p class="label">Cancelled Requests</p>
                <p class="request5Tally">0</p>
            </div>
            <span class="bar">
                <span class="progress5"></span>
            </span>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
Usage
<script>

const profileBtn = document.querySelector('.avatar');
const profileOverView = document.querySelector('.profile-overview')
const chart1 = document.getElementById('chart1').getContext('2d')

const chart2 = document.getElementById('chart2').getContext('2d')
const chart3 = document.getElementById('chart3').getContext('2d')
const barChart = document.getElementById('barChart').getContext('2d')

let chart1Tally = document.querySelector('.chart1Tally')
let chart2Tally = document.querySelector('.chart2Tally')
let chart3Tally = document.querySelector('.chart3Tally')

let request1Tally = document.querySelector('.request1Tally')
let request2Tally = document.querySelector('.request2Tally')
let request3Tally = document.querySelector('.request3Tally')
let request4Tally = document.querySelector('.request4Tally')
let request5Tally = document.querySelector('.request5Tally')

let startDate = document.querySelector('.startDate')
let endDate = document.querySelector('.endDate')
let btnGet = document.querySelector('.filterDate')


let start = new Date(startDate.value)
getDataFromDate(start.getFullYear()+"-"+addLeadingZero(start.getMonth()+1)+"-"+addLeadingZero(start.getDate()), null)


btnGet.addEventListener('click', ()=>{
    let start = new Date(startDate.value)
    let end = new Date(endDate.value)
    if(end == 'Invalid Date'){
        getDataFromDate(start.getFullYear()+"-"+addLeadingZero(start.getMonth()+1)+"-"+addLeadingZero(start.getDate()), null)
    }else{
        getDataFromDate(start.getFullYear()+"-"+addLeadingZero(start.getMonth()+1)+"-"+addLeadingZero(start.getDate())+" "+start.getHours()+":"+ start.getMinutes()+":"+start.getSeconds(), end.getFullYear()+"-"+addLeadingZero(end.getMonth()+1)+"-"+addLeadingZero(end.getDate())+" "+end.getHours()+":"+ end.getMinutes()+":"+end.getSeconds())
    }
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

console.log('')

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

async function getDataFromDate(start, end){
        document.querySelector('.progress1').style.width = `0`
        document.querySelector('.progress2').style.width = `0`
        document.querySelector('.progress3').style.width = `0`
        document.querySelector('.progress4').style.width = `0`
        document.querySelector('.progress5').style.width = `0`
    axios.get(`/api/sysad/graphData/byDate?start=${start}&end=${end}`)
    .then(res => {
        console.log(res)
        // Responder Data
        let data1 = res.data['data']['allResponders']
        let data2 = res.data['data']['allIdleRequests']
        let data3 = res.data['data']['allHandlingResponders']

        // Accounts 
        let barData1 = res.data['data']['allAccounts']
        let barData2 = res.data['data']['allRoleUsers']
        let barData3 = res.data['data']['allRoleResponders']
        let barData4 = res.data['data']['allRoleAdmin']

        // Requests
        let allRequestTally = res.data['data']['allRequests']
        let availableRequestTally = res.data['data']['allAvailableRequests']
        let ongoingRequestTally = res.data['data']['allOngoingRequests']
        let completedRequestTally = res.data['data']['allCompletedRequests']
        let cancelledRequestTally = res.data['data']['allCancelledRequests']

            chart1Tally.innerHTML = data1
            chart2Tally.innerHTML = data2
            chart3Tally.innerHTML = data3

            request1Tally.innerHTML = allRequestTally
            document.querySelector('.progress1').style.width = `${allRequestTally/allRequestTally*100}%`
            request2Tally.innerHTML = availableRequestTally
            document.querySelector('.progress2').style.width = `${availableRequestTally/allRequestTally*100}%`
            request3Tally.innerHTML = ongoingRequestTally
            document.querySelector('.progress3').style.width = `${ongoingRequestTally/allRequestTally*100}%`
            request4Tally.innerHTML = completedRequestTally
            document.querySelector('.progress4').style.width = `${completedRequestTally/allRequestTally*100}%`
            request5Tally.innerHTML = cancelledRequestTally
            document.querySelector('.progress5').style.width = `${cancelledRequestTally/allRequestTally*100}%`
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

function addLeadingZero(num){
    if(num<10){
        return String(num).padStart(2, '0')
    }else{
        return num
    }
}

</script>
</x-layout>
