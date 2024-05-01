 $list = SELF_MODEL::with([
                        'user' => function ($q) {
                            $q->select('id', 'user_type');
                        },
                    ])->where('status', $request['status'])
                        ->whereDate('booking_date', '=>', $date)
                        ->whereTime('booking_time', '=>', $time)
                        ->whereNull('bulk_driver')->latest()->paginate(10);
