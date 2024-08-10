// Function to show the popup modal
function showPopup() {
    document.getElementById('popup').style.display = 'block';
}

// Function to close the popup modal
function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

// Function to show alert details in an alert box
function showAlertDetails(alertMessage) {
    alert(alertMessage);
}
// Replace 'YOUR_API_KEY' with your actual Google Maps API key
const API_KEY = 'YOUR_API_KEY';

// Function to initialize the map and show user's location
function initMap() {
    // Create a map centered on a default location
    const defaultLocation = { lat: -34.397, lng: 150.644 }; // Default location (can be changed)

    // Create a map object
    const map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 12,
        center: defaultLocation,
    });

    // Try to get the user's current location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // Update the map center to user's location
                map.setCenter(userLocation);

                // Add a marker at user's location
                new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: 'Your Location',
                });

                // Optionally, add radar overlay or other features here
            },
            () => {
                // Handle location access denied or error
                handleLocationError(true, map.getCenter());
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, map.getCenter());
    }
}

// Function to handle location errors
function handleLocationError(browserHasGeolocation, pos) {
    new google.maps.InfoWindow({
        content: browserHasGeolocation
            ? 'Error: The Geolocation service failed.'
            : 'Error: Your browser doesn\'t support geolocation.',
        position: pos,
    }).open(map);
}

// Load the Google Maps API script
function loadScript() {
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${API_KEY}&callback=initMap`;
    script.async = true;
    document.body.appendChild(script);
}

// Load the script when the page is ready
window.onload = loadScript;
