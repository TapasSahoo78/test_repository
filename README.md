To achieve an automatic call to the GET webhook endpoint when a POST API is called, you can use a function to trigger the GET request within the POST route handler. Here's an example:

```javascript
const express = require('express');
const { v4: uuidv4 } = require('uuid');
const { MongoClient } = require('mongodb');
const fetch = require('node-fetch');

const app = express();
const PORT = 3000;

// MongoDB connection URI (replace with your MongoDB connection string)
const mongoURI = 'mongodb://localhost:27017/your-database-name';

// Generate a unique ID
const uniqueId = uuidv4();

// Middleware to parse JSON bodies
app.use(express.json());

// Handle incoming order status updates (POST)
app.post('/order-status-update', async (req, res) => {
  try {
    // Generate an event ID and event name
    const eventId = uuidv4();
    const eventName = `OrderStatusUpdate_${req.body.status}_${eventId}`;

    // Connect to MongoDB
    const client = new MongoClient(mongoURI, { useNewUrlParser: true, useUnifiedTopology: true });
    await client.connect();

    // Access the database and collection
    const database = client.db('your-database-name');
    const collection = database.collection('orderStatusUpdates');

    // Store the order status update, event ID, and event name in the database
    const orderStatusUpdate = {
      uniqueId,
      eventId,
      eventName,
      status: req.body.status,
      orderId: req.body.orderId,
      timestamp: new Date(),
    };

    await collection.insertOne(orderStatusUpdate);

    // Trigger a GET request to retrieve and display the updated order status
    await triggerOrderStatusGet(orderStatusUpdate.orderId);

    // Close the MongoDB connection
    await client.close();

    console.log('Order status update stored in the database:', orderStatusUpdate);

    res.status(200).send('Order status update received and stored');
  } catch (error) {
    console.error('Error storing order status update:', error);
    res.status(500).send('Internal Server Error');
  }
});

// Retrieve order status updates for a specific order (GET)
app.get('/order-status/:orderId', async (req, res) => {
  try {
    const orderId = req.params.orderId;

    // Connect to MongoDB
    const client = new MongoClient(mongoURI, { useNewUrlParser: true, useUnifiedTopology: true });
    await client.connect();

    // Access the database and collection
    const database = client.db('your-database-name');
    const collection = database.collection('orderStatusUpdates');

    // Retrieve order status updates for the specified order ID
    const orderStatusUpdates = await collection.find({ orderId }).toArray();

    // Close the MongoDB connection
    await client.close();

    res.json({ orderId, orderStatusUpdates });
  } catch (error) {
    console.error('Error retrieving order status updates:', error);
    res.status(500).send('Internal Server Error');
  }
});

// Function to trigger the order status GET webhook
async function triggerOrderStatusGet(orderId) {
  const webhookUrl = `http://localhost:${PORT}/order-status/${orderId}`; // Replace with your actual webhook URL

  try {
    // Send a GET request to the webhook URL
    await fetch(webhookUrl, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    console.log('Order status GET webhook triggered successfully');
  } catch (error) {
    console.error('Error triggering order status GET webhook:', error);
  }
}

app.listen(PORT, () => {
  console.log(`Server running at http://localhost:${PORT}`);
  console.log(`Webhook URL (Update): http://localhost:${PORT}/order-status-update`);
  console.log(`Webhook URL (Get): http://localhost:${PORT}/order-status/:orderId`);
  console.log(`Unique ID: ${uniqueId}`);
});
```

In this example, the `triggerOrderStatusGet` function is invoked within the `/order-status-update` route handler after storing the order status update. This function triggers the GET request to the `/order-status/:orderId` endpoint, effectively fetching and displaying the updated order status.










Assuming your `LoginTimes` and `LogoutTimes` are arrays of timestamps in MongoDB, you can use the MongoDB aggregation framework to find all login and logout history for a user between 9:00 and 15:00 on the date 29-12-2023. Here's an example using the MongoDB Node.js driver:

```javascript
const MongoClient = require('mongodb').MongoClient;

const uri = 'your_mongodb_connection_string';
const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true });

client.connect(async err => {
  if (err) {
    console.error('Error connecting to MongoDB:', err);
    return;
  }

  const db = client.db('your_database_name');
  const collection = db.collection('your_collection_name');

  const userId = 'user_id'; // Replace with the actual user ID
  const targetDate = new Date('2023-12-29');
  const startTime = new Date('2023-12-29T09:00:00.000Z');
  const endTime = new Date('2023-12-29T15:00:00.000Z');

  try {
    const result = await collection.aggregate([
      {
        $match: {
          userId: userId,
          $expr: {
            $and: [
              { $gte: ['$LoginTimes', startTime] },
              { $lt: ['$LoginTimes', endTime] },
              { $gte: ['$LogoutTimes', startTime] },
              { $lt: ['$LogoutTimes', endTime] }
            ]
          }
        }
      }
    ]).toArray();

    if (result.length > 0) {
      console.log('User login and logout history between 9:00 and 15:00 on 29-12-2023:', result);
    } else {
      console.log('No records found for the specified date and time range.');
    }
  } catch (error) {
    console.error('Error querying MongoDB:', error);
  } finally {
    client.close();
  }
});
```

Make sure to replace placeholders like `'your_mongodb_connection_string'`, `'your_database_name'`, `'your_collection_name'`, and `'user_id'` with your actual MongoDB connection details, database name, collection name, and the user ID you're interested in.

This example uses the `$match` stage in the aggregation pipeline to filter documents based on the user ID and the conditions for login and logout times within the specified range. Adjust the field names according to your data structure.






I apologize for any confusion. It seems I made an error in the query. Assuming that `LoginTimes` and `LogoutTimes` are arrays of timestamps, you should use the `$elemMatch` operator within the `$and` expression. Here's the corrected example:

```javascript
const result = await collection.aggregate([
  {
    $match: {
      userId: userId,
      $expr: {
        $and: [
          {
            $elemMatch: {
              $gte: ['$LoginTimes', startTime],
              $lt: ['$LoginTimes', endTime]
            }
          },
          {
            $elemMatch: {
              $gte: ['$LogoutTimes', startTime],
              $lt: ['$LogoutTimes', endTime]
            }
          }
        ]
      }
    }
  }
]).toArray();
```

This corrected query uses `$elemMatch` to match elements within the arrays that satisfy the specified conditions.

Please replace the placeholder values ('your_mongodb_connection_string', 'your_database_name', 'your_collection_name', and 'user_id') with your actual MongoDB connection details, database name, collection name, and the user ID you're interested in. Adjust the field names according to your data structure.

If you encounter any further issues or have additional details about your data structure, feel free to share, and I'll do my best to assist you.