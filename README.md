const deviceToken = rider.deviceToken;
      const response = await sendNotification(
        deviceToken,
        'New Booking Alert',
        `New booking alert! Booking ID: ${bookingId} has been assigned to you. Please review the details and proceed.`
      );
      console.log('Notification sent:', response);
