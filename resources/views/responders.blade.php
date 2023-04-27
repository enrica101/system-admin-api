<x-layout>
    <header class="header1">
        <h2>Responders</h2>
    </header>

    <header class="header2">
        <div class="avatar">
            <span>
                <small>Hey, {{auth()->user()->fname}}</small>
                <br/>
                <small class="accountType">Admin</small>
            </span>
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
            <div class="tab all active"><h4>All Responders</h4></div>
            <div class="tab second"><h4>Idle Responders</h4></div>
            <div class="tab third"><h4>Handling Requests</h4></div>

            <select name="type" id="type" >
                <option value="">Select type</option>
                <option value="All">All</option>
                <option value="Fire & Rescue">Fire & Rescue</option>
                <option value="Medical">Medical</option>
                <option value="Police">Police</option>
            </select>
            <div class="search">
                <input type="text" name="search-responder" id="search-responder" placeholder="Search responder" />
                <button class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
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
                <tr>
                <td id="norecords">No record.</td></tr>
                @endif
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
                @unless(count($idleResponders) == 0)
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
                <tr>
                <td id="norecords">No record.</td></tr>
                @endif
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
                @unless(count($handlingRequests) == 0)
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
                <tr>
                <td id="norecords">No record.</td></tr>
                @endif
            </tbody>
            </table>
    </div>
    <div class="view">
        <h4>Select a responder to see more information.</h4>
        
    </div>
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

        const norecords = document.getElementById('norecords')

        // profile toggle
        const profile = document.querySelector('.profile')
        const avatar = document.querySelector('.avatar')

        avatar.addEventListener('click', ()=>{
            profile.classList.toggle('show')
        })
    

        const searchResponder = document.getElementById('search-responder')
        const searchBtn = document.querySelector('.btn-search')

        searchBtn.addEventListener('click', ()=>{
            console.log(searchResponder.value)
                if(searchResponder.value !='' && searchResponder.value != null){
                    const url = new URL('http://system-admin.herokuapp.com/responders');
                    url.searchParams.append('name', searchResponder.value);
                    const urlString = url.toString();
                    window.location.href = urlString;
            }
        })

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


        filterSelect.addEventListener('change', (e) => {
            const url = new URL('http://system-admin.herokuapp.com/responders');
            url.searchParams.append('type', e.target.value);
            const urlString = url.toString();
            window.location.href = urlString;
        })
        
        rowSelect.forEach(row => {
        row.addEventListener('click', (e) => {
            rightViewer.innerHTML = ''
            getAccountResponder(e.target.id)
            })
        })

        function getAccountResponder(responderID){
            axios.get('api/accounts/responders/search/'+responderID).then(res => {
                displayAccountResponder(res.data['responder'][0])
            }).catch(err => console.log(err))
        }

        function displayAccountResponder(responder){
            rightViewer.innerHTML =
                `<div class="responder">
                <div class="top">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="35" height="35" viewBox="0 0 24 24" stroke-width="1" stroke="#323232" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="12" r="9" />
                    <circle cx="12" cy="10" r="3" />
                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                    </svg>
                    <span>
                        <h3>${responder['fname']} ${responder['lname']}</h3>
                        <h4>${responder['type']}</h4>
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
        }

  
    </script>
    
</x-layout>