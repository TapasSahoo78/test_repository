// Create a new Date object and set the timezone to "Asia/Kolkata"
let timeInKolkata = new Date().toLocaleString("en-US", { timeZone: "Asia/Kolkata" });

// Convert to Date object
let currentDate = new Date(timeInKolkata);

// Add 2 hours to the time
currentDate.setHours(currentDate.getHours() + 2);

// Format the result back to time in "HH:mm" format
let formattedTime = currentDate.toLocaleTimeString("en-GB", {
    hour: '2-digit',
    minute: '2-digit',
    timeZone: 'Asia/Kolkata'
});

console.log(formattedTime); // Outputs the time with 2 hours added