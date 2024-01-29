const express = require('express');
const app = express();
const port = 3000;

// Middleware to parse JSON bodies
app.use(express.json());

// Middleware that is only executed for requests to "/order/webhook"
// app.use('/order/webhook', (req, res, next) => {
app.use(function (req, res, next) {
    let oldWrite = res.write
    let oldEnd = res.end

    let chunks = [];

    res.write = function (chunk) {
        chunks.push(chunk);
        return oldWrite.apply(res, arguments);
    };

    res.end = function (chunk) {
        if (chunk)
            chunks.push(chunk);
        var body = Buffer.concat(chunks).toString('utf8');
        // console.log(req, body);
        console.log(req.body);
        // var body = Buffer.concat(chunks).toString('utf8');
        // console.log(req, body);
        // updateapilog(req, body)
        oldEnd.apply(res, arguments);
    };
    next();
});


// Endpoint to handle incoming order status change webhooks
app.post('/order/webhook', (req, res) => {
    const {
        orderID,
        status
    } = req.body;

    req.body.event = "Order Update";
    req.body.eventId = orderID;
    req.body.order = "test";

    // Your logic here
    res.status(200).send('Webhook received successfully');
});



app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
