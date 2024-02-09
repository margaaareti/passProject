import 'bootstrap';

// document.addEventListener('DOMContentLoaded',()=>{
//     var modal = new bootstrap.Modal(document.getElementById('exampleModal'))
//     modal.show();
// })

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('exampleModal');
    const formSelect = document.getElementById('exampleSelect');
    const guestCard = document.getElementById('guest_card');
    const carCard = document.getElementById('car_card');
    const propertyCard = document.getElementById('property_card')
    const errorAlerts = document.querySelectorAll('.alert-danger');

    //Скрываем окно с ошибкой после вызова
    function hideErrorAlerts() {
        errorAlerts.forEach(alert => {
            alert.style.display = 'none';
        });
    }

    formSelect.addEventListener('change', function (event){
        hideErrorAlerts()
    })

    function toggleCards(){
        guestCard.style.display = (formSelect.value==='Guests') ? 'block' : 'none'
        carCard.style.display = (formSelect.value==='Car') ? 'block' : 'none'
        propertyCard.style.display = (formSelect.value==='Property') ? 'block' : 'none'
    }

    if(formSelect) {
        let i;
        const form = (formSelect.value === 'Guests') ? document.getElementById('form1') : document.getElementById('form2');
        const fieldsToKeep = ['department', 'signed_by', 'start_date', 'end_date', 'selected_form']; // Список полей, которые нужно сохранить

        const inputs = form.getElementsByTagName('input');
        for (i = 0; i < inputs.length; i++) {
            if (fieldsToKeep.indexOf(inputs[i].name) === -1) {
                inputs[i].value = '';
            }
        }

        const textareas = form.getElementsByTagName('textarea');
        for (i = 0; i < textareas.length; i++) {
            if (fieldsToKeep.indexOf(textareas[i].name) === -1) {
                textareas[i].value = '';
            }
        }

        toggleCards();

        formSelect.addEventListener('change', toggleCards);
    }

});
