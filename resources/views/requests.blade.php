<x-layout>
    <header class="header1">
        <h2>Requests</h2>
            {{-- <div class="date-wrapper">
                <button class="prev">

                    <img src="icons/caret-left.svg" alt="caret-left">
                </button>
                <div class="date">
                    <p class="month"></p><p class="day"></p>
                </div>
                <button class="next">

                    <img src="icons/caret-right.svg" alt="caret-right">
                </button>
            </div> --}}
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
            <img style="width:50px;margin:auto;" src="{{asset('img/avatar.png')}}" alt="avatar"><br>
            <h4>{{auth()->user()->fname}} {{auth()->user()->lname}}</h4>
            <h5 style="font-weight: 400;">{{auth()->user()->email}}</h5><br>
            <a href="/settings" style="font-weight: 400; font-size:12px; color:blue;">Update your info</a>
        </div>
    </header>
    

<div class="tables">
    <div class="horizontal-tabs">
        <div class="tab all requests active"><h4>All Requests</h4></div>
        <div class="tab second requests"><h4>Ongoing
        </h4></div>
        <div class="tab third requests"><h4>Completed</h4></div>
        <div class="tab fourth requests"><h4>Cancelled</h4></div>

        <select name="type" id="type">
            <option value="">Select type</option>
            <option value="All">All</option>
            <option value="Fire & Rescue">Fire & Rescue</option>
            <option value="Medical">Medical</option>
            <option value="Police">Police</option>
        </select>
        {{-- <form action="/users" class="search">
            <input type="text" name="search-bar" id="search-bar" placeholder="Search">
            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form> --}}

        <div class="search">
            <input type="text" name="search-location" id="search-location" placeholder="Search location" />
            <button class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>
        <table class="table show">
            <thead class="table-header" >
                <tr>
                <th class="table-col-1">ID</th>
                <th class="table-col-1">Request Type</th>
                <th class="table-col-1">Location</th>
                <th class="table-col-1">Status</th>
                <th class="table-col-1">Responder</th>
                <th class="table-col-1">Requester</th>
                <th class="table-col-1">Created At</th>
            </tr>
            </thead>
            <tbody>
            @unless(count($responses) == 0)
            @forEach($responses as $response)
                    <tr class="table-row" id="{{$response['requestID']}}">
                    <td class="table-cols" id="{{$response['requestID']}}">
                        {{$response['requestID']}}</td>
                    <td class="table-cols" id="{{$response['requestID']}}">{{$response['requestType']}}</td>
                    <td class="table-cols" id="{{$response['requestID']}}">{{$response['location']}}</td>
                    <td class="table-cols" id="{{$response['requestID']}}">{{$response['requestStatus']}}</td>
                    <td class="table-cols" id="{{$response['requestID']}}">{{$response['responderfname']}} {{$response['responderlname']}}</td>
                    <td class="table-cols" id="{{$response['requestID']}}">{{$response['requesterfname']}} {{$response['requesterlname']}}</td>
                    <td class="table-cols" id="{{$response['requestID']}}">{{$response['created_at']}}</td>
                </tr>
                
            @endforeach
        
            @else
            <tr>
                <td id="norecords">No record.</td></tr>
                @endunless
            </tbody>
        </table>
        <table class="table">
            <thead class="table-header" >
                <tr>
                <th class="table-col-1">ID</th>
                <th class="table-col-1">Request Type</div>
                <th class="table-col-1">Location</th>
                <th class="table-col-1">Status</th>
                <th class="table-col-1">Responder</div>
                <th class="table-col-1">Requester</th>
                <th class="table-col-1">Created At</th>
            </tr>
            
            </thead>
            <tbody>
            @unless(count($ongoingRequests) == 0)
            @forEach($ongoingRequests as $ongoingRequest)
                    <tr class="table-row" id="{{$ongoingRequest['requestID']}}">
                        <td class="table-cols" id="{{$ongoingRequest['requestID']}}">
                            {{$ongoingRequest['requestID']}}</td>
                        <td class="table-cols" id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['requestType']}}</td>
                        <td class="table-cols" id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['location']}}</td>
                        <td class="table-cols" id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['requestStatus']}}</td>
                        <td class="table-cols" id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['responderfname']}} {{$ongoingRequest['responderlname']}}</td>
                        <td class="table-cols" id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['requesterfname']}} {{$ongoingRequest['requesterlname']}}</td>
                        <td class="table-cols" id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['created_at']}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td id="norecords">No record.</td></tr>
                        
                        @endunless
                    </tbody>
        </table>
        <table class="table">
            <thead class="table-header" style="">
                <tr>
                    <th class="table-col-1">ID</th>
                    <th class="table-col-1">Request Type</th>
                    <th class="table-col-1">Location</th>
                    <th class="table-col-1">Status</th>
                    <th class="table-col-1">Responder</th>
                    <th class="table-col-1">Requester</th>
                    <th class="table-col-1">Created At</th>
                </tr>
            </thead>
            <tbody>
            @unless(count($completedRequests) == 0)
            @forEach($completedRequests as $completedRequest)
                    <tr class="table-row" id="{{$completedRequest['requestID']}}">
                        <td class="table-cols" style="width: 50px;" id="{{$completedRequest['requestID']}}">
                            {{$completedRequest['requestID']}}</td>
                        <td class="table-cols" style="width: 90px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['requestType']}}</td>
                        <td class="table-cols" style="width: 110px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['location']}}</td>
                        <td class="table-cols" style="width: 90px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['requestStatus']}}</td>
                        <td class="table-cols" style="width: 110px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['responderfname']}} {{$completedRequest['responderlname']}}</td>
                        <td class="table-cols" style="width: 110px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['requesterfname']}} {{$completedRequest['requesterlname']}}</td>
                        <td class="table-cols" style="width: 100px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['created_at']}}</td>
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
                <th class="table-col-1">Request Type</th>
                <th class="table-col-1">Location</th>
                <th class="table-col-1">Status</th>
                <th class="table-col-1">Responder</div>
                <th class="table-col-1">Requester</div>
                <th class="table-col-1">Created At</th>
            </tr>
            </thead>
            <tbody>
            @unless(count($cancelledRequests) == 0)
            @forEach($cancelledRequests as $cancelledRequest)
                    <tr class="table-row" id="{{$cancelledRequest['requestID']}}">
                        <td class="table-cols"id="{{$cancelledRequest['requestID']}}">
                            {{$cancelledRequest['requestID']}}</td>
                        <td class="table-cols"id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['requestType']}}</td>
                        <td class="table-cols"id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['location']}}</td>
                        <td class="table-cols"id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['requestStatus']}}</td>
                        <td class="table-cols" id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['responderfname']}} {{$cancelledRequest['responderlname']}}</td>
                        <td class="table-cols" id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['requesterfname']}} {{$cancelledRequest['requesterlname']}}</td>
                        <td class="table-cols" id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['created_at']}}</td>
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
        <h4>Select a request to see more information.</h4>
    </div>
