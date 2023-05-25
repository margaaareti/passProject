
//Добавляет дефисы при вводе номера телефона приводя его в формат x-xxx-xxx-xx-xx
$(document).ready(function () {
    var $phoneNumberInput = $('#phone_number');
    var maxDigits = 11; // Максимальное количество цифр

    $phoneNumberInput.on('input', function (e) {
        var phoneNumber = $(this).val();
        var cursorPosition = e.target.selectionStart; // Получаем текущую позицию курсора
        var originalValue = phoneNumber.replace(/\D/g, ''); // Удаление всех нецифровых символов
        var formattedNumber = formatPhoneNumber(originalValue, maxDigits);

        var diff = phoneNumber.length - formattedNumber.length; // Разница в длине до и после форматирования
        var newPosition = Math.max(0, cursorPosition - diff); // Новая позиция курсора перед обновлением значения

        $(this).val(formattedNumber);

        setCursorPosition(this, newPosition); // Восстанавливаем позицию курсора после обновления значения
    });

    $phoneNumberInput.attr('maxlength', maxDigits + 4); // Установка максимальной длины поля вместе с дефисами
});

function formatPhoneNumber(phoneNumber, maxDigits) {
    var formattedNumber = '';

    if (phoneNumber.length > 0) {
        formattedNumber += phoneNumber.substring(0, 1);
    }
    if (phoneNumber.length > 1) {
        formattedNumber += '-' + phoneNumber.substring(1, 4);
    }
    if (phoneNumber.length > 4) {
        formattedNumber += '-' + phoneNumber.substring(4, 7);
    }
    if (phoneNumber.length > 7) {
        formattedNumber += '-' + phoneNumber.substring(7, 9);
    }
    if (phoneNumber.length > 9) {
        formattedNumber += '-' + phoneNumber.substring(9, maxDigits);
    }

    return formattedNumber;
}

function setCursorPosition(input, position) {
    if (input.setSelectionRange) {
        input.focus();
        input.setSelectionRange(position, position);
    } else if (input.createTextRange) {
        var range = input.createTextRange();
        range.collapse(true);
        range.moveEnd('character', position);
        range.moveStart('character', position);
        range.select();
    }

}
