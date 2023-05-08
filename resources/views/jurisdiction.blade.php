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
                <div class="card-body daryllcard">
                    <h4 class="card-title">Jurisdiction Data Entry System</h4>
                    <h7 class="">Add juridictional boundaries to placemarks</h7>
                    <!-- <img class="card-img-top d-flex" src="img/default-img-dark.png" alt=""> -->
                    <div class="card-text">
                        <!-- <h3 class="mt-3">User Data Registration System</h3> -->
                        <form method="POST" action="/unit/add-vertices" enctype="multipart/form-data">
                            @csrf
                            @php
                            $units = App\Models\Unit::all();
                            @endphp
                            <div class="form-group mt-4">
                                <label for="unit">Unit</label>
                                <select class="form-control" id="unit" name="unit" required>
                                    @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-4">
                                <label for="lat">Latitude</label>
                                <input type="text" class="form-control" id="lat" name="lat" placeholder="Enter Latitude" required>
                            </div>

                            <div class="form-group mt-4">
                                <label for="lng">Longitude</label>
                                <input type="text" class="form-control" id="lng" name="lng" placeholder="Enter Longitude" required>
                            </div>
                           <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

    </body>
</x-layout>