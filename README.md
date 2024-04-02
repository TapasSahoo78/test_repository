const allSurgeAmount = await ZoneSurgeChargeModel.find({
                service_zone_id: serviceZone?.serviceZoneId,
                surge_timestamp: {
                    $gte: todayStart,
                    $lte: todayEnd,
                },
                status: true
            }).select('surge_amount').populate('surge_id', 'title').exec();

            allSurgeAmount.forEach(function (key, val) {
                await OrderSurgeModel.create({
                    order_id: results?.order_id,
                    title: val.surge_id.title
                });
            });
