import './bootstrap';
import { library, dom } from '@fortawesome/fontawesome-free';
import { faInfoCircle } from '@fortawesome/free-solid-svg-icons';

library.add(faInfoCircle);
dom.watch();


//Обработка ввода пользователя в поле выбора помещений. Добавление запятой после каждого пробела при вводе
var roomsInput = document.getElementById('rooms');

roomsInput.addEventListener('input', function (event) {
    var inputValue = event.target.value;
    event.target.value = inputValue.replace(/(?<=\w|\p{L})(?=\s)/gu, ',');
});








