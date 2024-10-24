const deviceToken = rider.deviceToken;
const bookingId = "12345"; // Replace with the actual booking ID

try {
  const response = await sendNotification(
    deviceToken,
    'New Booking Alert',
    `New booking alert! Booking ID: ${bookingId} has been assigned to you. Please review the details and proceed.`
  );
  console.log('Notification sent successfully:', response);
} catch (error) {
  console.error('Error sending notification:', error);
}