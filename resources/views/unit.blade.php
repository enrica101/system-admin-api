<x-layout>




    <section>
        <br>
        <br>
        <div id="map" style="height: 600px; width: 100%"></div>
        <script>
            document.body.style.overflowY = 'hidden'
            var marker = null;

            function initMap() {

                map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: 10.309712693994909,
                        lng: 123.89312900494394,
                    },
                    zoom: 12
                });
                google.maps.event.addListener(map, "click", function(event) {
                    var latitude = event.latLng.lat();
                    var longitude = event.latLng.lng();
                    console.log(latitude, longitude);

                    // Remove previous marker if exists
                    if (marker) {
                        marker.setMap(null);
                    }

                    // Add new marker at clicked location
                    marker = new google.maps.Marker({
                        position: {
                            lat: latitude,
                            lng: longitude
                        },
                        map: map
                    });




                    // Update text boxes
                    document.getElementById("lat").value = latitude;
                    document.getElementById("lng").value = longitude;
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3xcAyCALx3yLmzfs7cS3gjeYkV7bg_AU&map_ids=39d7b83c8e09ed62&callback=initMap" defer></script>
    </section>


    <div class="container mt-4 daryllcard" style="height: 700px; overflow-y: auto">

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
                                <option value="LGU">Medical - CITY GOVERNMENT</option>
                                <option value="EMERGENCY RESCUE UNIT FOUNDATION">Medical - ERUF</option>
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

                        @php

                        $units = App\Models\Unit::all();
                        @endphp

                        @if(count($units) > 0)
                        <table style="display: block">
                            <thead>
                                <tr>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($units as $unit)
                                <tr>

                                    <button type="button" class="btn btn-danger" onclick="deleteUnit(`{{$unit->id}}`)">Delete {{$unit->title}}</button>
                                    <br>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif

                        <!-- <small>Already have an account? <a href="/">Login</a></small> -->
                    </form>


                </div>
            </div>

        </div>
    </div>
    <script>
        function deleteUnit(id) {
            console.log("ID");
            console.log(id);
            axios.delete('/api/unit/delete', {
                    params: {
                        id: id
                    },

                    headers: {
                        'Content-Type': 'x-www-form-urlencoded'
                    },
                    data: {
                        id: id
                    },
                }).then(function(response) {
                    console.log("AXIOS ID PASSED:")
                    console.log(id);
                    console.log(response);
                    if (response.data.status == 'success') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Jurisdictional data deleted successfully.',
                            icon: 'success',

                            confirmButtonText: 'Ok'
                        })
                        //refresh

                        window.location.reload();
                    } else {
                        Swal.fire({
                            title: 'Success',
                            text: "Deletion of Unit successful!",
                            confirmButtonText: 'Ok'
                        })
                        window.location.reload();
                    }

                })
                .catch(function(error) {
                    console.log(error);
                    Swal.fire({
                        title: 'Success',
                        text: "Deletion of Unit successful!",
                        confirmButtonText: 'Ok',
                        icon: 'success',

                    })
                    window.location.reload();
                });
        }
    </script>

</x-layout>