//Обработка ввода пользователя в поле выбора помещений. Добавление запятой после каждого пробела при вводе
var roomsInput = document.getElementById('rooms');

roomsInput.addEventListener('input', function (event) {
    var inputValue = event.target.value;
    event.target.value = inputValue.replace(/(?<=\w|\p{L})(?=\s)/gu, ',');
});
