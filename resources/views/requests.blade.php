<x-layout>

    <header>
        <h2>Requests</h2>
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
        <select name="type" id="type">
            <option value="All">All</option>
            <option value="Fire & Rescue">Fire & Rescue</option>
            <option value="Medical">Medical</option>
            <option value="Police">Police</option>
        </select>
        <div class="all requests active"><h4>All Requests</h4></div>
        <div class="second requests"><h4>Ongoing
        </h4></div>
        <div class="third requests"><h4>Completed</h4></div>
        <div class="fourth requests"><h4>Cancelled</h4></div>
        <div class="search">
        <input type="text" name="search-bar" id="search-bar" placeholder="Search"><i class="fa-solid fa-magnifying-glass"></i></div>
    </div>

<div class="responder center">
    <div class="left">
        <div class="table show">
            <div class="table-header" style="">
                <div class="table-col-1">ID</div>
                <div class="table-col-1">Request Type</div>
                <div class="table-col-1">Location</div>
                <div class="table-col-1">Status</div>
                <div class="table-col-1">Responder</div>
                <div class="table-col-1">Requester</div>
                <div class="table-col-1">Created At</div>
            </div>
            @unless(count($responses) == 0)
            @forEach($responses as $response)
                <div class="table-row" id="{{$response['requestID']}}">
                    <div class="table-cols" style="width: 50px;" id="{{$response['requestID']}}">
                        {{$response['requestID']}}</div>
                    <div class="table-cols" style="width: 90px;" id="{{$response['requestID']}}">{{$response['requestType']}}</div>
                    <div class="table-cols" style="width: 110px;" id="{{$response['requestID']}}">{{$response['location']}}</div>
                    <div class="table-cols" style="width: 90px;" id="{{$response['requestID']}}">{{$response['requestStatus']}}</div>
                    <div class="table-cols" style="width: 110px;" id="{{$response['requestID']}}">{{$response['responderfname']}} {{$response['responderlname']}}</div>
                    <div class="table-cols" style="width: 110px;" id="{{$response['requestID']}}">{{$response['requesterfname']}} {{$response['requesterlname']}}</div>
                    <div class="table-cols" style="width: 100px;" id="{{$response['requestID']}}">{{$response['created_at']}}</div>
                </div>
            @endforeach
            @else
            <p>No records.</p>
    
            @endunless
        </div>
        <div class="table">
            <div class="table-header" style="">
                <div class="table-col-1">ID</div>
                <div class="table-col-1">Request Type</div>
                <div class="table-col-1">Location</div>
                <div class="table-col-1">Status</div>
                <div class="table-col-1">Responder</div>
                <div class="table-col-1">Requester</div>
                <div class="table-col-1">Created At</div>
            </div>
            @unless(count($responses) == 0)
            @forEach($ongoingRequests as $ongoingRequest)
                <div class="table-row" id="{{$ongoingRequest['requestID']}}">
                    <div class="table-cols" style="width: 50px;"  id="{{$ongoingRequest['requestID']}}">
                        {{$ongoingRequest['requestID']}}</div>
                    <div class="table-cols" style="width: 90px;"  id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['requestType']}}</div>
                    <div class="table-cols" style="width: 110px;"  id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['location']}}</div>
                    <div class="table-cols" style="width: 90px;"  id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['requestStatus']}}</div>
                    <div class="table-cols" style="width: 110px;"  id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['responderfname']}} {{$ongoingRequest['responderlname']}}</div>
                    <div class="table-cols" style="width: 110px;"  id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['requesterfname']}} {{$ongoingRequest['requesterlname']}}</div>
                    <div class="table-cols" style="width: 100px;"  id="{{$ongoingRequest['requestID']}}">{{$ongoingRequest['created_at']}}</div>
                </div>
            @endforeach
            @else
            <p>No records.</p>
    
            @endunless
        </div>
        <div class="table">
            <div class="table-header" style="">
                <div class="table-col-1">ID</div>
                <div class="table-col-1">Request Type</div>
                <div class="table-col-1">Location</div>
                <div class="table-col-1">Status</div>
                <div class="table-col-1">Responder</div>
                <div class="table-col-1">Requester</div>
                <div class="table-col-1">Created At</div>
            </div>
            @unless(count($responses) == 0)
            @forEach($completedRequests as $completedRequest)
                <div class="table-row" id="{{$completedRequest['requestID']}}">
                    <div class="table-cols" style="width: 50px;" id="{{$completedRequest['requestID']}}">
                        {{$completedRequest['requestID']}}</div>
                    <div class="table-cols" style="width: 90px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['requestType']}}</div>
                    <div class="table-cols" style="width: 110px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['location']}}</div>
                    <div class="table-cols" style="width: 90px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['requestStatus']}}</div>
                    <div class="table-cols" style="width: 110px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['responderfname']}} {{$completedRequest['responderlname']}}</div>
                    <div class="table-cols" style="width: 110px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['requesterfname']}} {{$completedRequest['requesterlname']}}</div>
                    <div class="table-cols" style="width: 100px;" id="{{$completedRequest['requestID']}}">{{$completedRequest['created_at']}}</div>
                </div>
            @endforeach
            @else
            <p>No records.</p>
    
            @endunless
        </div>
        <div class="table">
            <div class="table-header" style="">
                <div class="table-col-1">ID</div>
                <div class="table-col-1">Request Type</div>
                <div class="table-col-1">Location</div>
                <div class="table-col-1">Status</div>
                <div class="table-col-1">Responder</div>
                <div class="table-col-1">Requester</div>
                <div class="table-col-1">Created At</div>
            </div>
            @unless(count($responses) == 0)
            @forEach($cancelledRequests as $cancelledRequest)
                <div class="table-row" id="{{$cancelledRequest['requestID']}}">
                    <div class="table-cols" style="width: 50px;" id="{{$cancelledRequest['requestID']}}">
                        {{$cancelledRequest['requestID']}}</div>
                    <div class="table-cols" style="width: 90px;" id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['requestType']}}</div>
                    <div class="table-cols" style="width: 110px;" id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['location']}}</div>
                    <div class="table-cols" style="width: 90px;" id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['requestStatus']}}</div>
                    <div class="table-cols" style="width: 110px;" id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['responderfname']}} {{$cancelledRequest['responderlname']}}</div>
                    <div class="table-cols" style="width: 110px;" id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['requesterfname']}} {{$cancelledRequest['requesterlname']}}</div>
                    <div class="table-cols" style="width: 100px;" id="{{$cancelledRequest['requestID']}}">{{$cancelledRequest['created_at']}}</div>
                </div>
            @endforeach
            @else
            <p>No records.</p>
    
            @endunless
        </div>
        
    </div>
    <div class="right">
        <h4>Select a request to see more information.</h4>
        
    </div>
