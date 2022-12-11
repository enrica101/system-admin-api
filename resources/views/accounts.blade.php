<x-layout>
    <header>
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
                <span class="icon icon-bell"><i class="fa-solid fa-bell"></i><span class="dot dot-notif"></span></span>
            </div>
        </div>
        {{-- PROFILE AREA --}}
        <div class="profile-overview">
            <img style="width:50px;margin:auto;" src="{{ asset('img/avatar.png')}}" alt="avatar"><br>
            <h4>{{auth()->user()->fname}} {{auth()->user()->lname}}</h4>
            <h5 style="font-weight: 400;">{{auth()->user()->email}}</h5><br>
            <a href="/settings" style="font-weight: 400; font-size:12px; color:blue;">Update your info</a>
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

            <div class="below-header users">
                <div class="all active"><h4>All Users</h4></div>
                <div class="second"><h4>Users Requests</h4></div>

                {{-- <form action="/users" class="search">
                    <input type="text" name="search-bar" id="search-bar" placeholder="Search">
                    <button type="submit" class="btn-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form> --}}
            </div>

        <div class="responder center">
            <div class="left">
                <div class="table show">
                    <div class="table-header">
                        <div class="table-col-1">ID</div>
                        <div class="table-col-1" style="">Name</div>
                        <div class="table-col-1">Gender</div>
                        <div class="table-col-1">Age</div>
                        <div class="table-col-1">Contact Number</div>
                        <div class="table-col-1">Email Address</div>
                        <div class="table-col-1">Registered on</div>
                    </div>
                        @unless(count($users) == 0)
                        @forEach($users as $user)
                            
                            <div class="table-row" id="{{$user['id']}}">
                            <div class="table-cols"  id="{{$user['id']}}" >{{$user['id']}}</div>
                            <div class="table-cols"  id="{{$user['id']}}" >{{$user['fname']}} {{$user['lname']}}</div>
                            <div class="table-cols"  id="{{$user['id']}}"  >{{$user['gender']}}</div>
                            <div class="table-cols"  id="{{$user['id']}}" >{{$user['age']}}</div>
                            <div class="table-cols"  id="{{$user['id']}}"  >{{$user['contactNumber']}}</div>
                            <div class="table-cols"  id="{{$user['id']}}"  >{{$user['email']}}</div>
                            <div class="table-cols"  id="{{$user['id']}}"  >{{$user['created_at']}}</div>
                            </div>
    
                        @endforeach
    
                        @else
                        <p style="margin: auto; padding-top: 100px; color:#8a8a8a">No record.</p>
    
                        @endunless
                </div>
                <div class="table">
                    <div class="table-header">
                        <div class="table-col-1">ID</div>
                        <div class="table-col-1" style="">Name</div>
                        <div class="table-col-1">Completed Requests</div>
                        <div class="table-col-1">Cancelled Requests</div>
                    </div>
                        @unless(count($users) == 0)
                        @forEach($users as $user)
    
                            <div class="table-row" id="{{$user['id']}}">
                                <div class="table-cols" style="width: 60px;" id="{{$user['id']}}" >
                                    {{$user['id']}}
                                </div>
                                <div class="table-cols" style="width: 190px; text-align:center;"  id="{{$user['id']}}" >
                                    {{$user['fname']}} {{$user['lname']}}
                                </div>
                                <div class="table-cols" style="width: 190px; text-align:center;" id="{{$user['id']}}">
                                    {{$user['completedRequests']}}
                                </div>
                                <div class="table-cols" style="width: 150px; text-align:right;"  id="{{$user['id']}}" >
                                    {{$user['cancelledRequests']}}
                                </div>
                            </div>
    
                        @endforeach
    
                        @else
                        <p style="margin: auto; padding-top: 100px; color:#8a8a8a">No record.</p>
    
                        @endunless
                </div>
                
            </div>
            <div class="right">
                <h4>Select a user to see more information.</h4>
                
            </div>
        </div>
<script src="scripts/main.js"></script>
<script>
    const profileBtn = document.querySelector('.avatar');
    const profileOverView = document.querySelector('.profile-overview')
    const allBtn = document.querySelector('.all');
    const secondBtn = document.querySelector('.second');
    const tables = document.querySelectorAll('.table');
    const rowSelect = document.querySelectorAll('.table-row');
    const rightViewer = document.querySelector('.right')
    
    profileBtn.addEventListener('click', () => {
        profileOverView.classList.toggle('active');
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
                    <div class="bottom">
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
                </div>`

}

</script>
</x-layout>