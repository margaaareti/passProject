document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const modalId = this.getAttribute('data-target');
        const modalData = document.getElementById(modalId).querySelector('#modalData');
        const formData = new FormData(this);
        modalData.innerHTML = '';

        // Определите, какие поля вы хотите пропустить
        const fieldsToSkip = ['Checkbox1', 'Checkbox2', '_token'];

        formData.forEach((value, key) => {
            // Проверяем, нужно ли пропустить это поле
            if (value !=='' && !fieldsToSkip.includes(key)) {
                const dataItem = document.createElement('div');
                // Здесь мы используем labels, чтобы привести поля к нужному виду
                const label = document.querySelector(`label[for="${key}"]`);
                if (label) {
                    const labelText = label.textContent.trim();
                    dataItem.innerText = `${labelText} ${value}`;
                    modalData.appendChild(dataItem);
                }
            }
        });

        const confirmButton = document.getElementById('confirmButton');
        confirmButton.dataset.targetForm = this.id;
        const myModal = new bootstrap.Modal(document.getElementById(modalId));

        const selectedTypeElement = document.getElementById('exampleSelect');
        const selectedText = selectedTypeElement.options[selectedTypeElement.selectedIndex].text;
        document.getElementById('applicationType').innerText = `Тип заявки: ${selectedText}`;


        myModal.show();

        document.getElementById('confirmButton').addEventListener('click', function() {
            const targetFormId = this.dataset.targetForm;
            const targetForm = document.getElementById(targetFormId);
            targetForm.submit();
        });
    });
});
