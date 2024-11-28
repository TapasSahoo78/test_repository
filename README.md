To implement the functionality where a user can go back to the previous page with the same pagination number in Laravel, follow these steps:

1. Pass the Current Page in the URL:

When navigating to the details page, pass the current page number as a query parameter:

In the Booking List View:

<a href="{{ route('booking.details', ['id' => $booking->id, 'page' => request('page')]) }}">View Details</a>

2. Modify the Route:

Ensure your route is set up to accept query parameters.

In web.php:

Route::get('/booking/details/{id}', [BookingController::class, 'show'])->name('booking.details');

3. Handle the Page Parameter in the Controller:

In BookingController:

public function show($id)
{
    $booking = Booking::findOrFail($id);
    $page = request('page', 1); // Default to page 1 if not provided

    return view('booking.details', compact('booking', 'page'));
}

4. Set the Back Button to Redirect to the Previous Page:

In the Booking Details View:

<a href="{{ route('bookings.index', ['page' => $page]) }}">Back to List</a>

5. Maintain Pagination in the Index Method (Optional):

In BookingController:

public function index()
{
    $bookings = Booking::paginate(10); // Adjust the per-page number as needed

    return view('bookings.index', compact('bookings'));
}


---

Final Flow:

When a user clicks View Details, the page parameter is passed to the details route.

The Back to List button redirects back to the booking list with the same pagination.


This way, the pagination state will be preserved when navigating back to the list.

