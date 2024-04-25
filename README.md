public function bulkDriver()
 {
   return $this->hasMany(BulkDriverBooking::class, 'booking_id');
 }

$query = SELF_MODEL::with([
            'user' => function ($q) {
                $q->select('id', 'user_type');
            },
            'bulkDriver' => function ($q) {
                $q->select('id', 'driver_id', 'booking_id', 'amount', 'status');
            }
]);
if (isset($request['booking_type']) && $request['booking_type'] == 2) {
            $query->whereNotNull('bulk_driver');
            $query->whereHas('bulkDriver', function ($q) {
                $q->where('driver_id', '!=', Auth::id());
            });
 }
$query = $query->latest()->paginate(10);
