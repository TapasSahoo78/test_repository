Relationship laravel -
public function bulkBookingDriver()
    {
        return $this->hasMany(BulkDriverBooking::class, 'booking_id');
    }
Query -
$list = SELF_MODEL::with([
                'user' => function ($q) {
                    $q->select('id', 'user_type');
                },
                'bulkBookingDriver' => function ($q) {
                    $q->where('driver_id', Auth::id());
                }
            ])->whereNotNull('bulk_driver')->whereDate('booking_date', $request['booking_date'])->has('bulkBookingDriver')->latest()->paginate(20);
