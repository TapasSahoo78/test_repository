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