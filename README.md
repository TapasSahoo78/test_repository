$subStop = BusTimeTableSlot::selectRaw("*,
                        ( 6371000 * acos( cos( radians(?) ) *
                        cos( radians( latitude ) )
                        * cos( radians( longitude ) - radians(?)
                        ) + sin( radians(?) ) *
                        sin( radians( latitude ) ) )
                        ) AS distance", [$request->latitude, $request->longitude, $request->latitude])
                        ->where('bus_time_type_id', $busDriver?->getBusTimeType->first()->id)
                        // ->where(['is_active' => 1, 'id' => 34])
                        ->having("distance", "<", 1000)
                        ->orderBy("distance", 'asc')
                        ->first();
