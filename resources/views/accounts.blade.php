<x-layout>
    <header class="header1">
        <h2>Accounts</h2>
    </header>

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
            <h4>{{auth()->user()->fname}} {{auth()->user()->lname}}</h4>
            <h5 style="font-weight: 400;">{{auth()->user()->email}}</h5><br>
            <a href="/settings" style="font-weight: 400; font-size:12px; color:blue;">Update your info</a>
            <form action="/logout" method="post">
                @csrf
                <button class="btn" type="submit">
                    <img src="icons/logout.svg" alt="Logout"> 
                    Logout
                </button>
            </form>
        </div>
    </header>
  
    <div class="tables">
        <div class="horizontal-tabs">
            <button class="reload" onclick="reload()"><i class="fa-solid fa-rotate-right"></i></button>
            <div class="tab all  active"><h4>All Users</h4></div>
            <div class="tab second"><h4>Users Requests</h4></div>

            <div class="search">
                <input type="text" name="search-user" id="search-user" placeholder="Search user" />
                <button class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
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
                    <!-- <th class="table-col-1">Manage</th> -->
                    </tr>
                </thead>
                <tbody>
                    @unless(count($users) == 0)
                    @forEach($users as $user)
                        
                        <tr class="table-row" id="{{$user['id']}}">
                            <td class="table-cols id"  id="{{$user['id']}}" >{{$user['id']}}</td>
                            <td class="table-cols name"  id="{{$user['id']}}" >{{$user['fname']}} {{$user['lname']}}</td>
                            <td class="table-cols gender"  id="{{$user['id']}}"  >{{$user['gender']}}</td>
                            <td class="table-cols age"  id="{{$user['id']}}" >{{$user['age']}}</td>
                            <td class="table-cols number"  id="{{$user['id']}}"  >{{$user['contactNumber']}}</td>
                            <td class="table-cols email"  id="{{$user['id']}}"  >{{$user['email']}}</td>
                            <td class="table-cols regdate"  id="{{$user['id']}}"  >{{$user['created_at']}}</td>
                            <!-- <td class="table-cols"  id="{{$user['id']}}" ><button onclick="window.location.href='/{{$user['id']}}'">MANAGE USER</button> -->
                        </tr>

                    @endforeach

                    @else
                    <tr>
                        <td id="norecords">No record.</td></tr>

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
                    <th class="table-col-1">Bogus</th>
                    </tr>
                </thead>
                <tbody>
                    @unless(count($users) == 0)
                    @forEach($users as $user)

                        <tr class="table-row" id="{{$user['id']}}">
                            <td class="table-cols id" id="{{$user['id']}}" >
                                {{$user['id']}}
                            </td>
                            <td class="table-cols name"  id="{{$user['id']}}" >
                                {{$user['fname']}} {{$user['lname']}}
                            </td>
                            <td class="table-cols completed" id="{{$user['id']}}">
                                {{$user['completedRequests']}}
                            </td>
                            <td class="table-cols cancelled"  id="{{$user['id']}}" >
                                {{$user['cancelledRequests']}}
                            </td>
                            <td class="table-cols bogus"  id="{{$user['id']}}" >
                                {{$user['bogusRequests']}}
                            </td>
                        </tr>

                    @endforeach

                    @else
                    <tr>
                        <td id="norecords">No record.</td></tr>

                    @endunless
                    
                </tbody>
            </table>
    </div>
    <div class="view">
        <h4>Select a user to see more information.</h4>
    </div>
    <div class="overlay-modal">
        <div class="loader">
            Reactivating Account...
            {{-- <button class="btn-close"><i class="fa-solid fa-xmark"></i></button> --}}
        </div>
    </div>