</div>
<script src="scripts/main.js"></script>
<script>

    
    const allBtn = document.querySelector('.all');
        const secondBtn = document.querySelector('.second');
        const thirdBtn = document.querySelector('.third');
        const fourthBtn = document.querySelector('.fourth');
        const tables = document.querySelectorAll('.table');
        const rowSelect = document.querySelectorAll('.table-row');
        const rightViewer = document.querySelector('.right')

        console.log(tables)
        allBtn.addEventListener('click', () => {
            tables[0].classList.add('show');
            tables[1].classList.remove('show');
            tables[2].classList.remove('show');
            tables[3].classList.remove('show');
            allBtn.classList.add('active');
            secondBtn.classList.remove('active')
            thirdBtn.classList.remove('active')
            fourthBtn.classList.remove('active')
            console.log('all button is clicked')
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
            console.log('second button is clicked')
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
            console.log('third button is clicked')
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
            console.log('third button is clicked')
        })

        const profileBtn = document.querySelector('.avatar');
        const profileOverView = document.querySelector('.profile-overview')

        profileBtn.addEventListener('click', () => {
            profileOverView.classList.toggle('active');
        })

        rowSelect.forEach(row => {
            row.addEventListener('click', (e) => {
                console.log(e.target.id)
                // row.classList.add('active')
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
            // console.log(response)
            if(response==null){
                rightViewer.innerHTML =
                `<div class="requests-row-view">
                <div class="top">
                    <h4>Request</h4>
                    <div>Request Id: <p>${request['id']}</p></div>
                    <div>Type: <p>${request['type']}</p></div>
                    <div>Status: <p>${request['status']}</p></div>
                    <div>Location: <p>${request['location']}</p></div>
                    <div>Created at: <p>${request_created_at}</p></div>
                </div>
                <hr style="width: 70%; border:solid 0.2px #eee;">
                <div class="middle">
                    <h4>No responder assigned</h4>
                </div>
                <hr style="width: 70%; border:solid 0.2px #eee;">
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
                `<div class="requests-row-view">
                <div class="top">
                    <h4>Request</h4>
                    <div>Request Id: <p>${request['id']}</p></div>
                    <div>Type: <p>${request['type']}</p></div>
                    <div>Status: <p>${request['status']}</p></div>
                    <div>Location: <p>${request['location']}</p></div>
                    <div>Created at: <p>${request_created_at}</p></div>
                </div>
                <hr style="width: 70%; border:solid 0.2px #eee;">
                <div class="middle">
                    <h4>Responder</h4>
                    <div>Responder Id: <p>${responder['id']}</p></div>
                    <div>Name: <p>${responderUserDetails['fname']} ${responderUserDetails['lname']}</p></div>
                    <div>Type: <p>${responder['type']}</p></div>
                    <div>Status: <p>${response['status']}</p></div>
                    <div>Location: <p>${response['location']}</p></div>
                </div>
                <hr style="width: 70%; border:solid 0.2px #eee;">
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