To calculate the distance between two points using their geographical coordinates (latitude and longitude) in Laravel, you can use the Haversine formula. This formula accounts for the Earth's curvature and is often used in geolocation calculations.

Here's a basic example of how you can implement this in Laravel:

1. **Create a function to calculate the distance:**

```php
function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
    // Convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
      cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return $angle * $earthRadius;
}
```

2. **Usage:**

To use this function, you need to pass the latitude and longitude of the two points you want to calculate the distance between:

```php
$latitudeFrom = 40.7128;  // New York City
$longitudeFrom = -74.0060;
$latitudeTo = 34.0522;    // Los Angeles
$longitudeTo = -118.2437;

$distance = haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo);

echo "Distance: " . $distance . " meters";
```

This will calculate the distance in meters. You can change the `$earthRadius` parameter to 6371 to get the distance in kilometers.

### Using Eloquent and Raw SQL

If you're working with a database and Eloquent, you can use raw SQL to calculate distances directly in your queries. Here's an example:

```php
use Illuminate\Support\Facades\DB;

$latitude = 40.7128;
$longitude = -74.0060;
$radius = 10000; // Radius in meters

$nearbyLocations = DB::table('locations')
    ->select('locations.*', DB::raw("(
        6371000 * acos(cos(radians($latitude)) 
        * cos(radians(locations.latitude)) 
        * cos(radians(locations.longitude) - radians($longitude)) 
        + sin(radians($latitude)) 
        * sin(radians(locations.latitude)))
    ) AS distance"))
    ->having('distance', '<', $radius)
    ->orderBy('distance')
    ->get();
```

This query selects locations within a certain radius (in meters) from a specified point, ordered by distance. The `locations` table should have `latitude` and `longitude` columns.

This approach is efficient for finding nearby locations and is often used in applications like location-based services or delivery apps.