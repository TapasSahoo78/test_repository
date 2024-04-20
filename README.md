$validator = Validator::make($request->all(), [
                "booking_id" => "required",
                "status" => "required|numeric",

                "duties_photo" => 'required_if:status,6',
                "vehicle_number" => 'required_if:status,6',
                "vehicle_photos" => 'required_if:status,6,3',

                "journey_meter_number" => 'required_if:status,6,3',
                "car_meter_photo" => 'required_if:status,6,3',
            ]);
