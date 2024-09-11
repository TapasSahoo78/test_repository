var night_charge = 0.00;
let [hour, minute] = formattedTime.split(":");

// Check if the time is greater than or equal to 21:00 (9:00 PM)
if (parseInt(hour) > 20 || (parseInt(hour) === 20 && parseInt(minute) >= 59)) {
    night_charge = parseFloat(data?.data?.price?.nightCharge) || 0.00; // Ensure it's a number
}