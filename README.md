To handle login and logout times in MongoDB with UTC format and convert them to the Asia/Kolkata timezone using Node.js, you can follow these steps:

1. **Store Times in UTC Format:**
   Ensure that you store login and logout times in UTC format in your MongoDB database. MongoDB stores dates in UTC by default.

2. **Convert Times to Asia/Kolkata Timezone:**
   When retrieving the data or displaying it, convert the UTC times to the Asia/Kolkata timezone using the `moment-timezone` library.

Here's an example using Mongoose and the `moment-timezone` library:

```javascript
const mongoose = require('mongoose');
const moment = require('moment-timezone');

// Connect to MongoDB (replace with your connection details)
mongoose.connect('mongodb://localhost:27017/your-database', { useNewUrlParser: true, useUnifiedTopology: true });

// User schema
const userSchema = new mongoose.Schema({
  username: { type: String, required: true },
  loginTimes: [{ type: Date }],
  logoutTimes: [{ type: Date }],
});

const User = mongoose.model('User', userSchema);

// Function to calculate total duration
async function calculateTotalDuration(userId, startTime, endTime) {
  const user = await User.findById(userId);

  let totalDuration = 0;

  user.loginTimes.forEach((loginTime, index) => {
    const logoutTime = user.logoutTimes[index];

    const loginMoment = moment(loginTime).tz('Asia/Kolkata');
    const logoutMoment = moment(logoutTime).tz('Asia/Kolkata');

    // Only consider times within the specified range
    if (loginMoment.isBefore(endTime) && logoutMoment.isAfter(startTime)) {
      const withinRangeLoginTime = moment.max(loginMoment, startTime);
      const withinRangeLogoutTime = moment.min(logoutMoment, endTime);

      totalDuration += withinRangeLogoutTime.diff(withinRangeLoginTime, 'minutes');
    }
  });

  return totalDuration;
}

// Example usage
const userId = 'yourUserId';
const startTime = moment.tz('2023-01-01T09:00:00', 'Asia/Kolkata');
const endTime = moment.tz('2023-01-01T15:00:00', 'Asia/Kolkata');

const totalDuration = await calculateTotalDuration(userId, startTime, endTime);
console.log('Total Duration (minutes):', totalDuration);
```

Make sure to replace the MongoDB connection string, 'yourUserId', and the example date and time values with your actual data. This example assumes that loginTimes and logoutTimes are stored as arrays of Date objects in the User schema. Adjust the code based on your actual schema and data structure.