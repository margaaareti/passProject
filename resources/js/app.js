import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';

//Обработка ввода пользователя в поле выбора помещений. Добавление запятой после каждого пробела при вводе
var roomsInput = document.getElementById('rooms');

roomsInput.addEventListener('input', function (event) {
    var inputValue = event.target.value;
    event.target.value = inputValue.replace(/(?<=\w|\p{L})(?=\s)/gu, ',');
});

const tooltipIcons = document.querySelectorAll('.tooltip-icon');

tooltipIcons.forEach(icon => {
    icon.addEventListener('mouseover', () => {
        const tooltipText = icon.querySelector('.tooltip-text');
        if (tooltipText) {
            tooltipText.style.left = `${icon.offsetWidth}px`;
        }
    });
});








