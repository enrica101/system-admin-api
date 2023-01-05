<x-layout>
    <header>
        <h2>Settings</h2>
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


@if(session()->has('message'))
<div class="message" x-data="{show: true}" x-init="setTimeout(() => show=false, 2000)" x-show="show" x-transition.duration.500ms>
    <p>{{session('message')}}</p>
    {{-- <i class="fa-solid fa-xmark"></i> --}}
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
        <div>
            <label for="">Password: </label>
            <input type="password" name="password" id="password" value="{{auth()->user()->password}}">
        </div>
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
</x-layout>