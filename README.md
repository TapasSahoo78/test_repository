<div class="tab-content" id="myTabContent">
                @foreach (bookingTypeList() as $key => $value)
                    <div class="tab-pane fade show {{ $value->id == 1 ? 'active' : '' }}" id="{{ $value->slug }}"
                        role="tabpanel" aria-labelledby="{{ $value->slug }}-tab">
                        {{-- <p>{{ $value?->id }}</p> --}}
                        <!-- tab-content -->
                        <div class="tab-content">
                            <form class="adminFrm" data-action="{{ route('bookings.createBooking') }}" method="post"
                                data-class="requiredCheck">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <input type="hidden" value="{{ $value->id }}" name="booking_type">
                                        <div class="form-inner">
                                            <div class="row">
                                                <div class="col-lg-6 col-12 mb-3">
                                                    <div class="form-group green">
                                                        <input type="text" class="form-control pickupLocation"
                                                            id="pickupLocation" placeholder="Type Your Pickup Location"
                                                            name="pickup_location">
                                                        <label for=""><img src="assets/images/location.svg"
                                                                class="img-fluid" alt=""></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12 mb-3">
                                                    <div class="form-group red">
                                                        <input type="text" class="form-control dropLocation"
                                                            id="dropLocation" placeholder="Type Your Destination Location"
                                                            name="drop_location">
                                                    </div>
                                                </div>

                                                <input type="hidden" name="pickup_latitude" id="pickup_latitude">
                                                <input type="hidden" name="pickup_longitude" id="pickup_longitude">
                                                <input type="hidden" name="drop_latitude" id="drop_latitude">
                                                <input type="hidden" name="drop_longitude" id="drop_longitude">

                                                <div class="col-lg-6 col-12 mb-3">
                                                    <!-- <input type="date" class="form-control"> -->
                                                    <div class="form-group pa__top-sec">
                                                        <div class="pa__middle-item">
                                                            <input class="pa__middle-input text form-control" type="date"
                                                                placeholder="Date of Journey" name="booking_date"
                                                                onchange="this.className=(this.value!=''?'has-value':'')">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="time" class="form-control" name="booking_time">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <select class="form-select" name="car_type_id"
                                                            aria-label="Default select example">
                                                            <option value="">Vehicle Type</option>
                                                            @foreach ($data['car_type'] as $car)
                                                                <option value="{{ $car?->id }}">
                                                                    {{ $car?->car_type_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <select class="form-select" name="gear_type_id"
                                                            aria-label="Default select example">
                                                            <option value="">Gear Type</option>
                                                            @foreach ($data['gear_type'] as $gear)
                                                                <option value="{{ $gear?->id }}">
                                                                    {{ $gear?->gear_type_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <select class="form-select" name="estimate_time"
                                                            aria-label="Default select example">
                                                            <option value="" selected>Estimated Time (In Hrs)
                                                            </option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="4">4</option>
                                                            <option value="6">6</option>
                                                            <option value="8">8</option>
                                                            <option value="10">10</option>
                                                            <option value="12">12</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-12">
                                        <div class="form-right ">
                                            <h6> FARE ESTIMATED </h6>
                                            <h2>&#8377; 288</h2>
                                            <span>GST included</span>
                                            <p>This is just an estimate, actual fare will be calculated after the drive.</p>
                                            @guest
                                                <a href="#" class="btn btn-primary request-drvr" data-bs-toggle="modal"
                                                    data-bs-target="#generateOtpModal">Sign Now<i
                                                        class="fa-solid fa-arrow-right"></i></a>
                                            @endguest
                                            @auth
                                                <button type="submit" class="btn btn-primary request-drvr">Request Driver<i
                                                        class="fa-solid fa-arrow-right"></i></button>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

- this is my blade file 

<script>
        window.addEventListener('load', initialize);

        function initialize() {
            // const pickupInput = document.getElementById('pickupLocation');
            // const dropInput = document.getElementById('dropLocation');

            const pickupInput = document.getElementsByClassName('pickupLocation')[0];
            const dropInput = document.getElementsByClassName('dropLocation')[0];

            const pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput);
            const dropAutocomplete = new google.maps.places.Autocomplete(dropInput, {
                types: ['geocode']
            }); // Restrict drop-off to addresses

            pickupAutocomplete.addListener('place_changed', function() {
                const place = pickupAutocomplete.getPlace();
                if (place.geometry) {
                    console.log(place.geometry.location.lat());
                    $('#pickup_latitude').val(place.geometry.location.lat());
                    $('#pickup_longitude').val(place.geometry.location.lng());
                }
            });

            dropAutocomplete.addListener('place_changed', function() {
                const place = dropAutocomplete.getPlace();
                if (place.geometry) {
                    console.log(place.geometry.location.lng());
                    $('#drop_latitude').val(place.geometry.location.lat());
                    $('#drop_longitude').val(place.geometry.location.lng());
                }
            });
        }
    </script>

my jquery correction
when search google autocomplete address get and latlong add only first tab but others tabs is not working.
