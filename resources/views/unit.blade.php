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
                    <h4 class="card-title">Unit Data Entry System</h4>
                    <!-- <img class="card-img-top d-flex" src="img/default-img-dark.png" alt=""> -->
                    <div class="card-text">
                        <!-- <h3 class="mt-3">User Data Registration System</h3> -->
                        <form method="POST" action="/unit/create" enctype="multipart/form-data" class="daryllwashere">
                            @csrf
                            <div class="form-group">
                                <label for="name">Unit Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Unit Name" required>
                            </div>

                            <div class="form-group">
                                <label for="type">Unit Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="Fire & Rescue">Fire & Rescue</option>
                                <option value="Medical-ERUF">Medical-ERUF</option>
                                <option value="Police">Police</option>
                            </select>
                            </div>

                            <div class="form-group">
                                <label for="lat">Latitude</label>
                                <input type="text" class="form-control" id="lat" name="lat" placeholder="Enter Latitude" required>

                            </div>

                            <div class="form-group">
                                <label for="lng">Longitude</label>
                                <input type="text" class="form-control" id="lng" name="lng" placeholder="Enter Longitude" required>
                            </div>

                            <br>
                            <br>

                            <button type="submit" class="btn btn-primary">Create Unit</button><br>
                            <!-- <small>Already have an account? <a href="/">Login</a></small> -->
                        </form>
                    </div>
                </div>

    </body>
</x-layout>