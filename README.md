                                                   <div class="m-2" style="">
                                                        <input type="text" value="{{ $value?->latitude }}"
                                                            class="form-control latitude" name="latitude[]"
                                                            id="latitude-{{ $key }}" placeholder="Enter Latitude"
                                                            readonly>
                                                        <input type="text" value="{{ $value?->longitude }}"
                                                            onkeyup="initializeAutocomplete({{ $key }})"
                                                            class="form-control longitude" name="longitude[]"
                                                            id="longitude-{{ $key }}"
                                                            placeholder="Enter Longitude" readonly>
                                                        <center>
                                                            <button type="button" class="btn btn-warning"
                                                                onclick="fetchCurrentLocation(event, {{ $key }})">Current
                                                                Location</button>
                                                        </center>
                                                    </div>




           function fetchCurrentLocation(e, key) {
            e.preventDefault(); // Prevent default form submission
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    alert(position.coords.latitude + '||||' + position.coords.longitude);
                    document.getElementById('latitude-' + key).value = position.coords.latitude;
                    document.getElementById('longitude-' + key).value = position.coords.longitude;
                }, function() {
                    alert('Unable to retrieve your location.');
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }
