<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <title>Mail Content</title>
</head>
<body>
    <div class="emailContainer">
        <nav><img src="/img/default-img-dark.png" alt=""></nav>
        <div class="content">
            <div class="body">
                {{-- @dd($id); --}}
            <h4>Hello there {{$name}},</h4>
            <p>This email is to inform you that your account has been banned as your recent emergency request was flagged as a "Bogus Request". </p>
            <p>To restore your account please click on the link provided below.</p>
            <a href='http://system-admin.herokuapp.com/api/users/restore/{{$id}}'>Restore Account</a>
            <h5>From Team F2P</h5>
        </div>
        </div>
    </div>
</body>
</html>