document.querySelectorAll('form[data-target]').forEach(form => {
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Обновляем CSRF-токен в каждой форме
        form.querySelector('input[name="_token"]').value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const modalId = this.getAttribute('data-target');

        const modalData = document.getElementById(modalId).querySelector('#modalData');
        modalData.innerHTML = '';

        const formData = new FormData(this);
        const guestsValue = formData.get('guests');
        // const carsValue = formData.get('cars');

        // Определяем, какие поля надо пропустить
        const fieldsToSkip = ['Checkbox1', 'Checkbox2', '_token', 'guests'];

        formData.forEach((value, key) => {
            // Проверяем, нужно ли пропустить это поле
            if (value !== '' && !fieldsToSkip.includes(key)) {
                const label = document.querySelector(`label[for="${key}"]`);
                if (label) {
                    const labelText = label.textContent.trim();
                    const dataItem = document.createElement('div');
                    dataItem.textContent = `${labelText} ${value}`;
                    modalData.appendChild(dataItem);
                }
            }
        });

        // Добавляем гостей в отдельном элементе с переносом строки
        if (guestsValue) {
            const guestsItem = document.createElement('div');
            guestsItem.style.whiteSpace = 'pre-line';
            guestsItem.textContent = `Гости: ${guestsValue.replace(/\n/g, ', ')}`;
            modalData.appendChild(guestsItem);
        }

        const confirmButton = document.getElementById('confirmButton');
        confirmButton.dataset.targetForm = this.id;
        const myModal = new bootstrap.Modal(document.getElementById(modalId));

        const selectedTypeElement = document.getElementById('exampleSelect');
        const selectedText = selectedTypeElement.options[selectedTypeElement.selectedIndex].text;
        document.getElementById('applicationType').innerText = `${selectedText}`;

        myModal.show();

        document.getElementById('confirmButton').addEventListener('click', function () {
            const targetFormId = this.dataset.targetForm;
            const targetForm = document.getElementById(targetFormId);
            targetForm.submit();
        });
    });
});
