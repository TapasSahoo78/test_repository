It seems like you're encountering an issue where the Google Autocomplete for address search and latlong retrieval is only working for the first tab, but not for the subsequent tabs. This is likely due to the fact that when the page is loaded, your script initializes the Autocomplete for the first set of input fields it finds with the class `pickupLocation` and `dropLocation`. Since these elements are found only once in the first tab, the Autocomplete is only applied to those.

To make sure the Autocomplete works for input fields in all tabs, you'll need to adjust your script to initialize Autocomplete for each set of input fields in every tab.

Here's a suggested approach:

1. Update your blade file to include a unique identifier for each set of `pickupLocation` and `dropLocation` input fields. This can be achieved by appending the tab's index or any unique identifier to the class.

Your updated blade file should look something like this:

```html
@foreach (bookingTypeList() as $key => $value)
    <div class="tab-pane fade show {{ $value->id == 1 ? 'active' : '' }}" id="{{ $value->slug }}"
        role="tabpanel" aria-labelledby="{{ $value->slug }}-tab">
        {{-- Rest of your code --}}
        <div class="col-lg-6 col-12 mb-3">
            <div class="form-group green">
                <input type="text" class="form-control pickupLocation-{{ $value->id }}"
                    id="pickupLocation-{{ $value->id }}" placeholder="Type Your Pickup Location"
                    name="pickup_location">
                <label for=""><img src="assets/images/location.svg" class="img-fluid" alt=""></label>
            </div>
        </div>
        <div class="col-lg-6 col-12 mb-3">
            <div class="form-group red">
                <input type="text" class="form-control dropLocation-{{ $value->id }}"
                    id="dropLocation-{{ $value->id }}" placeholder="Type Your Destination Location"
                    name="drop_location">
            </div>
        </div>
        {{-- Rest of your code --}}
    </div>
@endforeach
```

2. Update your JavaScript to loop through all tabs and initialize Autocomplete for each set of input fields.

Here's the updated script:

```javascript
<script>
    window.addEventListener('load', initialize);

    function initialize() {
        const tabs = document.querySelectorAll('.tab-pane');

        tabs.forEach((tab, index) => {
            const pickupInput = tab.querySelector('.pickupLocation-' + (index + 1));
            const dropInput = tab.querySelector('.dropLocation-' + (index + 1));

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
    }
</script>
```

With this update, the script will now initialize the Autocomplete for each set of `pickupLocation` and `dropLocation` input fields within every tab. The script uses the tab's index to uniquely identify each set of input fields and applies the Autocomplete accordingly. This should resolve the issue of Autocomplete not working for tabs beyond the first one.









It seems like you're encountering an issue where the Google Autocomplete for address search and latlong retrieval is only working for the first tab, but not for the subsequent tabs. This is likely due to the fact that when the page is loaded, your script initializes the Autocomplete for the first set of input fields it finds with the class `pickupLocation` and `dropLocation`. Since these elements are found only once in the first tab, the Autocomplete is only applied to those.

To make sure the Autocomplete works for input fields in all tabs, you'll need to adjust your script to initialize Autocomplete for each set of input fields in every tab.

Here's a suggested approach:

1. Update your blade file to include a unique identifier for each set of `pickupLocation` and `dropLocation` input fields. This can be achieved by appending the tab's index or any unique identifier to the class.

Your updated blade file should look something like this:

```html
@foreach (bookingTypeList() as $key => $value)
    <div class="tab-pane fade show {{ $value->id == 1 ? 'active' : '' }}" id="{{ $value->slug }}"
        role="tabpanel" aria-labelledby="{{ $value->slug }}-tab">
        {{-- Rest of your code --}}
        <div class="col-lg-6 col-12 mb-3">
            <div class="form-group green">
                <input type="text" class="form-control pickupLocation-{{ $value->id }}"
                    id="pickupLocation-{{ $value->id }}" placeholder="Type Your Pickup Location"
                    name="pickup_location">
                <label for=""><img src="assets/images/location.svg" class="img-fluid" alt=""></label>
            </div>
        </div>
        <div class="col-lg-6 col-12 mb-3">
            <div class="form-group red">
                <input type="text" class="form-control dropLocation-{{ $value->id }}"
                    id="dropLocation-{{ $value->id }}" placeholder="Type Your Destination Location"
                    name="drop_location">
            </div>
        </div>
        {{-- Rest of your code --}}
    </div>
@endforeach
```

2. Update your JavaScript to loop through all tabs and initialize Autocomplete for each set of input fields.

Here's the updated script:

```javascript
<script>
    window.addEventListener('load', initialize);

    function initialize() {
        const tabs = document.querySelectorAll('.tab-pane');

        tabs.forEach((tab, index) => {
            const pickupInput = tab.querySelector('.pickupLocation-' + (index + 1));
            const dropInput = tab.querySelector('.dropLocation-' + (index + 1));

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
    }
</script>
```

With this update, the script will now initialize the Autocomplete for each set of `pickupLocation` and `dropLocation` input fields within every tab. The script uses the tab's index to uniquely identify each set of input fields and applies the Autocomplete accordingly. This should resolve the issue of Autocomplete not working for tabs beyond the first one.