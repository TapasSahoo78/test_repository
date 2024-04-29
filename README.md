$list = SELF_MODEL::with([
                'user' => function ($q) {
                    $q->select('id', 'user_type');
                },
                'bulkBookingDriver' => function ($q) {
                    $q->where('driver_id', Auth::id());
                }
            ])->where('status', $request['status'])->whereNotNull('bulk_driver')->latest()->paginate(10);
