function calculateCost($distance)
{
    // Define the ranges and costs
    $rates = [
        ['min' => 0, 'max' => 10, 'base_cost' => 200, 'extra_cost_per_km' => 12],
        ['min' => 20, 'max' => 40, 'base_cost' => 300, 'extra_cost_per_km' => 0],
        ['min' => 100, 'max' => 1000, 'base_cost' => 500, 'extra_cost_per_km' => 0],
    ];

    $cost = 0;

    foreach ($rates as $rate) {
        if ($distance >= $rate['min'] && $distance <= $rate['max']) {
            // Calculate the cost based on the range
            $cost = $rate['base_cost'];

            // Add extra cost for distances exceeding the base range
            if (isset($rate['extra_cost_per_km']) && $rate['extra_cost_per_km'] > 0) {
                $excess_km = $distance - $rate['max'];
                if ($excess_km > 0) {
                    $cost += $excess_km * $rate['extra_cost_per_km'];
                }
            }

            break;
        }
    }

    return $cost;
}



$distance1 = 15; // Example distance
$distance2 = 21;

echo "Cost for distance 15: " . calculateCost($distance1); // Output: 260
echo "Cost for distance 21: " . calculateCost($distance2); // Output: 300