<script>
    const exitModal = document.querySelector('.btn-close')
    const overlayReactivate = document.querySelector('.overlay-modal')
    const loaderModal = document.querySelector('.loader')

        overlayReactivate.addEventListener('click', ()=>{
            overlayReactivate.classList.remove('show')
            reload()
        })

    const profileBtn = document.querySelector('.avatar');
    const profileOverView = document.querySelector('.profile-overview')

    const allBtn = document.querySelector('.all');
    const secondBtn = document.querySelector('.second');
    const tables = document.querySelectorAll('.table');
    const rowSelect = document.querySelectorAll('.table-row');
    const rightViewer = document.querySelector('.view')
    // profile toggle
    const profile = document.querySelector('.profile')
    const avatar = document.querySelector('.avatar')

    function restoreAccount(id){
        if(id){
            overlayReactivate.classList.add('show')
            setTimeout(function() {
                loaderModal.innerHTML = ''
                loaderModal.innerHTML = 'Successfully Reactivated! User has received an email regarding this change.'
            }, 1300)
            axios.get('api/users/restore/'+id).then(res =>{
                console.log(res)
            }).catch(err => console.log(err))
        }
    }

    avatar.addEventListener('click', ()=>{
        profile.classList.toggle('show')
    })

    function reload(){
        window.location.href = 'http://system-admin.herokuapp.com/accounts'
        }
    
    const searchUser = document.getElementById('search-user')
    const searchBtn = document.querySelector('.btn-search')

    searchUser.addEventListener('change', ()=>{
                if(searchUser.value !='' && searchUser.value != null){
                    const url = new URL('http://system-admin.herokuapp.com/accounts');
                    url.searchParams.append('name', searchUser.value);
                    const urlString = url.toString();
                    window.location.href = urlString;
            }
        })
    
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
            displayUserInfo(res.data['user'][0])
        }).catch(err => console.log(err))
    }

function displayUserInfo(data){
    if(data['banned']){
        rightViewer.innerHTML =
        `<div class="account">
                    <div class="top">
                        <div class='user-details'>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="#323232" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="12" r="9" />
                            <circle cx="12" cy="10" r="3" />
                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                            </svg>
                            <span>
                                <h3>${data['fname']} ${data['lname']}</h3>
                                <h4>${data['email']}</h4>
                            </span>
                        </div>
                       <span class='bannedAccount'>
                            <p>Banned Account</p>
                        <button class='restoreBtn'" onclick="restoreAccount(${data['id']})">Reactivate</button>
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
                            <span>
                                <h3>${data['bogusRequests']}</h3>
                            <h5>Bogus</h5>
                            </span>
                        </div>
                        <div class='accuracy' style="justify-self:center"><h4>Accuracy Reports: ${ (data['completedRequests']/data['all']*100).toFixed(2)}%</h4></div>
                    </div>
                </div>`
    }else{
        rightViewer.innerHTML =
        `<div class="account">
                    <div class="top">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="#323232" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="12" r="9" />
                            <circle cx="12" cy="10" r="3" />
                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                            </svg>
                            <span>
                                <h3>${data['fname']} ${data['lname']}</h3>
                                <h4>${data['email']}</h4>
                                <h3>${data['accVerified']}</h3>
                          
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
                            <span>
                                <h3>${data['bogusRequests']}</h3>
                            <h5>Bogus</h5>
                            </span>
                        </div>
                        <div class='accuracy' style="justify-self:center"><h4>Accuracy Reports: ${ (data['completedRequests']/data['all']*100).toFixed(2)}%</h4></div>
                    </div>
                </div>
                <center>

                <button class="custom-btn" onclick="manageAccount(${data['id']})">
  ${data['accVerify'] ? 'Unverify Account' : 'Verify Account'}
</button>
                </center>

<style>
.custom-btn {
  
  display: inline-block;
  border: none;
  background-color: #007bff;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  border-radius: 5px;
  cursor: pointer;
}

.custom-btn:hover {
  background-color: #0069d9;
}
</style>


                `

    }
}
function manageAccount(userId){
   //redirect to account management page
    window.location.href = '/user-update/'+userId;
}

</script>
</x-layout>