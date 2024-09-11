var night_charge = 0.00;
                    if ("20:59"<formattedTime) {
                        var night_charge = parseFloat(data?.data?.price?.nightCharge) ||
                            0.00; // Ensure it's a number
                    }
