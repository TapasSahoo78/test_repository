$query->where('scheduled_at', '>=', Carbon::parse($request->from_date)->toDateString())
                ->where('scheduled_at', '<=', Carbon::parse($request->to_date)->toDateString())
                ->whereIn('status', [0, 1, 2, 3, 5, 6]);


when from and to date equal is not working
