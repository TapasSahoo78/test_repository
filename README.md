        const surgeChargeAllFetch = await SurgeOrder.findOne({ slug: 'raining', isActive: true }).select('id').exec();
        const rainSurgeId = surgeChargeAllFetch?._id;
        const rainSurgeAmount = await ZoneSurgeChargeModel.findOne({
            service_zone_id: serviceZone?.serviceZoneId,
            surge_id: rainSurgeId,
            surge_timestamp: {
                $gte: todayStart,
                $lte: todayEnd,
            },
            status: true
        }).select('surge_amount').populate('surge_id', 'title').exec();

        const otherSurgeAmount = await ZoneSurgeChargeModel.find({
            service_zone_id: serviceZone?.serviceZoneId,
            surge_id: { $ne: rainSurgeId },
            surge_timestamp: {
                $gte: todayStart,
                $lte: todayEnd,
            },
            status: true,
        }).select('surge_amount').populate('surge_id', 'title')
            .exec()
            .then((surges) => surges.reduce((sum, surge) => sum + surge.surge_amount, 0));
