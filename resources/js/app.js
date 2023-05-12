import './bootstrap';

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


$(document).ready(function() {
    var $objectSelect = $('#object');

    $objectSelect.select2({
        closeOnSelect: false,
        dropdownParent: $('body')
    });


    $objectSelect.on('select2:close', function() {
        $(this).select2('close');
    });


    $objectSelect.on('select2:open', function() {
        var $dropdown = $('.select2-dropdown');
        if ($dropdown.find('.select2-close-btn').length === 0) {
            $dropdown.append('<button class="select2-close-btn">Закрыть</button>');
        }
    });


    $(document).on('click', '.select2-close-btn', function() {
        $('#object').select2('close');
    });

    $(document).ready(function() {
        $('#object').on('change', function() {
            var selectedValues = $(this).val();
            console.log(selectedValues);
        });
    });

});






