<x-layout>
    <section>
        <div id="map"></div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js" integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.body.style.overflowY = 'hidden'
        const profileBtn = document.querySelector('.avatar');
        const profileOverView = document.querySelector('.profile-overview')
        const footer = document.querySelector('.footer')


        let marker, map, placeMarkers = [];
        let allMarkers = [];
        //array of array of polygon vertices
        polygonCoords = [
            [
                //Cebu Central BFP
                {
                    lat: 10.29607,
                    lng: 123.88737
                },
                {
                    lat: 10.29885,
                    lng: 123.88527
                },
                {
                    lat: 10.29928,
                    lng: 123.88505
                },
                {
                    lat: 10.29999,
                    lng: 123.88489
                },
                {
                    lat: 10.3007,
                    lng: 123.88275
                },
                {
                    lat: 10.30135,
                    lng: 123.88176
                },
                {
                    lat: 10.30209,
                    lng: 123.87958
                },
                {
                    lat: 10.30297, //stopped here
                    lng: 123.87718
                },
                {
                    lat: 10.30375,
                    lng: 123.87424
                },
                {
                    lat: 10.31221,
                    lng: 123.87476
                },
                {
                    lat: 10.31044,
                    lng: 123.86405
                },
                {
                    lat: 10.30316,
                    lng: 123.86248
                },
                {
                    lat: 10.30105,
                    lng: 123.85819
                },
                {
                    lat: 10.29675,
                    lng: 123.85752
                },
                {
                    lat: 10.29617,
                    lng: 123.85702
                },
                {
                    lat: 10.28956,
                    lng: 123.85301
                },
                {
                    lat: 10.28676,
                    lng: 123.85853
                },
                {
                    lat: 10.28902,
                    lng: 123.86557
                },
                {
                    lat: 10.28103,
                    lng: 123.88321
                },
                {
                    lat: 10.28374,
                    lng: 123.88593
                }

            ],
            [ //Pardo PNP Jurisdiction
                {
                    lat: 10.28179,
                    lng: 123.87475
                },
                {
                    lat: 10.28458,
                    lng: 123.87265
                },
                {
                    lat: 10.28298,
                    lng: 123.87003
                },
                {
                    lat: 10.2844,
                    lng: 123.86695
                },
                {
                    lat: 10.28537,
                    lng: 123.86327
                },
                {
                    lat: 10.28676,
                    lng: 123.86104
                },
                {
                    lat: 10.28593,
                    lng: 123.8587
                },
                {
                    lat: 10.28739,
                    lng: 123.85426
                },
                {
                    lat: 10.28703,
                    lng: 123.85252
                },
                {
                    lat: 10.2856,
                    lng: 123.8496
                },
                {
                    lat: 10.28248,
                    lng: 123.84491
                },
                {
                    lat: 10.2819,
                    lng: 123.8444
                },
                {
                    lat: 10.27529,
                    lng: 123.84039
                },
                {
                    lat: 10.27248,
                    lng: 123.84591
                },
                {
                    lat: 10.26604,
                    lng: 123.84995
                },
                {
                    lat: 10.26946,
                    lng: 123.86965
                }
            ],
            [ //Police Station 2 - Fuente Juridiction

                {
                    lat: 10.3015,
                    lng: 123.90346
                },
                {
                    lat: 10.31779,
                    lng: 123.89763
                },
                {
                    lat: 10.31972,
                    lng: 123.89306
                },
                {
                    lat: 10.31885,
                    lng: 123.89029
                },
                {
                    lat: 10.31636,
                    lng: 123.88252
                },
                {
                    lat: 10.31062,
                    lng: 123.88415
                },
                {
                    lat: 10.29635,
                    lng: 123.8917
                },
            ],
            [
                //Police Station 5 - Carbon Juridiction

                {
                    lat: 10.29263,
                    lng: 123.90951
                },
                {
                    lat: 10.29888,
                    lng: 123.90385
                },
                {
                    lat: 10.30072,
                    lng: 123.89979
                },
                {
                    lat: 10.29951,
                    lng: 123.89668
                },
                {
                    lat: 10.29822,
                    lng: 123.88902
                },
                {
                    lat: 10.29787,
                    lng: 123.88728
                },
                {
                    lat: 10.29643,
                    lng: 123.88437
                },
                {
                    lat: 10.29298,
                    lng: 123.87907
                },
                {
                    lat: 10.28796,
                    lng: 123.87556
                },
                {
                    lat: 10.28725,
                    lng: 123.88707
                },
                {
                    lat: 10.28608,
                    lng: 123.89123
                },
                {
                    lat: 10.28799,
                    lng: 123.89535
                }

            ],
            [ //PNP Mabolo Jurisdiction
                {
                    lat: 10.31437,
                    lng: 123.93612
                },
                {
                    lat: 10.3191,
                    lng: 123.93003
                },
                {
                    lat: 10.32044,
                    lng: 123.92764
                },
                {
                    lat: 10.32187,
                    lng: 123.92576
                },
                {
                    lat: 10.32295,
                    lng: 123.92325
                },
                {
                    lat: 10.31997,
                    lng: 123.91563
                },
                {
                    lat: 10.31961,
                    lng: 123.91389
                },
                {
                    lat: 10.31817,
                    lng: 123.91097
                },
                {
                    lat: 10.31506,
                    lng: 123.90627
                },
                {
                    lat: 10.31448,
                    lng: 123.90577
                },
                {
                    lat: 10.30787,
                    lng: 123.90176
                },
                {
                    lat: 10.30506,
                    lng: 123.90728
                },
                {
                    lat: 10.29863,
                    lng: 123.91132
                },
                {
                    lat: 10.30846,
                    lng: 123.92338
                }
            ],

        ];



        // const fireStations = [{
        //         lat: 10.29777159357524,
        //         lng: 123.89194542056934,
        //         title: 'BFP CEBU REGION VII OFFICE',
        //         icon: 'https://img.icons8.com/?size=32&id=Q0TVUon5Lln9&format=png',
        //         type: 'Fire & Rescue',
        //         unit: 'BUREAU OF FIRE PROTECTION',

        //     },
        //     {

        //         lat: 10.27916636106637,
        //         lng: 123.85490164776354,
        //         title: 'BFP PARDO FIRE SUBSTATION',
        //         icon: 'https://img.icons8.com/?size=32&id=Q0TVUon5Lln9&format=png',
        //         type: 'Fire & Rescue',
        //         unit: 'BUREAU OF FIRE PROTECTION',

        //     },
        //     {

        //         lat: 10.300269662239069,
        //         lng: 123.88178984919715,
        //         title: 'BFP LABANGON FIRE STATION',
        //         icon: 'https://img.icons8.com/?size=32&id=Q0TVUon5Lln9&format=png',
        //         type: 'Fire & Rescue',
        //         unit: 'BUREAU OF FIRE PROTECTION',


        //     },
        //     {

        //         lat: 10.325073099409664,
        //         lng: 123.89826662158048,
        //         title: 'BFP LAHUG FIRE SUBSTATION',
        //         icon: 'https://img.icons8.com/?size=32&id=Q0TVUon5Lln9&format=png',
        //         type: 'Fire & Rescue',
        //         unit: 'BUREAU OF FIRE PROTECTION',

        //     },
        //     {
        //         lat: 10.323549318797818,
        //         lng: 123.88410563595791,
        //         title: 'BFP GUADALUPE FIRE SUBSTATION',
        //         icon: 'https://img.icons8.com/?size=32&id=Q0TVUon5Lln9&format=png',
        //         type: 'Fire & Rescue',
        //         unit: 'BUREAU OF FIRE PROTECTION',
        //     },
        //     {

        //         lat: 10.31389853808104,
        //         lng: 123.9160416092285,
        //         title: 'BFP MABOLO FIRE SUBSTATION',
        //         icon: 'https://img.icons8.com/?size=32&id=Q0TVUon5Lln9&format=png',
        //         type: 'Fire & Rescue',
        //         unit: 'BUREAU OF FIRE PROTECTION',

        //     },
        //     {
        //         lat: 10.293435002195197,
        //         lng: 123.89406257912542,
        //         title: 'BFP SAN NICOLAS FIRE SUBSTATION',
        //         icon: 'https://img.icons8.com/?size=32&id=Q0TVUon5Lln9&format=png',
        //         type: 'Fire & Rescue',
        //         unit: 'BUREAU OF FIRE PROTECTION',
        //     },
        // ];

        // const policeStations = [{
        //         lat: 10.281018662550558,
        //         lng: 123.85509967667018,
        //         title: 'PNP POLICE STATION 7 - PARDO',
        //         icon: 'https://img.icons8.com/?size=32&id=K6DcBh6Fr34j&format=png',
        //         type: 'Police',
        //         unit: 'PHILIPPINE NATIONAL POLICE',
        //     },
        //     {

        //         lat: 10.293432951989331,
        //         lng: 123.89767169731381,
        //         title: 'PNP POLICE STATION 5 - CARBON',
        //         icon: 'https://img.icons8.com/?size=32&id=K6DcBh6Fr34j&format=png',
        //         type: 'Police',
        //         unit: 'PHILIPPINE NATIONAL POLICE',

        //     },
        //     {

        //         lat: 10.29664200873103,
        //         lng: 123.87260913719784,
        //         title: 'PNP POLICE STATION 10 - PUNTA PRINCESA',
        //         icon: 'https://img.icons8.com/?size=32&id=K6DcBh6Fr34j&format=png',
        //         type: 'Police',
        //         unit: 'PHILIPPINE NATIONAL POLICE',
        //     },
        //     {

        //         lat: 10.303820043688352,
        //         lng: 123.89518260805069,
        //         title: 'PNP POLICE STATION 2 - FUENTE',
        //         icon: 'https://img.icons8.com/?size=32&id=K6DcBh6Fr34j&format=png',
        //         type: 'Police',
        //         unit: 'PHILIPPINE NATIONAL POLICE',
        //     },
        //     {

        //         lat: 10.312710666710414,
        //         lng: 123.91580799545001,
        //         title: 'PNP POLICE STATION 4 - MABOLO',
        //         icon: 'https://img.icons8.com/?size=32&id=K6DcBh6Fr34j&format=png',
        //         type: 'Police',
        //         unit: 'PHILIPPINE NATIONAL POLICE',

        //     }

        // ];

        // const medicalStations = [{
        //         lat: 10.333936486502663,
        //         lng: 123.91044978984485,
        //         title: 'ERUF BANILAD',
        //         icon: 'https://img.icons8.com/?size=32&id=K6DcBh6Fr34j&format=png',
        //         type: 'Medical',
        //         unit: 'ERUF',
        //     }, {
        //         lat: 10.29130021704532,
        //         lng: 123.87753201725641,
        //         title: 'CCDRRMO',
        //         icon: 'https://img.icons8.com/?size=32&id=K6DcBh6Fr34j&format=png',
        //         type: 'Medical',
        //         unit: 'LGU',
        //     },
        //     {
        //         lat: 10.310403310627603,
        //         lng: 123.9084781007516,
        //         title: 'CEBU CITY HEALTH CENTER',
        //         icon: 'https://img.icons8.com/?size=32&id=K6DcBh6Fr34j&format=png',
        //         type: 'Medical',
        //         unit: 'LGU',
        //     },
        // ];


        //Create a function creates a button that controls the filtering of requests on the map.
        function createFireFilter(map, allMarkers) {
            // Create a button html tag to trigger the event for the filtering
            const fireControlButton = document.createElement("button");

            // This sets the CSS for the button control
            fireControlButton.style.backgroundColor = "#fff"; //set the background color for the button control white
            fireControlButton.style.border = "2px solid #fff"; // sets 2px thickness of border that is also white
            fireControlButton.style.borderRadius = "3px"; //this gives the button a bit of a rounder look around its egdes
            fireControlButton.style.boxShadow =
                "0 2px 6px rgba(0,0,0,0.3)"; //this puts a shadow of 30% opacity of the hue black
            fireControlButton.style.color = "#323232"; //sets the font color of the button control 
            fireControlButton.style.cursor = "pointer"; //sets the cursor when on hover to a pointer one
            fireControlButton.style.fontFamily = "Roboto, sans-serif"; //set the family font style
            fireControlButton.style.lineHeight = "38px";
            fireControlButton.style.margin = "15px 20px";
            fireControlButton.style.padding = " 0 5px";
            fireControlButton.style.textAlign = "center";

            fireControlButton.textContent = "Only Fire";
            fireControlButton.title = "Click to display only fire emergency requests.";
            fireControlButton.type = "button";


            // Setup the click eent listeners
            fireControlButton.addEventListener("click", () => {
                console.log(allMarkers)
                displayAllMarkers(allMarkers)
                allMarkers.forEach(marker => {
                    if (marker['title'] != 'Fire & Rescue') {
                        marker.setVisible(false)
                        console.log(marker);
                    }
                    console.log(marker);
                })
                placeMarkers.forEach(polygon => {
                    polygon.setVisible(false)
                    console.log(polygon)
                })
            });

            return fireControlButton;
        }

        function createMedicalFilter(map, allMarkers) {
            const medicalControlButton = document.createElement("button");

            medicalControlButton.style.backgroundColor = "#fff";
            medicalControlButton.style.border = "2px solid #fff";
            medicalControlButton.style.borderRadius = "3px";
            medicalControlButton.style.boxShadow = "0 2px 6px rgba(0,0,0,0.3)";
            medicalControlButton.style.color = "#323232";
            medicalControlButton.style.cursor = "pointer";
            medicalControlButton.style.fontFamily = "Roboto, sans-serif";
            medicalControlButton.style.lineHeight = "38px";
            medicalControlButton.style.margin = "5px 20px";
            medicalControlButton.style.padding = " 0 5px";
            medicalControlButton.style.textAlign = "center";

            medicalControlButton.textContent = "Only Medical";
            medicalControlButton.title = "Click to display only fire emergency requests.";
            medicalControlButton.type = "button";


            medicalControlButton.addEventListener("click", () => {
                console.log("medical pressed!");
                displayAllMarkers(allMarkers)
                allMarkers.forEach(marker => {
                    if (marker['title'] != 'Medical') {
                        marker.setVisible(false)
                    }
                    console.log(marker)
                })
                placeMarkers.forEach(polygon => {
                    polygon.setVisible(false)
                })

            });

            return medicalControlButton;

        }

        function createPoliceFilter(map, allMarkers) {
            const policeControlButton = document.createElement("button");
            console.log("police");
            policeControlButton.style.backgroundColor = "#fff";
            policeControlButton.style.border = "2px solid #fff";
            policeControlButton.style.borderRadius = "3px";
            policeControlButton.style.boxShadow = "0 2px 6px rgba(0,0,0,0.3)";
            policeControlButton.style.color = "#323232";
            policeControlButton.style.cursor = "pointer";
            policeControlButton.style.fontFamily = "Roboto, sans-serif";
            policeControlButton.style.lineHeight = "38px";
            policeControlButton.style.margin = "15px 20px";
            policeControlButton.style.padding = " 0 5px";
            policeControlButton.style.textAlign = "center";

            policeControlButton.textContent = "Only Police";
            policeControlButton.title = "Click to display only fire emergency requests.";
            policeControlButton.type = "button";
            policeControlButton.addEventListener("click", () => {

                displayAllMarkers(allMarkers)
                allMarkers.forEach((marker) => {

                    if (marker['title'] != 'Police') {
                        marker.setVisible(false)
                    }
                    console.log(marker);
                });
                placeMarkers.forEach(polygon => {
                    polygon.setVisible(true)
                    console.log(polygon)
                })

            });

            return policeControlButton;
        }

        function createResetFilter(map, allMarkers) {
            console.log("Reset!");
            const resetControlButton = document.createElement("button");

            resetControlButton.style.backgroundColor = "#fff";
            resetControlButton.style.border = "2px solid #fff";
            resetControlButton.style.borderRadius = "3px";
            resetControlButton.style.boxShadow = "0 2px 6px rgba(0,0,0,0.3)";
            resetControlButton.style.color = "#323232";
            resetControlButton.style.cursor = "pointer";
            resetControlButton.style.fontFamily = "Roboto, sans-serif";
            resetControlButton.style.lineHeight = "38px";
            resetControlButton.style.margin = "38px 20px";
            resetControlButton.style.padding = " 0 5px";
            resetControlButton.style.textAlign = "center";

            resetControlButton.textContent = "Reset";
            resetControlButton.title = "Click to reset filters.";
            resetControlButton.type = "button";

            resetControlButton.addEventListener("click", () => {
                displayAllMarkers(allMarkers)
                placeMarkers.forEach(polygon => {
                    polygon.setVisible(true)
                })

            });

            return resetControlButton;
        }

        function displayAllMarkers(allMarkers) {
            allMarkers.forEach((marker) => {
                marker.setVisible(true)
            })
        }

        function geo() {
            console.log("Geo!");
            axios.get('/api/requests')
                .then(res => {

                    res.data.forEach((location) => {
                        var requestType = location['type']
                        var status = location['status']
                        var lat = parseFloat(location['lat'])
                        var lng = parseFloat(location['lng'])

                        addMarker({
                            lat: lat,
                            lng: lng
                        }, requestType, status); //creates each map marker


                    });
                }).catch(err => console.log(err));

            axios.get('/api/units')
                .then(res => {

                    res.data.forEach((location) => {
                        console.log(location)
                        var requestType = location['type']
                        var status = location['status']
                        var lat = parseFloat(location['lat'])
                        var lng = parseFloat(location['lng'])
                        console.log(typeof lat)
                        console.log(typeof lng)
                        addMarker({
                            lat: lat,
                            lng: lng
                        }, location.type, location.unit, location.title); //creates each map marker

                    });
                }).catch(err => console.log(err));

                axios.get('/api/polygons').then(response => {
  const data = response.data;
  const result = {};

  data.forEach(item => {
    if(!result[item.unit]) {
      result[item.unit] = [];
    }

    result[item.unit].push({ lat: parseFloat(item.lat), lng: parseFloat(item.lng)});
  });

  const finalResult = Object.values(result);
  console.log("FINAL RESULT")
  console.log(finalResult);

    finalResult.forEach(polygon => {
       placeMarkers.push(new google.maps.Polygon({
                    paths: polygon,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    map: map
                }));
    });
});


            // axios.get('/api/polygons')
            //     .then(res => {
            //         const polygons = res.data.map(row => {
            //             console.log("NEW ROW")
            //             console.log(row.lat, row.lng);
            //             var lat = parseFloat(location['lat'])
            //             var lng = parseFloat(location['lng'])
            //             return [
            //                 new google.maps.LatLng(lat, lng),

            //             ];
            //         });

            //         console.log("FULL POLYGON ARRAY")
            //         console.log(polygons)

            //         polygons.forEach(polygon => {

            //             new google.maps.Polygon({
            //                 paths: polygon,
            //                 strokeColor: '#FF0000',
            //                 strokeOpacity: 0.8,
            //                 strokeWeight: 2,
            //                 fillColor: '#FF0000',
            //                 fillOpacity: 0.35,
            //                 map: map
            //             });
            //             placeMarkers.push(polygon);
            //             polygon.setVisible(true);
            //         });

            //     })
            //     .catch(err => console.log(err));


            //     polygonCoords.forEach((polygonCoord) => {
            //     // Construct the polygon.
            //     const polygon = new google.maps.Polygon({
            //         paths: polygonCoord,
            //         strokeColor: 'blue',
            //         strokeOpacity: 0.8,

            //         strokeWeight: 2,
            //         fillColor: 'rgba(173, 216, 230, 1)', //light blue

            //         fillOpacity: 0.35
            //     });
            //     placeMarkers.push(polygon)
            //     // Set the polygon on the map
            //     polygon.setMap(map);
            //     polygon.setVisible(true);
            // });

            // console.log(allMarkers)

            // fireStations.forEach((location) => {
            //     addMarker({
            //         lat: location.lat,
            //         lng: location.lng
            //     }, location.type, location.unit, location.title)
            // });

            // policeStations.forEach((location) => {
            //     addMarker({
            //         lat: location.lat,
            //         lng: location.lng
            //     }, location.type, location.unit, location.title)
            // });

            // medicalStations.forEach((location) => {
            //     addMarker({
            //         lat: location.lat,
            //         lng: location.lng
            //     }, location.type, location.unit, location.title)
            // });
        }

        function addMarker(coordinates, type, status, title) {
            console.log("Add Marker!");

            // The conditional statement below distinguishes 
            // each markers by request type and assigns 
            // the corresponding marker icon.
            if (type == 'Police') {
                if (status == 'PHILIPPINE NATIONAL POLICE') {
                    iconMarker = 'https://img.icons8.com/?size=32&id=K6DcBh6Fr34j&format=png';
                } else
                    iconMarker = 'https://img.icons8.com/stickers/100/000000/public-safety.png';
            } else
            if (type == 'Medical') {
                if (status == 'ERUF' || status == 'LGU') {
                    iconMarker = 'https://img.icons8.com/stickers/100/null/hospital-3.png';
                } else
                    iconMarker = 'https://img.icons8.com/stickers/100/000000/doctors-bag.png';
            } else {
                if (status == 'BUREAU OF FIRE PROTECTION') {
                    iconMarker = 'https://img.icons8.com/?size=32&id=Q0TVUon5Lln9&format=png';
                } else
                    iconMarker = 'https://img.icons8.com/stickers/100/000000/fires.png';
            }

            marker = new google.maps.Marker({
                position: coordinates,
                map: map,
                title: type,
                type: title,
                animation: google.maps.Animation.DROP,
                unit: status,
                icon: {
                    url: iconMarker,
                    scaledSize: new google.maps.Size(31,
                        33) // this customly sets the height and width dimensions of all icon markers on map
                },
            });
            console.log("New Marker: " + marker);
            allMarkers.push(marker)

            if (type == 'Police') {
                if (status == 'PHILIPPINE NATIONAL POLICE') {
                    var infoWindow = new google.maps.InfoWindow({
                        content: '<b>' + title + '</b>' +
                            '<br><b>' + type + '</b>' +
                            '<br><b>' + status + '</b>'
                    });
                } else {
                    var infoWindow = new google.maps.InfoWindow({
                        content: '<b>Request Type: </b><br>' + type +
                            '<br><b>Request Status: </b><br>' + status
                    });
                }
            } else
            if (status == 'BUREAU OF FIRE PROTECTION') {
                var infoWindow = new google.maps.InfoWindow({
                    content: '<b>' + title + '</b>' +
                        '<br><b>' + type + '</b>' +
                        '<br><b>' + status + '</b>'
                });
            } else
            if (type == 'Medical') {
                if (status == 'EMERGENCY RESCUE UNIT FOUNDATION' || status == 'CEBU CITY DISASTER RISK REDUCTION AND MANAGEMENT OFFICE' || status == 'LGU') {
                    var infoWindow = new google.maps.InfoWindow({
                        content: '<b>' + title + '</b>' +
                            '<br><b>' + type + '</b>' +
                            '<br><b>' + status + '</b>'
                    });
                } else {
                    var infoWindow = new google.maps.InfoWindow({
                        content: '<b>Request Type: </b><br>' + type +
                            '<br><b>Request Status: </b><br>' + status
                    });
                }
            } else {
                var infoWindow = new google.maps.InfoWindow({
                    content: '<b>Request Type: </b><br>' + type +
                        '<br><b>Request Status: </b><br>' + status
                });
            }

            allMarkers.forEach(marker => {
                marker.addListener('click', () => {
                    let info = infoWindow.content
                    console.log(marker)
                    if (info.includes(marker.type)) {
                        infoWindow.open(map, marker)
                    } else if (info.includes('Request Type') && info.includes(marker.title)) {
                        infoWindow.open(map, marker)

                    }
                })
            })

        }


        function initMap() {
            console.log("Init Map");
            var options = {
                center: {
                    lat: 10.298099450420516,
                    lng: 123.88947252856845
                },
                zoom: 14,
                mapId: '39d7b83c8e09ed62',
                disableDefaultUI: true,
                zoomControl: true,
                scaleControl: true
            }

            map = new google.maps.Map(document.getElementById('map'), options);

            //iterate through array of array of polygon vertices
            polygonCoords.forEach((polygonCoord) => {
                // Construct the polygon.
                const polygon = new google.maps.Polygon({
                    paths: polygonCoord,
                    strokeColor: 'blue',
                    strokeOpacity: 0.8,

                    strokeWeight: 2,
                    fillColor: 'rgba(173, 216, 230, 1)', //light blue

                    fillOpacity: 0.35
                });
                placeMarkers.push(polygon)
                // Set the polygon on the map
                polygon.setMap(map);
                polygon.setVisible(true);
            });

            const fireFilterControlDiv = document.createElement("div")
            const medicalFilterControlDiv = document.createElement("div")
            const policeFilterControlDiv = document.createElement("div")
            const resetFilterControlDiv = document.createElement("div")

            const fireFilterControl = createFireFilter(map, allMarkers)
            const medicalFilterControl = createMedicalFilter(map, allMarkers)
            const policeFilterControl = createPoliceFilter(map, allMarkers)
            const resetFilterControl = createResetFilter(map, allMarkers)

            fireFilterControlDiv.appendChild(fireFilterControl)
            medicalFilterControlDiv.appendChild(medicalFilterControl)
            policeFilterControlDiv.appendChild(policeFilterControl)
            resetFilterControlDiv.appendChild(resetFilterControl)

            map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(fireFilterControlDiv)
            map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(medicalFilterControlDiv)
            map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(policeFilterControlDiv)
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(resetFilterControlDiv)

            geo()

        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3xcAyCALx3yLmzfs7cS3gjeYkV7bg_AU&map_ids=39d7b83c8e09ed62&callback=initMap" defer></script>
</x-layout>