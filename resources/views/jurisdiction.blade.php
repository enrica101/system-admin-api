<x-layout>
    <h4 class="header1 card-title">Jurisdiction Data Entry System</h4>
    <h4 class="header2 card-title">Map</h4>
    <section>
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
            position: { lat: latitude, lng: longitude },
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
    <div class="statistic">


    </div>
    <div class="dashboard container mt-4 daryllcard" style="overflow-y: auto; height: 700px">
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
                <h7 class="">Add jurisdictional boundaries to placemarks</h7>
                <!-- <img class="card-img-top d-flex" src="img/default-img-dark.png" alt=""> -->
                <div class="card-text">
                    <!-- <h3 class="mt-3">User Data Registration System</h3> -->
                    <form method="POST" action="/unit/add-vertices" enctype="multipart/form-data">
                        @csrf
                        @php
                        $units = App\Models\Unit::all();
                        $polygons = App\Models\Polygon::all();

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
                    <br><br>
                    <!-- <form method="DELETE" action=/polygons enctype="multipart/form-data">
                            <h5>Delete Jurisdictional Data</h5>
                            <!-- <div class="form-group mt-4">
                                <label for="unit">Unit</label>
                                <select class="form-control" id="unit" name="unit" required>
                                    @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->title}}</option>
                                    @endforeach
                                </select> -->

                    <!-- <button type="delete" class="="btn btn-primary">Delete</button>
                        </form> -->
                    <h5>Delete Jurisdictional Point</h5>
                    <table class="table" style="display: block">
                        <thead>
                            <tr>
                                <th>Unit</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($polygons as $polygon)
                            <tr>
                                <td>{{$units->where('id', $polygon->unit)->first()->title}}</td>
                                <td>{{$polygon->lat}}</td>
                                <td>{{$polygon->lng}}</td>
                                <td>{{$units->where($polygon->unit)->first()}} <button type="button" class="btn btn-danger" onclick="deleteSpecificCoord(`{{$polygon->id}}`)">Delete Point</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h5>Delete Jurisdictional Data</h5>
                    <div class="table-responsive">
                        <table class="table table-striped" style="display: block">
                            <thead>
                                <tr>
                                    <th>Jurisdiction Name</th>
                                    <th>ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $unit)
                                @if($polygons->where('unit', $unit->id)->count() > 0)
                                <tr>
                                    <td>{{$unit->title}}</td>
                                    <td>{{$unit->id}}</td>
                                    <td><button type="button" class="btn btn-danger" onclick="deletePolygon(`{{$unit->id}}`)">Delete</button></td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteSpecificCoord(id) {
            if (confirm("Confirm to delete coordinate id: " + id + "?")) {
                alert("Confirmed");
                console.log("Deleting");
                console.log(id);
                axios.delete('/api/polygons/point', {
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
                                text: response.data.message,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            })
                            window.location.reload();
                        }

                    })
                    .catch(function(error) {
                        console.log(error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Something went wrong. \n\n' + error + '\n\n Please contact the system administrator.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    });
            } else {
                alert("Canceled");
            }

        }

        function deletePolygon(id) {
            console.log("ID");
            console.log(id);
            axios.delete('/api/polygons/', {
                    params: {
                        unit: id
                    },

                    headers: {
                        'Content-Type': 'x-www-form-urlencoded'
                    },
                    data: {
                        unit: id
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
                            title: 'Error',
                            text: 'Something went wrong. \n\n' + response.data.message + '\n\n Please contact the system administrator.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                        window.location.reload();
                    }

                })
                .catch(function(error) {
                    console.log(error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Something went wrong. \n\n' + error + '\n\n Please contact the system administrator.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                    window.location.reload();
                });
        }
    </script>
</x-layout>