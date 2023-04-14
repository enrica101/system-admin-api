<x-layout>
<section>
    <div id="map"></div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"
            integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.body.style.overflowY = 'hidden'
    const profileBtn = document.querySelector('.avatar');
    const profileOverView = document.querySelector('.profile-overview')
    const footer = document.querySelector('.footer')


//     profileBtn.addEventListener('click', () => {
//     profileOverView.classList.toggle('active');
// })

    let marker, map, allMarkers = [];

    //Create a function creates a button that controls the filtering of requests on the map.
    function createFireFilter(map, allMarkers){
        // Create a button html tag to trigger the event for the filtering
        const fireControlButton = document.createElement("button");

        // This sets the CSS for the button control
        fireControlButton.style.backgroundColor = "#fff"; //set the background color for the button control white
        fireControlButton.style.border = "2px solid #fff"; // sets 2px thickness of border that is also white
        fireControlButton.style.borderRadius = "3px"; //this gives the button a bit of a rounder look around its egdes
        fireControlButton.style.boxShadow = "0 2px 6px rgba(0,0,0,0.3)"; //this puts a shadow of 30% opacity of the hue black
        fireControlButton.style.color = "#323232";  //sets the font color of the button control 
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
            // fireControlButton.style.backgroundColor = "#f4f4f4";
            displayAllMarkers(allMarkers)
            allMarkers.forEach(marker =>{
                if(marker['title'] != 'Fire & Rescue'){
                    marker.setVisible(false)
                }
            })
        });

        return fireControlButton;

    }

    function createMedicalFilter(map, allMarkers){
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
            displayAllMarkers(allMarkers)
            allMarkers.forEach(marker =>{
                if(marker['title'] != 'Medical'){
                    marker.setVisible(false)
                }
            })
        });

        return medicalControlButton;

    }

    function createPoliceFilter(map, allMarkers){
        const policeControlButton = document.createElement("button");

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
            allMarkers.forEach(marker =>{
                if(marker['title'] != 'Police'){
                    marker.setVisible(false)
                }
            })
        });

        return policeControlButton;
    }

    function createResetFilter(map, allMarkers){
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
        });

        return resetControlButton;
    }

    function displayAllMarkers(allMarkers){
        allMarkers.forEach(marker =>{
                    marker.setVisible(true)
            })
    }

    function initMap(){
        var options = {
            center: {lat: 10.298099450420516, lng:123.88947252856845},
            zoom: 14,
            mapId: '39d7b83c8e09ed62',
            disableDefaultUI: true, 
            zoomControl: true, 
            scaleControl: true 
        }
        map =  new google.maps.Map(document.getElementById('map'), options);
        
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
        function geo(){
            axios.get('/api/requests')
            .then( res => {
                res.data.forEach(location => {
                    var requestType = location['type']
                    var status = location['status']
                    var lat = parseFloat(location['lat'])
                    var lng = parseFloat(location['lng'])
                    
                    addMarker({lat: lat, lng: lng}, requestType, status); //creates each map marker
                    
                });
            }).catch(err => console.log(err));
        }

        function addMarker(coordinates, type, status){

            // The conditional statement below distinguishes 
            // each markers by request type and assigns 
            // the corresponding marker icon.
            if(type == 'Police'){
                    iconMarker = 'https://img.icons8.com/stickers/100/000000/public-safety.png';
            }else 
            if(type == 'Medical'){
                    iconMarker = 'https://img.icons8.com/stickers/100/000000/doctors-bag.png';
            }else{
                iconMarker = 'https://img.icons8.com/stickers/100/000000/fires.png';
            }

            marker = new google.maps.Marker({
            position: coordinates,
            map: map,
            title: type,
            animation: google.maps.Animation.DROP,
            icon: {
                    url: iconMarker,
                    scaledSize: new google.maps.Size(31,33) // this customly sets the height and width dimensions of all icon markers on map
            },
            }); 
            
            allMarkers.push(marker)
           
                var infoWindow = new google.maps.InfoWindow({
                    content: 
                    '<b>Request Type: </b><br>'+ type +
                    '<br><b>Request Status: </b><br>'+ status 
                });
                
                marker.addListener('click', function(){
                    infoWindow.open(map,marker);
                })

            }
    }
    
</script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpzxH-n6mF4SCHEopsGNGtd3oUw2uL2rQ&map_ids=39d7b83c8e09ed62&callback=initMap"
  defer
></script>
</x-layout>