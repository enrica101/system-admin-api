<x-layout>
    <header class="header1">
        <h2>Settings</h2>
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


@if(session()->has('message'))
<div 
class="message" 
x-data="{show: true}" 
x-init="setTimeout(() => show=false, 2000)" 
x-show="show" 
x-transition.duration.500ms>
    <p>{{session('message')}}</p>
    <i class="fa-solid fa-xmark"></i>
</div>
@endif

<div class="settings">
    <h3>Edit your account information.</h3>

    <form method="POST" action="/settings" class="edit">
        @csrf
        @method('PUT')
        <div>
            <label for="">Email Address: </label>
            <input type="text" name="email" id="email" value="{{auth()->user()->email}}">
        </div>
        {{-- <div>
            <label for="">Password: </label>
            <input type="password" name="password" id="password" value="{{auth()->user()->password}}">
        </div>
        <div>
            <label for="password_confirmation">
                Confirm Password:
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
        </div> --}}
        <div>
            <label for="">First Name: </label>
            <input type="text" name="fname" id="fname" value="{{auth()->user()->fname}}">
        </div>
        <div>
            <label for="">Middle Name: </label>
            <input type="text" name="mname" id="mname" value="{{auth()->user()->mname}}">
        </div>
        <div>
            <label for="">Last Name: </label>
            <input type="text" name="lname" id="lname" value="{{auth()->user()->lname}}">
        </div>
        <div>
            <label for="">Contact Number: </label>
            <input type="text" name="contactNumber" id="contactNumber"  value="{{auth()->user()->contactNumber}}">
        </div>
    

        <button type="submit" class="btn btn-save">Save</button>
</form>

</div>
<script>
    // profile toggle
    const profile = document.querySelector('.profile')
        const avatar = document.querySelector('.avatar')

        avatar.addEventListener('click', ()=>{
            profile.classList.toggle('show')
        })
</script>
</x-layout>