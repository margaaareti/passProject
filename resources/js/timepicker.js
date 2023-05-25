$('#time_start, #time_end').timepicker({
    timeFormat: 'HH:mm',
    interval: 60,
    minTime: '00:00',
    maxTime: '23:59',
    dynamic: true,
    dropdown: true,
    scrollbar: true,
    range: true,
    //startTime: '08:00',
    // endTime: '22:00',
    // defaultTime: '08:00',
    // defaultValue: '08:00-09:00',
});
