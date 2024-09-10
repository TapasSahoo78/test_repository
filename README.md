<div id="renderBody">
                        <div class="col-sm-12 dynamic-fields">
                            @foreach ($b2bPriceData as $b2bFare)
                                <div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">From Distance (per/km)</label>
                                            <input type="text" class="form-control" name="from_distance[]"
                                                value="{{ $b2bFare?->from_distance }}" id="from_distance">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">To Distance (per/km)</label>
                                            <input type="text" class="form-control" name="to_distance[]"
                                                value="{{ $b2bFare?->to_distance }}" id="to_distance">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">Fare</label>
                                            <input type="text" class="form-control" name="b2b_fare[]"
                                                value="{{ $b2bFare?->b2b_fare }}" id="b2b_fare">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">Extra KM</label>
                                            <input type="text" class="form-control" name="extra_km[]"
                                                value="{{ $b2bFare?->extra_km }}" id="extra_km">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">Waiting Charge</label>
                                            <input type="text" class="form-control" name="waiting_charge[]"
                                                value="{{ $b2bFare?->waiting_charge }}" id="waiting_charge">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">Secure Charge</label>
                                            <input type="text" class="form-control" name="secure_charge[]"
                                                value="{{ $b2bFare?->secure_charge }}" id="secure_charge">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">Night Charge</label>
                                            <input type="text" class="form-control" name="night_charge[]"
                                                value="{{ $b2bFare?->night_charge }}" id="night_charge">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">Cancellation Charge</label>
                                            <input type="text" class="form-control" name="cancellation_charge[]"
                                                value="{{ $b2bFare?->cancellation_charge }}" id="cancellation_charge">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">GST</label>
                                            <input type="text" class="form-control" name="b2b_gst[]"
                                                value="{{ $b2bFare?->b2b_gst }}" id="b2b_gst">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">Platform Charge</label>
                                            <input type="text" class="form-control" name="platform_charge[]"
                                                value="{{ $b2bFare?->platform_charge }}" id="platform_charge">
                                        </div>
                                    </div>

                                    <!-- Other fields here... -->
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label"></label><br>
                                            <button type="button" class="btn btn-danger remove-field ml-2">-</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        </div>
                    </div>

<script>
        $(document).ready(function(parameters) {
            document.getElementById('add-field').addEventListener('click', function() {
                // Clone the first set of fields
                const newFields = document.querySelector('.dynamic-fields').cloneNode(true);

                // Clear the values in the cloned fields
                const inputs = newFields.querySelectorAll('input');
                inputs.forEach(input => input.value = '');

                // Append the cloned fields to renderBody
                document.getElementById('renderBody').appendChild(newFields);
            });
            // Event delegation for removing fields
            document.getElementById('renderBody').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-field')) {
                    const dynamicFields = document.querySelectorAll('.dynamic-fields');
                    // Check if there is more than one dynamic field
                    if (dynamicFields.length > 1) {
                        e.target.closest('.dynamic-fields').remove();
                    } else {
                        alert("At least one row is required.");
                    }
                }
            });
        });
    </script>

correction
