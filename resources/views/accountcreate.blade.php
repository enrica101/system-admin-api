@php
use App\Models\Unit;
@endphp

<!DOCTYPE html>
<x-layout>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- <link rel="stylesheet" href="css/style.css"> -->
        <title>User Data Entry System</title>
    </head>

    <body>
        <div class="container mt-4 daryllcard">
            <div class="card daryllcard">
                <div class="card-body ">
                    <h4 class="card-title">User Data Entry System</h4>
                    <!-- <img class="card-img-top d-flex" src="img/default-img-dark.png" alt=""> -->
                    <div class="card-text">
                        <!-- <h3 class="mt-3">User Data Registration System</h3> -->
                        <form method="POST" action="/create" enctype="multipart/form-data" class="daryllwashere">
                            @csrf
                            <div class="form-group mt-4">
                                <label for="role">Account Type*</label>
                                <select class="form-control" name="role" id="role">
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                    <option value="Responder">Responder</option>
                                </select>
                            </div>

                            <div id="unit_ops" class="form-group mt-4">
                                <label for="unit">Unit</label>

                                @php
                                $units = Unit::all();
                                @endphp
                                <select class="form-control" name="unit" id="unit">
                                    @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <br>
                            <div id="responder-options" style="display:none;">
                                <label for="type">Responder Type*</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="Fire & Rescue">Fire &amp; Rescue</option>
                                    <option value="Medical">Medical</option>
                                    <option value="Police">Police</option>
                                </select>
                            </div>

                            <script>
                                var roleSelect = document.getElementById("role");
                                var responderOptions = document.getElementById("responder-options");
                                var unitOptions = document.getElementById("unit_ops");

                                roleSelect.addEventListener("change", function() {
                                    if (roleSelect.value == "Responder") {
                                        responderOptions.style.display = "block";
                                        unitOptions.style.display = "block";
                                    } else {
                                        responderOptions.style.display = "none";
                                        unitOptions.style.display = "none";
                                    }
                                });
                            </script>
                            <div class="form-group mt-4">
                                <label for="email">Email Address*</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="user@email.com">
                                @error('email')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-4">
                                <label for="password">Password*</label>
                                <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" placeholder="Enter password">
                                @error('password')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-4">
                                <label for="password_confirmation">Confirm Password*</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Confirm password">
                                @error('password_confirmation')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group mt-4">
                                    <label for="fname">First Name*</label>
                                    <input type="text" class="form-control" name="fname" id="fname" value="{{old('fname')}}" placeholder="Enter your first name">
                                    @error('fname')
                                    <small style="color: brown">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group mt-4">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" class="form-control" name="mname" id="mname" value="{{old('mname')}}" placeholder="Enter your middle name">
                                    @error('mname')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group mt-4">
                                    <label for="lname">Last Name*</label>
                                    <input type="text" class="form-control" name="lname" id="lname" value="{{old('lname')}}" placeholder="Enter your last name">
                                    @error('lname')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group mt-4">
                                <label for="gender">Gender*</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="male" @if (old('gender')=='male' ) selected="selected" @endif>Male</option>
                                    <option value="female" @if (old('gender')=='female' ) selected="selected" @endif>Female</option>
                                </select>
                            </div>
                            <div class="form-group mt-4">
                                <label for="birthdate">Birthdate*</label>
                                <input type="date" class="form-control" name="birthdate" id="birthdate" value="{{old('birthdate')}}">
                                @error('birthdate')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-4">
                                <label for="contactNumber">Contact Number <small>[Optional]</small> </label>
                                <input type="text" class="form-control" name="contactNumber" id="contactNumber" value="{{old('contactNumber')}}" placeholder="+639 / 09*********">
                                @error('contactNumber')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <!-- <div class="form-group mt-4">
                                <label for="avatar">Upload Profile Picture <small>[Optional]</small></label><br>
                                <input type="file" class="form-control-file" name="avatar" accept="image/*"><br>
                                @error('avatar')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div> -->
                            <br>
                            <br>
                            <button type="submit" class="btn btn-primary">Register</button><br>
                            <!-- <small>Already have an account? <a href="/">Login</a></small> -->
                        </form>
                    </div>
                </div>

    </body>
</x-layout>