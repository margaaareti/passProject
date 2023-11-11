document.querySelectorAll('form[data-target]').forEach(form => {
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Обновляем CSRF-токен в каждой форме
        form.querySelector('input[name="_token"]').value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const modalId = this.getAttribute('data-target');
        const modalData = document.getElementById(modalId).querySelector('#modalData');
        const formData = new FormData(this);
        modalData.innerHTML = '';

        // Определите, какие поля вы хотите пропустить
        const fieldsToSkip = ['Checkbox1', 'Checkbox2', '_token'];

        formData.forEach((value, key) => {
            // Проверяем, нужно ли пропустить это поле
            if (value !== '' && !fieldsToSkip.includes(key)) {
                const dataItem = document.createElement('div');
                // Здесь мы используем labels, чтобы привести поля к нужному виду
                const label = document.querySelector(`label[for="${key}"]`);
                if (label) {
                    const labelText = label.textContent.trim();
                    const labelElement = document.createElement('span');
                    labelElement.textContent = labelText;
                    labelElement.style.fontWeight = 'bold';
                    // Добавляем значение
                    dataItem.appendChild(labelElement);
                    dataItem.innerHTML += ` ${value}`;
                    modalData.appendChild(dataItem);
                }
            }
        });

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
