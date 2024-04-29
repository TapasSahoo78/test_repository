If `$item->bulkBookingDriver` is an array type, the error occurs because the `array_filter` function expects the input to be an array of objects. 

To resolve this issue, you need to modify the filtering condition to handle the case where `$item->bulkBookingDriver` is an array. For example, you might want to check if the array is empty or if it contains specific values. Here's how you can modify the code to handle an array type:

```php
// Check if $list is an array before filtering
if (is_array($list)) {
    // Filter the array to include only items where bulkBookingDriver is null or is an empty array
    $unMatchedDriver = array_filter($list, function ($item) {
        return is_object($item) && (empty($item->bulkBookingDriver) || $item->bulkBookingDriver === null);
    });
    return $unMatchedDriver;
} else {
    return []; // or handle the case where $list is not an array
}
```

In this modification, the filtering condition checks if `$item->bulkBookingDriver` is either null or an empty array, in addition to ensuring that `$item` is an object. This should prevent the "Argument 1 must be array" error when dealing with array-type `bulkBookingDriver`.