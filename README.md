$list = SELF_MODEL::with(['user' => function ($q) {
    $q->select('id', 'user_type');
}])->where('status', $request['status'])
  ->whereDate('booking_date', $request['booking_date'])
  ->where(function ($query) {
      $query->whereNull('bulk_driver')
            ->orWhereHas('user', function ($q) {
                $q->where('user_type', 'online');
            });
  })
  ->when($request['bulk_driver'], function ($query) use ($request) {
      // If bulk_driver is provided, check if it exists in the relationship
      return $query->whereHas('bulkDriver', function ($q) use ($request) {
          $q->where('id', $request['bulk_driver']);
      });
  })
  ->latest()
  ->paginate(10);