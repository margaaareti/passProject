function showAllGuests(button) {
    const list = button.parentElement.querySelector('.card-body__list');
    const listItems = list.querySelectorAll('li');

    for (let i = 2; i < listItems.length; i++) {
        listItems[i].classList.toggle('hidden'); // Переключаем класс "hidden" у всех элементов списка начиная с 2-го элемента
    }

    if (button.innerText === 'Скрыть всех') {
        button.innerText = 'Показать всех';
    } else {
        button.innerText = 'Скрыть всех';
    }
}
