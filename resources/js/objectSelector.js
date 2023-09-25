//Выпадающий список с выбором объектов
$(document).ready(function () {
    $('.object-select').each(function() {
        var $objectSelect = $(this);

        $objectSelect.select2({
            closeOnSelect: false,
            dropdownParent: $('body')
        });

        $objectSelect.on('select2:close', function () {
            $(this).select2('close');
        });

        $objectSelect.on('select2:open', function () {
            var $dropdown = $('.select2-dropdown');
            if ($dropdown.find('.select2-close-btn').length === 0) {
                $dropdown.append('<button class="select2-close-btn">Закрыть</button>');
            }
        });

        $(document).on('click', '.select2-close-btn', function () {
            $objectSelect.select2('close');
        });

        $objectSelect.on('change', function () {
            var selectedValues = $(this).val();
            console.log(selectedValues);
        });
    });
});
