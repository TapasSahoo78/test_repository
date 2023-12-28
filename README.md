function calculateTotalDuration(loginTimes, logoutTimes, endOfDay, startTime, endTime) {
    let totalDuration = 0;
    totalDuration += 10;
    loginTimes.forEach((loginTime, index) => {
        console.log("loginTime-------------------------",loginTime);
        const logoutTime = logoutTimes[index] || endOfDay;

        const loginMoment = moment(loginTime);
        const logoutMoment = moment(logoutTime);

        //Only consider times within the specified range
        if (loginMoment.isBefore(endTime) && logoutMoment.isAfter(startTime)) {
            const withinRangeLoginTime = moment.max(loginMoment, startTime);
            const withinRangeLogoutTime = moment.min(logoutMoment, endTime);

            console.log(withinRangeLogoutTime + '|' + withinRangeLoginTime);

        totalDuration += withinRangeLogoutTime.diff(withinRangeLoginTime, 'minutes');

        }
    });

    return totalDuration;
}
