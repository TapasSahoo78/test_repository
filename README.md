$list = SELF_MODEL::with([
                'user' => function ($q) {
                    $q->select('id', 'user_type');
                }
            ])->where('status', $request['status'])->whereDate('booking_date', $request['booking_date'])->latest()->paginate(10);
