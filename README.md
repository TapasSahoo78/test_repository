                $booking = Booking::where([
                    'id' => $request->booking_id,
                    // 'status' => 1
                ])->lockForUpdate()->first();

if ($request->status == 2 || $request->status == 11) {
                    // if ($booking?->status != 1) {
                    //     return $this->apiResponseJson(false, 200, 'Already Accepted other driver!', (object) []);
                    // }
                    $testCheck = BulkDriverBooking::where(['booking_id' => $request->booking_id, 'driver_id' => Auth::id()])->whereNotIn('status', [4])->lockForUpdate()->exists();
                    if (!$testCheck) {
                        if ($booking && isset($booking->bulk_driver) && !empty($booking->bulk_driver)) {
                            $bulkCount = BulkDriverBooking::where('booking_id', $request->booking_id)
                                ->whereNotIn('status', [1, 4, 10])
                                ->lockForUpdate()
                                ->count();

                            if ($booking->bulk_driver <= $bulkCount) {
                                return $this->apiResponseJson(false, 200, 'Already accepted ' . $booking->bulk_driver . ' driver(s). It is not available now!', (object) []);
                            }
                        }
                    }
                }
