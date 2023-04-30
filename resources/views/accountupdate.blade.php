<!DOCTYPE html>
<x-layout>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="/js/sweetalert2@10.js"></script>

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
                    <h4 class="card-title">User Data Update System</h4>
                    <!-- <img class="card-img-top d-flex" src="img/default-img-dark.png" alt=""> -->
                    <div class="card-text">
                        <!-- <h3 class="mt-3">User Data Registration System</h3> -->
                        <form method="POST" action="{{ route('account.manage', $user->id) }}" enctype="multipart/form-data" class="daryllwashere">
                            @csrf
                            @method('PUT')
                            <div class="form-group mt-4">
                                <label for="role">User Verification Status</label>
                                <select class="form-control" name="email_verified_at" id="email_verified_at">
                                    <option value="null" {{$user->email_verified_at == null ? 'selected' : ''}}>Not Verified</option>
                                    <option value="not null" {{$user->email_verified_at != null ? 'selected' : ''}}>Verified</option>
                                </select>

                                <!--Use axios to call /users/verify/{id} route and use sweet alert to display success message-->
                                <!-- <button type="button" class="btn btn-primary mt-2" onclick="verifyUser({{$user->id}})">Verification Toggle</button> -->
                                <button type="button" class="btn btn-primary mt-2" onclick="verifyUser({{$user->id}})" {{$user->email_verified_at != null ? 'style=background-color:#dc3545' : 'style=background-color:#28a745'}}> {{$user->email_verified_at != null ? 'Revoke Verification' : 'Verify User'}}</button>
                                <script>
                                    function verifyUser(id) {
                                        console.log("ID + " + id);
                                        axios.get('/api/users/verify/' + id)
                                            .then(function(response) {
                                                if (response.data.message == 'User unverified!') {
                                                    Swal.fire({
                                                        icon: 'warning',
                                                        title: 'Verification Revoked!',
                                                        text: 'User has been unverified successfully.',
                                                        timer: 2000
                                                    })
                                                    //refresh
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 1500);
                                                    return;
                                                } else if (response.data.message == 'User verified!') {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'User Verification Complete!',
                                                        text: 'User has been verified successfully.',
                                                        timer: 2000
                                                    })
                                                    //refresh
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 1500);
                                                    return;
                                                }

                                            })
                                            .catch(function(error) {
                                                console.log(error);
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Verification Failure',
                                                    text: 'Could not verify user. Please contact the administrator.\n\n' + error + '\n\n' + error.response.data.message,
                                                })
                                            });
                                    }
                                </script>

                                <button type="button" class="btn btn-primary mt-2" onclick="userQuery({{$user->id}})">Query User</button>
                                <script>
                                    function userQuery(id) {
                                        console.log("ID + " + id);
                                        axios.get('/api/users/' + id)
                                            .then(function(response) {
                                                console.log(response);
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'User Query Success!',
                                                    text: response.data.message,
                                                    timer: 2000
                                                })
                                                //refresh
                                                setTimeout(function() {
                                                    location.reload();
                                                }, 1500);
                                            })
                                            .catch(function(error) {
                                                console.log(error);
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'User Query Failure',
                                                    text: 'Could not query user. Please contact the administrator.\n\n' + error + '\n\n' + error.response.data.message,
                                                })
                                            });
                                    }
                                </script>

                                <button type="button" class="btn btn-primary mt-2" onclick="viewID({{$user->id}})">View ID</button>
                                <script>
                                    function viewID(id) {
                                        console.log("ID + " + id);
                                        axios.get('/api/users/idphoto/'+  id)
                                            .then(function(response) {
                                                console.log(response);

                                                if (response.data.idPhoto != null) {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Success!',
                                                        text: response.data.message,
                                                        //image path from id_photo column
                                                        imageUrl: response.data.idPhoto,
                                                        imageWidth: 400,
                                                        imageHeight: 200,
                                                        imageAlt: 'User ID',
                                                    })
                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'No ID Photo',
                                                        text: 'User has not uploaded an ID photo.',
                                                    })
                                                }
                                            })
                                            .catch(function(error) {
                                                console.log(error);
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'User ID Failure',
                                                    text: 'Could not retrieve user ID. Please contact the administrator.\n\n' + error + '\n\n' + error.response.data.message,
                                                })
                                            });
                                    }
                                </script>


                                @if($user->role == 'Responder')
                                <div class="data-entry">
                                </div>
                                <div class="form-group mt-4">
                                    <label for="role">Account Type*</label>
                                    <select class="form-control" name="role" id="role">
                                        <option value="Admin" {{$user->role == 'Admin' ? 'selected' : ''}}>Admin</option>
                                        <option value="User" {{$user->role == 'User' ? 'selected' : ''}}>User</option>
                                        <option value="Responder" {{$user->role == 'Responder' ? 'selected' : ''}}>Responder</option>
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

                                    roleSelect.addEventListener("change", function() {
                                        if (roleSelect.value == "Responder") {
                                            responderOptions.style.display = "block";
                                        } else {
                                            responderOptions.style.display = "none";
                                        }
                                    });
                                </script>
                                <div class="form-group mt-4">
                                    <label for="email">Email Address*</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" placeholder="user@email.com">
                                    @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group mt-4">
                                    <label for="password">Password*</label>
                                    <input type="password" class="form-control" name="password" id="password" value="{{$user->password}}" placeholder="Enter password">
                                    @error('password')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group mt-4">
                                    <label for="password_confirmation">Confirm Password*</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{$user->password_confirmation}}" placeholder="Confirm password">
                                    @error('password_confirmation')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group mt-4">
                                        <label for="fname">First Name*</label>
                                        <input type="text" class="form-control" name="fname" id="fname" value="{{$user->fname}}" placeholder="Enter your first name">
                                        @error('fname')
                                        <small style="color: brown">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group mt-4">
                                        <label for="mname">Middle Name</label>
                                        <input type="text" class="form-control" name="mname" id="mname" value="{{$user->mname}}" placeholder="Enter your middle name">
                                        @error('mname')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group mt-4">
                                        <label for="lname">Last Name*</label>
                                        <input type="text" class="form-control" name="lname" id="lname" value="{{$user->lname}}" placeholder="Enter your last name">
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
                                    <input type="date" class="form-control" name="birthdate" id="birthdate" value="{{$user->birthdate}}">
                                    @error('birthdate')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group mt-4">
                                    <label for="contactNumber">Contact Number <small>[Optional]</small> </label>
                                    <input type="text" class="form-control" name="contactNumber" id="contactNumber" value="{{$user->contactNumber}}" placeholder="+639 / 09*********">
                                    @error('contactNumber')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group mt-4">
                                    <label for="avatar">Upload Profile Picture <small>[Optional]</small></label><br>
                                    <input type="file" class="form-control-file" name="avatar" accept="image/*"><br>
                                    @error('avatar')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <br>
                                <br>
                                <button type="submit" class="btn btn-primary">Register</button><br>
                                <small>Already have an account? <a href="/">Login</a></small>
                        </form>
                    </div>
                </div>
            </div>
            @endif

    </body>
</x-layout>