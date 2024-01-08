public function bookToto(Request $request)
    {
        $user = User::where('access_token', $request->header('token'))->first();
        $validator = Validator::make($request->all(), [
            'pickup_location' => 'required|string',
            'pickup_latitude' => 'required|string',
            'pickup_longitude' => 'required|string',
            'drop_location' => 'required|string',
            'drop_latitude' => 'required|string',
            'drop_longitude' => 'required|string',
            'payment_by' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ],
                200
            );
        }
        DB::beginTransaction();
        try {
            $response = getDistanceAndEta($request->pickup_latitude, $request->pickup_longitude, $request->drop_latitude, $request->drop_longitude);
            $duration = $response['duration'];
            $distanceInMeters = $response['distance'];
            // Convert duration from seconds to minutes
            $etaInMinutes = round($duration / 60, 2);
            info($etaInMinutes);
            info($distanceInMeters);
            $distanceInKm = $distanceInMeters / 1000;
            info($distanceInKm);
            if ($distanceInKm > 5) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => "Toto is not available in 5 kms",
                    ],
                    200
                );
            }
            info("--------------------------------------------------------------");
            $booking = new Booking;
            $booking->user_id = $user->id;
            $booking->booking_no = $booking->generateBookingNo();
            $booking->pickup_location = $request->pickup_location;
            $booking->pickup_latitude = $request->pickup_latitude;
            $booking->pickup_longitude = $request->pickup_longitude;
            $booking->drop_location = $request->drop_location;
            $booking->drop_latitude = $request->drop_latitude;
            $booking->drop_longitude = $request->drop_longitude;
            $booking->payment_by = $request->payment_by;
            $booking->eta = $etaInMinutes;
            $booking->save();
            $booking_log = new BookingLog;
            $booking_log->booking_id = $booking->id;
            $booking_log->response_given_by = 'Customer';
            $booking_log->response_giver_id = $user->id;
            $booking_log->response_given_at = Carbon::now();
            $booking_log->status_id = 1;
            $booking_log->save();

            $stands = Stand::nearestStand($request->pickup_latitude, $request->pickup_longitude)->pluck('id');
            info($stands);

            $data = [
                'booking' => $booking,
                'customer' => $user,
            ];

            if (count($stands) > 0) {
                $stand_manager_one = StandManagerList::with('getStandManager')->where('stand_id', $stands[0])->first();
                info($stand_manager_one);
                if (isset($stand_manager_one) && !empty($stand_manager_one)) {
                    $todayDate = Carbon::now()->toDateString();
                    $totos = Toto::select('totos.*')
                        ->join('toto_attendances', 'toto_attendances.toto_id', '=', 'totos.id')
                        ->where('stand_id', $stands[0])
                        ->whereDate('toto_attendances.created_at', $todayDate)
                        ->where('totos.is_online', 1)
                        ->where('totos.is_available', 1)
                        ->get();

                    if ($stand_manager_one->getStandManager->is_online == '1') {
                        info("11111");
                        $channels = [];
                        array_push($channels, 'standmanager-' . $stand_manager_one->stand_manager_id);
                        if (!empty($channels)) {
                            $pusher = new Pusher(
                                config('broadcasting.connections.pusher.key'),
                                config('broadcasting.connections.pusher.secret'),
                                config('broadcasting.connections.pusher.app_id'),
                                config('broadcasting.connections.pusher.options')
                            );
                            $pusher->trigger($channels, 'booking-request', $data);
                        }
                        DB::commit();

                        return response()->json(
                            [
                                'status' => true,
                                'message' => "booking request successfully created and send to stand manager.",
                            ],
                            200
                        );
                    }

                    if (count($totos) > 0) {
                        info("22222");
                        $channels = [];
                        // foreach ($totos as $toto) {
                        array_push($channels, 'driver-' . $totos[0]->id);
                        // }
                        if (!empty($channels)) {
                            $pusher = new Pusher(
                                config('broadcasting.connections.pusher.key'),
                                config('broadcasting.connections.pusher.secret'),
                                config('broadcasting.connections.pusher.app_id'),
                                config('broadcasting.connections.pusher.options')
                            );
                            $pusher->trigger($channels, 'booking-request', $data);
                        }
                        DB::commit();
                        return response()->json(
                            [
                                'status' => true,
                                'message' => "Booking request successfully created and send to driver",
                            ],
                            200
                        );
                    }
                } else {
                    info("444444444444444444444444444444");
                    DB::commit();
                    return response()->json(
                        [
                            'status' => false,
                            'message' => "Drivers not found!",
                        ],
                        200
                    );
                }
            } else {
                DB::commit();
                return response()->json(
                    [
                        'status' => false,
                        'message' => "Nearby stand is not found!",
                    ],
                    200
                );
            }
        } catch (Exception $e) {
            info($e);
            DB::rollback();
            return response()->json(
                [
                    'status' => false,
                    'message' => "Something went wrong!",
                ],
                200
            );
        }
    }