<script>
    
    const allBtn = document.querySelector('.all');
        const secondBtn = document.querySelector('.second');
        const thirdBtn = document.querySelector('.third');
        const fourthBtn = document.querySelector('.fourth');
        const tables = document.querySelectorAll('.table');
        const rowSelect = document.querySelectorAll('.table-row');
        const rightViewer = document.querySelector('.view')
        const filterSelect = document.getElementById('type')
        const table = document.querySelector('.table.show')

        const searchLocation = document.getElementById('search-location')
        const searchBtn = document.querySelector('.btn-search')

        searchBtn.addEventListener('click', ()=>{
            console.log(searchLocation.value)
                if(searchLocation.value !='' && searchLocation.value != null){
                    const url = new URL('http://system-admin.herokuapp.com/requests');
                    url.searchParams.append('location', searchLocation.value);
                    const urlString = url.toString();
                    window.location.href = urlString;
            }
        })

        allBtn.addEventListener('click', () => {
            tables[0].classList.add('show');
            tables[1].classList.remove('show');
            tables[2].classList.remove('show');
            tables[3].classList.remove('show');
            allBtn.classList.add('active');
            secondBtn.classList.remove('active')
            thirdBtn.classList.remove('active')
            fourthBtn.classList.remove('active')
        });

        secondBtn.addEventListener('click', () => {
            tables[0].classList.remove('show');
            tables[1].classList.add('show');
            tables[2].classList.remove('show');
            tables[3].classList.remove('show');

            allBtn.classList.remove('active');
            secondBtn.classList.add('active')
            thirdBtn.classList.remove('active')
            fourthBtn.classList.remove('active')
        })

        thirdBtn.addEventListener('click', () => {
            tables[0].classList.remove('show');
            tables[1].classList.remove('show');
            tables[2].classList.add('show');
            tables[3].classList.remove('show');
            allBtn.classList.remove('active');
            secondBtn.classList.remove('active')
            thirdBtn.classList.add('active')
            fourthBtn.classList.remove('active')
        })

        fourthBtn.addEventListener('click', () => {
            tables[0].classList.remove('show');
            tables[1].classList.remove('show');
            tables[2].classList.remove('show');
            tables[3].classList.add('show');
            allBtn.classList.remove('active');
            secondBtn.classList.remove('active')
            thirdBtn.classList.remove('active')
            fourthBtn.classList.add('active')
        })

        const profileBtn = document.querySelector('.avatar');
        const profileOverView = document.querySelector('.profile-overview')

        profileBtn.addEventListener('click', () => {
            profileOverView.classList.toggle('active');
        })

        //in support of the responder type filtering 
        if(window.performance){
            console.log('this is window performance working')
        }
        if (performance.navigation.type == 1) {
                window.location.href = "http://127.0.0.1:8000/requests"
        }

        filterSelect.addEventListener('change', (e) => {
            
            console.log(e.target.value)
            const url = new URL('http://127.0.0.1:8000/requests');
            url.searchParams.append('type', e.target.value);
            const urlString = url.toString();
            window.location.href = urlString;
            
        })

        rowSelect.forEach(row => {
            row.addEventListener('click', (e) => {
                console.log(e.target.id)
                rightViewer.innerHTML = ''
                getRequestsInfos(e.target.id)
                })
            })

            function getRequestsInfos(requestId){
            axios.get('api/sysad/requests/search/'+requestId).then(res => {
                console.log(res.data);
                displaySingleRequest(res.data['request'], res.data['response'], res.data['responder'], res.data['responderUserDetails'], res.data['user'], res.data['request_created_at'], res.data['user_created_at'])

            }).catch(err => console.log(err))
        }

        function displaySingleRequest(request,response, responder,responderUserDetails, user, request_created_at, user_created_at){
            console.log(user_created_at, request_created_at)
            if(response==null){
                rightViewer.innerHTML =
                `<div class="request">
                <div class="top">
                    <h4>Request</h4>
                    <div>Request Id: <p>${request['id']}</p></div>
                    <div>Type: <p>${request['type']}</p></div>
                    <div>Status: <p>${request['status']}</p></div>
                    <div>Location: <p>${request['location']}</p></div>
                    <div>Created at: <p>${request_created_at}</p></div>
                </div>
                <div class="middle">
                    <h4>No responder assigned</h4>
                </div>
                <div class="bottom">
                    <h4>User</h4>
                    <div>User Id: <p>${user['id']}</p></div>
                    <div>Name: <p>${user['fname']} ${user['lname']}</p></div>
                    <div>Gender: <p>${user['gender']}</p></div>
                    <div>Email: <p>${user['email']}</p></div>
                    <div>Joined: <p>${user_created_at}</p></div>
                </div>
            </div>`
            }else{
            rightViewer.innerHTML =
                `<div class="request">
                <div class="top">
                    <h4>Request</h4>
                    <div>Request Id: <p>${request['id']}</p></div>
                    <div>Type: <p>${request['type']}</p></div>
                    <div>Status: <p>${request['status']}</p></div>
                    <div>Location: <p>${request['location']}</p></div>
                    <div>Created at: <p>${request_created_at}</p></div>
                </div>
                <div class="middle">
                    <h4>Responder</h4>
                    <div>Responder Id: <p>${responder['id']}</p></div>
                    <div>Name: <p>${responderUserDetails['fname']} ${responderUserDetails['lname']}</p></div>
                    <div>Type: <p>${responder['type']}</p></div>
                    <div>Status: <p>${response['status']}</p></div>
                    <div>Location: <p>${response['location']}</p></div>
                </div>
                <div class="bottom">
                    <h4>User</h4>
                    <div>User Id: <p>${user['id']}</p></div>
                    <div>Name: <p>${user['fname']} ${user['lname']}</p></div>
                    <div>Gender: <p>${user['gender']}</p></div>
                    <div>Email: <p>${user['email']}</p></div>
                    <div>Joined: <p>${user_created_at}</p></div>
                </div>
            </div>`
            }
        }
 
</script>
</x-layout>