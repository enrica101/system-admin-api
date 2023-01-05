<x-layout>
    <header>
        <h2>Responders</h2>
        <div class="right-header">

            <!--PROFILE -->
            <div class="profile">
                <div class="avatar">
                    <span>
                        <small>Hey,  {{auth()->user()->fname}}</small>
                        <small>Admin</small>
                    </span>
                    <img src="img/avatar.png" alt="avatar">
                </div>
                    </div>
                </div>
            {{-- PROFILE AREA --}}
            <div class="profile-overview">
                <img style="width:50px;margin:auto;" src="{{auth()->user()->avatar ? asset('storage/'. auth()->user()->avatar) : asset('img/avatar.png')}}" alt="avatar"><br>
                <h4>{{auth()->user()->fname}} {{auth()->user()->lname}}</h4>
                <h5 style="font-weight: 400;">{{auth()->user()->email}}</h5><br>
                <a href="/settings" style="font-weight: 400; font-size:12px; color:blue;">Update your info</a>
            </div>
            </header>

    <div class="below-header">
        <select name="type" id="type" class="tab">
            <option value="">Select type</option>
            <option value="All">All</option>
            <option value="Fire & Rescue">Fire & Rescue</option>
            <option value="Medical">Medical</option>
            <option value="Police">Police</option>
        </select>
        <div class="tab all active"><h4>All Responders</h4></div>
        <div class="tab second"><h4>Idle Responders</h4></div>
        <div class="tab third"><h4>Handling Requests</h4></div>

        {{-- <form action="/users" class="search">
            <input type="text" name="search-bar" id="search-bar" placeholder="Search">
            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form> --}}
    </div>

<div class="responders">
    <div class="tables">
        <table class="table show">
            <thead class="table-header">
                <tr>
                <th class="table-col-1">ID</th>
                <th class="table-col-1">Name</th>
                <th class="table-col-1">Responder Type</th>
                <th class="table-col-1">Request ID</th>
                <th class="table-col-1">Status</th>
                <th class="table-col-1">Timestamp</th>
            </tr>
            </thead>
            <tbody>
            @unless(count($responses) == 0)
            @forEach($responses as $response)
            <tr class="table-row" id="{{$response['responderID']}}">
                <td class="table-cols" id="{{$response['responderID']}}">{{$response['responderID']}}</td>
                <td class="table-cols" id="{{$response['responderID']}}">{{$response['fname']}} {{$response['lname']}}</td>
                <td class="table-cols" id="{{$response['responderID']}}">{{$response['responderType']}}</td>
                <td class="table-cols" id="{{$response['responderID']}}">{{$response['requestID']}}</td>
                <td class="table-cols" id="{{$response['responderID']}}">{{$response['status']}}</td>
                <td class="table-cols" id="{{$response['responderID']}}">{{$response['created_at']}}</td>
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
                <th class="table-col-1">Responder Type</th>
                <th class="table-col-1">Request ID</th>
                <th class="table-col-1">Status</th>
                <th class="table-col-1">Timestamp</th>
            </tr>
            </thead>
            <tbody>
            @unless(count($responses) == 0)
            @forEach($idleResponders as $idleResponder)
            <tr class="table-row" id="{{$idleResponder['responderID']}}">
                <td class="table-cols" id="{{$idleResponder['responderID']}}">{{$idleResponder['responderID']}}</td>
                <td class="table-cols" id="{{$idleResponder['responderID']}}">{{$idleResponder['fname']}} {{$idleResponder['lname']}}</td>
                <td class="table-cols" id="{{$idleResponder['responderID']}}">{{$idleResponder['responderType']}}</td>
                <td class="table-cols" id="{{$idleResponder['responderID']}}">{{$idleResponder['requestID']}}</td>
                <td class="table-cols" id="{{$idleResponder['responderID']}}">{{$idleResponder['status']}}</td>
                <td class="table-cols" id="{{$idleResponder['responderID']}}">{{$idleResponder['created_at']}}</td>
            </tr>
            @endforeach
            @else
            <p style="margin: auto; padding-top: 100px; color:#8a8a8a">No records.</p>
            @endunless
        </tbody>
        </table>
        <table class="table">
            <thead class="table-header">
                <tr>
                <th class="table-col-1">ID</th>
                <th class="table-col-1">Name</th>
                <th class="table-col-1">Responder Type</th>
                <th class="table-col-1">Request ID</th>
                <th class="table-col-1">Status</th>
                <th class="table-col-1">Timestamp</th>
            </tr>
            </thead>
            <tbody>
            @unless(count($responses) == 0)
            @forEach($handlingRequests as $handlingRequest)
            <tr class="table-row" id="{{$handlingRequest['responderID']}}">
                <td class="table-cols" id="{{$handlingRequest['responderID']}}">{{$handlingRequest['responderID']}}</td>
                <td class="table-cols" id="{{$handlingRequest['responderID']}}">{{$handlingRequest['fname']}} {{$handlingRequest['lname']}}</td>
                <td class="table-cols" id="{{$handlingRequest['responderID']}}">{{$handlingRequest['responderType']}}</td>
                <td class="table-cols" id="{{$handlingRequest['responderID']}}">{{$handlingRequest['requestID']}}</td>
                <td class="table-cols" id="{{$handlingRequest['responderID']}}">{{$handlingRequest['status']}}</td>
                <td class="table-cols" id="{{$handlingRequest['responderID']}}">{{$handlingRequest['created_at']}}</td>
            </tr>
            @endforeach
            @else
            <p style="margin: auto; padding-top: 100px; color:#8a8a8a">No record.</p>
            @endunless
        </tbody>
        </table>
        
    </div>
    <div class="view">
        <h4>Select a responder to see more information.</h4>
        
    </div>
