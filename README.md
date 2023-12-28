
Sure, to consider a specific date in the Asia/Kolkata time zone, you can adjust the code as follows:

```javascript
const moment = require('moment-timezone');

// Assuming you have the User model and middleware from the previous examples...

// Custom function to calculate total login and logout duration for a specific date and time zone
function calculateDailyTime(userId, date, startTime, endTime, timeZone) {
  const startOfDay = moment.tz(date, timeZone).startOf('day'); // Start of the specified date in the specified time zone
  const endOfDay = moment.tz(date, timeZone).endOf('day'); // End of the specified date in the specified time zone

  // Retrieve user information
  const user = await User.findById(userId);

  // Filter login and logout times for the specified date
  const dailyLoginTimes = user.loginTimes.filter(time => isSameDay(time, startOfDay));
  const dailyLogoutTimes = user.logoutTimes.filter(time => isSameDay(time, startOfDay));

  // Calculate total login and logout duration
  const totalLoginDuration = calculateTotalDuration(
    dailyLoginTimes,
    dailyLogoutTimes,
    endOfDay,
    moment.duration(startTime), // Convert to duration
    moment.duration(endTime)    // Convert to duration
  );

  return {
    date: startOfDay.format('YYYY-MM-DD'),
    totalLoginDuration: totalLoginDuration,
  };
}

// Example usage
const userId = 'yourUserId';
const specificDate = '2023-01-01'; // Replace with your specific date
const startTime = { hours: 10, minutes: 0 }; // 10:00 a.m.
const endTime = { hours: 17, minutes: 0 };   // 5:00 p.m.
const timeZone = 'Asia/Kolkata'; // Replace with your desired time zone

const dailyTimeInfo = calculateDailyTime(userId, specificDate, startTime, endTime, timeZone);
console.log(dailyTimeInfo);

function isSameDay(date1, date2) {
  return moment(date1).isSame(date2, 'day');
}

function calculateTotalDuration(loginTimes, logoutTimes, endOfDay, startTime, endTime) {
  let totalDuration = 0;

  loginTimes.forEach((loginTime, index) => {
    const logoutTime = logoutTimes[index] || endOfDay;

    const loginMoment = moment(loginTime);
    const logoutMoment = moment(logoutTime);

    // Only consider times within the specified range
    if (loginMoment.isBefore(endTime) && logoutMoment.isAfter(startTime)) {
      const withinRangeLoginTime = moment.max(loginMoment, startTime);
      const withinRangeLogoutTime = moment.min(logoutMoment, endTime);

      totalDuration += withinRangeLogoutTime.diff(withinRangeLoginTime, 'minutes');
    }
  });

  return totalDuration;
}
```

This example uses the `moment-timezone` library to work with time zones. Replace `'2023-01-01'` with your desired specific date, and adjust the `timeZone` variable accordingly.