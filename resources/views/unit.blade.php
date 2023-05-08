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

        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
            <div class="card daryllcard">
                <div class="card-body ">
                    <h4 class="card-title">Unit Data Entry System</h4>
                    <!-- <img class="card-img-top d-flex" src="img/default-img-dark.png" alt=""> -->
                    <div class="card-text">
                        <!-- <h3 class="mt-3">User Data Registration System</h3> -->
                        <form method="POST" action="/unit/create" enctype="multipart/form-data" class="daryllwashere">
                            @csrf
                            <div class="form-group">
                                <label for="title">Unit Name</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Unit Name" required>
                                @error('title')
                                <br>
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

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
                                <label for="unit">Unit Office</label>
                            <select class="form-control" id="unit" name="unit" required>
                     <option value="BUREAU OF FIRE PROTECTION">Bureau of Fire Protection</option>
                        <option value="BUREAU OF JAIL MANAGEMENT AND PENOLOGY">Bureau of Jail Management and Penology</option>
                        <option value="BUREAU OF CORRECTION">Bureau of Correction</option>
                        <option value="PHILIPPINE NATIONAL POLICE">Philippine National Police</option>
                        <option value="PHILIPPINE COAST GUARD">Philippine Coast Guard</option>
                        <option value="PHILIPPINE DRUG ENFORCEMENT AGENCY">Philippine Drug Enforcement Agency</option>
                        <option value="PHILIPPINE PORTS AUTHORITY">Philippine Ports Authority</option>
                        <option value="CEBU CITY GOVERNMENT">Cebu City Government</option>
                        <option value="EMERGENCY RESCUE UNIT FOUNDATION">Emergency Rescue Unit Foundation</option>
                            
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