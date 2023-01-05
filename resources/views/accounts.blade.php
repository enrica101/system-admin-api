<x-layout>
    <header>
        <button class="btn btn-menu">
            <i class="fa-solid fa-bars"></i>
        </button>
        <h2>Users</h2>
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
  
            <div class="below-header users">
                <div class="tab all active"><h4>All Users</h4></div>
                <div class="tab second"><h4>Users Requests</h4></div>

                {{-- <form action="/users" class="search">
                    <input type="text" name="search-bar" id="search-bar" placeholder="Search">
                    <button type="submit" class="btn-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form> --}}
            </div>

        <div class="users-table">
            <div class="tables">
                <table class="table show">
                    <thead class="table-header">
                        <tr>
                        <th class="table-col-1">ID</th>
                        <th class="table-col-1">Name</th>
                        <th class="table-col-1">Gender</th>
                        <th class="table-col-1">Age</th>
                        <th class="table-col-1">Contact Number</th>
                        <th class="table-col-1">Email Address</th>
                        <th class="table-col-1">Registered on</th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless(count($users) == 0)
                        @forEach($users as $user)
                            
                            <tr class="table-row" id="{{$user['id']}}">
                                <td class="table-cols"  id="{{$user['id']}}" >{{$user['id']}}</td>
                                <td class="table-cols"  id="{{$user['id']}}" >{{$user['fname']}} {{$user['lname']}}</td>
                                <td class="table-cols"  id="{{$user['id']}}"  >{{$user['gender']}}</td>
                                <td class="table-cols"  id="{{$user['id']}}" >{{$user['age']}}</td>
                                <td class="table-cols"  id="{{$user['id']}}"  >{{$user['contactNumber']}}</td>
                                <td class="table-cols"  id="{{$user['id']}}"  >{{$user['email']}}</td>
                                <td class="table-cols"  id="{{$user['id']}}"  >{{$user['created_at']}}</td>
                            </tr>
    
                        @endforeach
    
                        @else
                        <p style="margin: auto; padding-top: 100px; color:#8a8a8a">No record.</p>
    
                        @endunless
                    </tbody>
                </table>
                <table class="table">
                    <thead class="table-header">
                        <tr>
                        <th class="table-col-1">ID</th>
                        <th class="table-col-1">Name</th>
                        <th class="table-col-1">Completed</th>
                        <th class="table-col-1">Cancelled</th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless(count($users) == 0)
                        @forEach($users as $user)
    
                            <tr class="table-row" id="{{$user['id']}}">
                                <td class="table-cols" id="{{$user['id']}}" >
                                    {{$user['id']}}
                                </td>
                                <td class="table-cols"  id="{{$user['id']}}" >
                                    {{$user['fname']}} {{$user['lname']}}
                                </td>
                                <td class="table-cols" id="{{$user['id']}}">
                                    {{$user['completedRequests']}}
                                </td>
                                <td class="table-cols"  id="{{$user['id']}}" >
                                    {{$user['cancelledRequests']}}
                                </td>
                            </tr>
    
                        @endforeach
    
                        @else
                        <p style="margin: auto; padding-top: 100px; color:#8a8a8a">No record.</p>
    
                        @endunless
                        
                        
                    </tbody>
                </table>
                
            </div>
            <div class="view">
                <h4>Select a user to see more information.</h4>
                
            </div>
        </div>

<script src="scripts/main.js"></script>
<script>
    const menuBtn = document.querySelector('.btn-menu');
    const nav = document.querySelector('.overlay')
    const closeBtnNav = document.querySelector('.btn-close-nav')

    const profileBtn = document.querySelector('.avatar');
    const profileOverView = document.querySelector('.profile-overview')

    const allBtn = document.querySelector('.all');
    const secondBtn = document.querySelector('.second');
    const tables = document.querySelectorAll('.table');
    const rowSelect = document.querySelectorAll('.table-row');
    const rightViewer = document.querySelector('.view')
    
    profileBtn.addEventListener('click', () => {
        profileOverView.classList.toggle('active');
    })

    menuBtn.addEventListener('click', () => {
    nav.classList.add('active')
    })

    closeBtnNav.addEventListener('click', () => {
        nav.classList.remove('active')
    })

    allBtn.addEventListener('click', () => {
        tables[0].classList.add('show');
        tables[1].classList.remove('show');
        allBtn.classList.add('active');
        secondBtn.classList.remove('active')
        console.log('all button is clicked')
    });

    secondBtn.addEventListener('click', () => {
        tables[0].classList.remove('show');
        tables[1].classList.add('show');
        allBtn.classList.remove('active');
        secondBtn.classList.add('active')
        console.log('second button is clicked')
    })


    rowSelect.forEach(row => {
        row.addEventListener('click', (e) => {
            console.log(e.target.id)
            rightViewer.innerHTML = ''
            getUserInformation(e.target.id)
        })
})

function getUserInformation(userId){
    axios.get('api/accounts/search/'+userId).then(res =>{
        console.log(res.data)
        displayUserInfo(res.data['user'][0])
    }).catch(err => console.log(err))
}

function displayUserInfo(data){
        // console.log(data)
        rightViewer.innerHTML =
        `<div class="accounts-row-view">
                    <div class="top">
                        <img src="img/avatar.png" alt="">
                        <span>
                            <h3>${data['fname']} ${data['lname']}</h3>
                            <h4>${data['email']}</h4>
                        </span>
                        
                    </div>
                    <div class="middle">
                        <div>
                            Contact Number: <p>${data['contactNumber']}</p>
                        </div>
                        <div>
                            Gender: <p>${data['gender']}</p>
                        </div>
                        <div>
                            Age: <p>${data['age']}</p>
                        </div>
                        <div>
                            Joined: <p>${data['joined']}</p>
                        </div>
                    </div>
                    <hr><br>
                    <div class="bottom">
                        <h4>Requests</h4>
                        <div class="statusCounts">
                            <span>
                               <h3>${data['ongoingRequest']}</h3>
                            <h5>Ongoing</h5> 
                            </span>
                            <span>
                               <h3>${parseInt(data['completedRequests'])}</h3>
                            <h5>Completed</h5> 
                            </span>
                            <span>
                                <h3>${data['cancelledRequests']}</h3>
                            <h5>Cancelled</h5>
                            </span>
                        </div>
                    </div>
                </div>`

}

</script>
</x-layout>