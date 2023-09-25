//Выпадающий список с выбором объектов
$(document).ready(function () {
    var $objectSelectCar = $('#object');

    $objectSelectCar.select2({
        closeOnSelect: false,
        dropdownParent: $('body')
    });


    $objectSelectCar.on('select2:close', function () {
        $(this).select2('close');
    });


    $objectSelectCar.on('select2:open', function () {
        var $dropdown = $('.select2-dropdown');
        if ($dropdown.find('.select2-close-btn').length === 0) {
            $dropdown.append('<button class="select2-close-btn">Закрыть</button>');
        }
    });


    $(document).on('click', '.select2-close-btn', function () {
        $('#object').select2('close');
    });


    $(document).ready(function () {
        $('#object').on('change', function () {
            var selectedValues = $(this).val();
            console.log(selectedValues);
        });
    });

});
