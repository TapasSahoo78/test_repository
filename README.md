<div class="tab-banner">
        <div class="container">
            <ul class="nav nav-tabs" id="tabhere" role="tablist">
                @foreach (bookingTypeList() as $key => $value)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $value->id == 1 ? 'active' : '' }}" id="{{ $value->slug }}-tab"
                            data-bs-toggle="tab" data-bs-target="#{{ $value->slug }}" type="button" role="tab"
                            aria-controls="{{ $value->slug }}" aria-selected="true">{{ $value->name }}</button>
                    </li>
                @endforeach
            </ul>
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
                                                        <input type="text"
                                                            class="form-control pickupLocation-{{ $value->id }}"
                                                            id="pickupLocation-{{ $value->id }}"
                                                            placeholder="Type Your Pickup Location" name="pickup_location">
                                                        <label for=""><img src="assets/images/location.svg"
                                                                class="img-fluid" alt=""></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12 mb-3">
                                                    <div class="form-group red">
                                                        <input type="text"
                                                            class="form-control dropLocation-{{ $value->id }}"
                                                            id="dropLocation-{{ $value->id }}"
                                                            placeholder="Type Your Destination Location"
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
                                                            {{ getEstimateTimeList($value?->id) }}
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-12">
                                        <div class="form-right ">
                                            <h6> FARE ESTIMATED

                                                <div hidden>
                                                    <div data-name="popover-content">
                                                        <table>
                                                            <tr>
                                                                <td><strong>Distance (first 5kms free)</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Hourly Price</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>GST</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Subtotal</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Previous Due Amount</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Round Off</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <hr><strong>Estimated Total Fare</strong>
                                                                </td>
                                                                <td>
                                                                    <hr>&nbsp;&nbsp;<span><strong>₹100.00</strong></span>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </div>
                                                </div>

                                                <a id="example" tabindex="0" class="popover-trigger" role="button"
                                                    data-bs-toggle="popover" title="Estimated Fare Details">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="6%" height="6%"
                                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M256 8C119 8 8 119.1 8 256c0 137 111 248 248 248s248-111 248-248C504 119.1 393 8 256 8zm0 110c23.2 0 42 18.8 42 42s-18.8 42-42 42-42-18.8-42-42 18.8-42 42-42zm56 254c0 6.6-5.4 12-12 12h-88c-6.6 0-12-5.4-12-12v-24c0-6.6 5.4-12 12-12h12v-64h-12c-6.6 0-12-5.4-12-12v-24c0-6.6 5.4-12 12-12h64c6.6 0 12 5.4 12 12v100h12c6.6 0 12 5.4 12 12v24z" />
                                                    </svg>
                                                </a>

                                            </h6>
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
        </div>
    </div>

    <script>
        window.addEventListener('load', initialize);

        function initialize() {

            const tabs = document.querySelectorAll('.tab-pane');
            const tabContent = document.getElementById('myTabContent');

            tabs.forEach((tab, index) => {
                const pickupInput = tab.querySelector('.pickupLocation-' + (index + 1));
                const dropInput = tab.querySelector('.dropLocation-' + (index + 1));

                pickupInput.addEventListener('input', calculatePrice);
                dropInput.addEventListener('input', calculatePrice);

                const pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput);
                const dropAutocomplete = new google.maps.places.Autocomplete(dropInput, {
                    types: ['geocode']
                });

                pickupAutocomplete.addListener('place_changed', function() {
                    const place = pickupAutocomplete.getPlace();
                    if (place.geometry) {
                        tab.querySelector('#pickup_latitude').value = place.geometry.location.lat();
                        tab.querySelector('#pickup_longitude').value = place.geometry.location.lng();
                    }
                });

                dropAutocomplete.addListener('place_changed', function() {
                    const place = dropAutocomplete.getPlace();
                    if (place.geometry) {
                        tab.querySelector('#drop_latitude').value = place.geometry.location.lat();
                        tab.querySelector('#drop_longitude').value = place.geometry.location.lng();
                    }
                });
            });

            // Add event listener for tab change
            tabContent.addEventListener('click', function(event) {
                const targetTab = event.target.closest('.tab-pane');
                if (!targetTab) return;

                tabs.forEach(tab => {
                    if (tab !== targetTab) {
                        const inputs = tab.querySelectorAll('input');
                        inputs.forEach(input => {
                            input.value = ''; // Clear input value
                        });
                    }
                });
            });

        }
    </script>