</div>
<script src="scripts/main.js"></script>
    <script>
        const allBtn = document.querySelector('.all');
        const secondBtn = document.querySelector('.second');
        const thirdBtn = document.querySelector('.third');
        const tables = document.querySelectorAll('.table');    
        const rowSelect = document.querySelectorAll('.table-row');
        const rightViewer = document.querySelector('.view')
        const imageBorder = document.querySelector('.border-line')
        const filterSelect = document.getElementById('type')
        const table = document.querySelector('.table.show')

        // console.log(tables)
        allBtn.addEventListener('click', () => {
            tables[0].classList.add('show');
            tables[1].classList.remove('show');
            tables[2].classList.remove('show');
            allBtn.classList.add('active');
            secondBtn.classList.remove('active')
            thirdBtn.classList.remove('active')
            console.log('all button is clicked')
        });

        secondBtn.addEventListener('click', () => {
            tables[0].classList.remove('show');
            tables[1].classList.add('show');
            tables[2].classList.remove('show');

            allBtn.classList.remove('active');
            secondBtn.classList.add('active')
            thirdBtn.classList.remove('active')
            console.log('second button is clicked')
        })

        thirdBtn.addEventListener('click', () => {
            tables[0].classList.remove('show');
            tables[1].classList.remove('show');
            tables[2].classList.add('show');
            allBtn.classList.remove('active');
            secondBtn.classList.remove('active')
            thirdBtn.classList.add('active')
            console.log('third button is clicked')
        })

        const profileBtn = document.querySelector('.avatar');
        const profileOverView = document.querySelector('.profile-overview')

        profileBtn.addEventListener('click', () => {
            profileOverView.classList.toggle('active');
        })

        //in support of the responder type filtering 
        // if(window.performance){
        //     console.log('this is window performance working')
        // }
        // if (performance.navigation.type == 1) {
        //         window.location.href = "http://system-admin.herokuapp.com/responders"
        // }

        filterSelect.addEventListener('change', (e) => {
            
            console.log(e.target.value)
            const url = new URL('http://127.0.0.1:8000/responders');
            url.searchParams.append('type', e.target.value);
            const urlString = url.toString();
            window.location.href = urlString;
            
        })
        
        rowSelect.forEach(row => {
        row.addEventListener('click', (e) => {
            console.log(e)
            // row.classList.add('active')
            rightViewer.innerHTML = ''
            getAccountResponder(e.target.id)
            })
        })

        function getAccountResponder(responderID){
            axios.get('api/accounts/responders/search/'+responderID).then(res => {
                console.log(res.data);
                displayAccountResponder(res.data['responder'][0], res.data['ongoing'])
            }).catch(err => console.log(err))
        }

        function displayAccountResponder(responder, ongoingRequest){
           
            console.log(ongoingRequest!=null)
            if(ongoingRequest==null){
                if(responder['type'] == 'Fire & Rescue' ||responder['type'] == 'Fire'){
                    rightViewer.innerHTML =
                        `<div class="responders-row-view">
                        <div class="top">
                            <span class="user-details">
                                <div class="border-line fire">
                                    <span class="avatar-icon">
                                        <i class="fa-solid fa-user"></i></span></div><span class="user-name">
                                    <h3>${responder['fname']} ${responder['lname']}</h3>
                                    <h4>${responder['type']}</h4>
                                </span>
                            </span>
                        </div>
                        <div class="middle">
                            <div>
                                Email: <p>${responder['email']}</p>
                            </div>
                            <div>
                                Contact Number: <p>${responder['contactNumber']}</p>
                            </div>
                            <div>
                                Gender: <p>${responder['gender']}</p>
                            </div>
                            <div>
                                Age: <p>${responder['age']}</p>
                            </div>
                            <div>
                                Joined: <p>${responder['joined']}</p>
                            </div>
                        </div>
                        <div class="bottom">
                            <h4>Request Responses</h4>
                                    <div class="statusCounts">
                                        <span>
                                        <h3>${responder['ongoingRequest']}</h3>
                                            <h5>Ongoing</h5> 
                                        </span>
                                        <span>
                                        <h3>${responder['completedRequests']}</h3>
                                            <h5>Completed</h5> 
                                        </span>
                                        <span>
                                            <h3>${responder['cancelledRequests']}</h3>
                                            <h5>Cancelled</h5>
                                        </span>
                                    </div>
                        </div>
                    </div>`
                }else if(responder['type'] == 'Medical'){
                    rightViewer.innerHTML =
                        `<div class="responders-row-view">
                        <div class="top">
                            <span class="user-details">
                                <div class="border-line medical">
                                    <span class="avatar-icon">
                                        <i class="fa-solid fa-user"></i></span></div><span class="user-name">
                                    <h3>${responder['fname']} ${responder['lname']}</h3>
                                    <h4>${responder['type']}</h4>
                                </span>
                            </span>
                            <div class="responder-responses">
                                <h4>Request Responses</h4>
                                    <div class="statusCounts">
                                        <span>
                                        <h3>${responder['ongoingRequest']}</h3>
                                            <h5>Ongoing</h5> 
                                        </span>
                                        <span>
                                        <h3>${responder['completedRequests']}</h3>
                                            <h5>Completed</h5> 
                                        </span>
                                        <span>
                                            <h3>${responder['cancelledRequests']}</h3>
                                            <h5>Cancelled</h5>
                                        </span>
                                    </div>
                            </div>
                        </div>
                        <div class="middle">
                            <div>
                                Email: <p>${responder['email']}</p>
                            </div>
                            <div>
                                Contact Number: <p>${responder['contactNumber']}</p>
                            </div>
                            <div>
                                Gender: <p>${responder['gender']}</p>
                            </div>
                            <div>
                                Age: <p>${responder['age']}</p>
                            </div>
                            <div>
                                Joined: <p>${responder['joined']}</p>
                            </div>
                        </div>
                        <div class="bottom">
                            
                        </div>
                    </div>`
                }else{
                    rightViewer.innerHTML =
                        `<div class="responders-row-view">
                        <div class="top">
                            <span class="user-details">
                                <div class="border-line police">
                                    <span class="avatar-icon">
                                        <i class="fa-solid fa-user"></i></span></div><span class="user-name">
                                    <h3>${responder['fname']} ${responder['lname']}</h3>
                                    <h4>${responder['type']}</h4>
                                </span>
                            </span>
                            <div class="responder-responses">
                                <h4>Request Responses</h4>
                                    <div class="statusCounts">
                                        <span>
                                        <h3>${responder['ongoingRequest']}</h3>
                                            <h5>Ongoing</h5> 
                                        </span>
                                        <span>
                                        <h3>${responder['completedRequests']}</h3>
                                            <h5>Completed</h5> 
                                        </span>
                                        <span>
                                            <h3>${responder['cancelledRequests']}</h3>
                                            <h5>Cancelled</h5>
                                        </span>
                                    </div>
                            </div>
                        </div>
                        <div class="middle">
                            <div>
                                Email: <p>${responder['email']}</p>
                            </div>
                            <div>
                                Contact Number: <p>${responder['contactNumber']}</p>
                            </div>
                            <div>
                                Gender: <p>${responder['gender']}</p>
                            </div>
                            <div>
                                Age: <p>${responder['age']}</p>
                            </div>
                            <div>
                                Joined: <p>${responder['joined']}</p>
                            </div>
                        </div>
                        <div class="bottom">
                            
                        </div>
                    </div>
                    `
                }
            }else{
                
                if(responder['type'] == 'Fire & Rescue'||responder['type'] == 'Fire'){
                    rightViewer.innerHTML =
                        `<div class="responders-row-view">
                        <div class="top">
                            <span class="user-details">
                                <div class="border-line fire">
                                    <span class="avatar-icon">
                                        <i class="fa-solid fa-user"></i></span></div><span class="user-name">
                                    <h3>${responder['fname']} ${responder['lname']}</h3>
                                    <h4>${responder['type']}</h4>
                                </span>
                            </span>
                            <div class="responder-responses">
                                <h4>Request Responses</h4>
                                    <div class="statusCounts">
                                        <span>
                                        <h3>${responder['ongoingRequest']}</h3>
                                            <h5>Ongoing</h5> 
                                        </span>
                                        <span>
                                        <h3>${responder['completedRequests']}</h3>
                                            <h5>Completed</h5> 
                                        </span>
                                        <span>
                                            <h3>${responder['cancelledRequests']}</h3>
                                            <h5>Cancelled</h5>
                                        </span>
                                    </div>
                            </div>
                        </div>
                        <div class="middle">
                            <div>
                                Email: <p>${responder['email']}</p>
                            </div>
                            <div>
                                Contact Number: <p>${responder['contactNumber']}</p>
                            </div>
                            <div>
                                Gender: <p>${responder['gender']}</p>
                            </div>
                            <div>
                                Age: <p>${responder['age']}</p>
                            </div>
                            <div>
                                Joined: <p>${responder['joined']}</p>
                            </div>
                        </div>
                        <div class="bottom">
                            <div>
                                Request Id: <p>${ongoingRequest['requestId']}</p>
                            </div>
                            <div class="status">
                                Status: <p>${ongoingRequest['status']}</p>
                            </div>
                            <div class="location">
                                Location: <p>${ongoingRequest['location']}</p>
                            </div>
                            <div id="mini-map"></div>
                        </div>
                    </div>`
                }else if(responder['type'] == 'Medical'){
                    rightViewer.innerHTML =
                        `<div class="responders-row-view">
                        <div class="top">
                            <span class="user-details">
                                <div class="border-line medical">
                                    <span class="avatar-icon">
                                        <i class="fa-solid fa-user"></i></span></div><span class="user-name">
                                    <h3>${responder['fname']} ${responder['lname']}</h3>
                                    <h4>${responder['type']}</h4>
                                </span>
                            </span>
                            <div class="responder-responses">
                                <h4>Request Responses</h4>
                                    <div class="statusCounts">
                                        <span>
                                        <h3>${responder['ongoingRequest']}</h3>
                                            <h5>Ongoing</h5> 
                                        </span>
                                        <span>
                                        <h3>${responder['completedRequests']}</h3>
                                            <h5>Completed</h5> 
                                        </span>
                                        <span>
                                            <h3>${responder['cancelledRequests']}</h3>
                                            <h5>Cancelled</h5>
                                        </span>
                                    </div>
                            </div>
                        </div>
                        <div class="middle">
                            <div>
                                Email: <p>${responder['email']}</p>
                            </div>
                            <div>
                                Contact Number: <p>${responder['contactNumber']}</p>
                            </div>
                            <div>
                                Gender: <p>${responder['gender']}</p>
                            </div>
                            <div>
                                Age: <p>${responder['age']}</p>
                            </div>
                            <div>
                                Joined: <p>${responder['joined']}</p>
                            </div>
                        </div>
                        <div class="bottom">
                            <div>
                                Request Id: <p>${ongoingRequest['requestId']}</p>
                            </div>
                            <div class="status">
                                Status: <p>${ongoingRequest['status']}</p>
                            </div>
                            <div class="location">
                                Location: <p>${ongoingRequest['location']}</p>
                            </div>
                            <div id="mini-map"></div>
                        </div>
                    </div>`

                }else{
                    rightViewer.innerHTML =
                        `<div class="responders-row-view">
                        <div class="top">
                            <span class="user-details">
                                <div class="border-line police">
                                    <span class="avatar-icon">
                                        <i class="fa-solid fa-user"></i></span></div><span class="user-name">
                                    <h3>${responder['fname']} ${responder['lname']}</h3>
                                    <h4>${responder['type']}</h4>
                                </span>
                            </span>
                            <div class="responder-responses">
                                <h4>Request Responses</h4>
                                    <div class="statusCounts">
                                        <span>
                                        <h3>${responder['ongoingRequest']}</h3>
                                            <h5>Ongoing</h5> 
                                        </span>
                                        <span>
                                        <h3>${responder['completedRequests']}</h3>
                                            <h5>Completed</h5> 
                                        </span>
                                        <span>
                                            <h3>${responder['cancelledRequests']}</h3>
                                            <h5>Cancelled</h5>
                                        </span>
                                    </div>
                            </div>
                        </div>
                        <div class="middle">
                            <div>
                                Email: <p>${responder['email']}</p>
                            </div>
                            <div>
                                Contact Number: <p>${responder['contactNumber']}</p>
                            </div>
                            <div>
                                Gender: <p>${responder['gender']}</p>
                            </div>
                            <div>
                                Age: <p>${responder['age']}</p>
                            </div>
                            <div>
                                Joined: <p>${responder['joined']}</p>
                            </div>
                        </div>
                        <div class="bottom">
                            <div>
                                Request Id: <p>${ongoingRequest['requestId']}</p>
                            </div>
                            <div class="status">
                                Status: <p>${ongoingRequest['status']}</p>
                            </div>
                            <div class="location">
                                Location: <p>${ongoingRequest['location']}</p>
                            </div>
                            <div id="mini-map"></div>
                        </div>
                    </div>`
                }
            }

        }

        function initMap(){
            var options = {
                center: {lat: parseFloat(ongoingRequest['lat']),lng: parseFloat(ongoingRequest['lng'])},
                zoom: 16,
                mapId: '77e0ca00e7e580ce',
                disableDefaultUI: true, 
            }
            map =  new google.maps.Map(document.getElementById('mini-map'), options);
            
            marker = new google.maps.Marker({
                position: {lat: parseFloat(ongoingRequest['lat']),lng: parseFloat(ongoingRequest['lng'])},
                map: map,
                title: type,
                animation: google.maps.Animation.DROP,
                icon: {
                        url: 'https://img.icons8.com/stickers/100/null/map-pin.png',
                        scaledSize: new google.maps.Size(40,42) // this customly sets the height and width dimensions of all icon markers on map
                },
                }); 
                }
  
    </script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTvsSu0ZGBeOQ_wLQu1Ochqlr8Yd8XPjg&map_ids=d1718992514fbee0&callback=initMap"
    defer
  ></script>
</x-layout>