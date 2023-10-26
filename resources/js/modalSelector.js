import 'bootstrap';

// document.addEventListener('DOMContentLoaded',()=>{
//     var modal = new bootstrap.Modal(document.getElementById('exampleModal'))
//     modal.show();
// })

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('exampleModal');
    var formSelect = document.getElementById('exampleSelect');
    var guestCard = document.getElementById('guest_card');
    var carCard = document.getElementById('car_card');

    function toggleCards(){
        guestCard.style.display = (formSelect.value==='Guests') ? 'block' : 'none'
        carCard.style.display = (formSelect.value==='Car') ? 'block' : 'none'
    }

    var form = (formSelect.value==='Guests') ? document.getElementById('form1') : document.getElementById('form2');
    var fieldsToKeep = ['department','signed_by','start_date','end_date','selected_form']; // Список полей, которые нужно сохранить

    var inputs = form.getElementsByTagName('input');
    for(var i=0; i<inputs.length; i++) {
        if (fieldsToKeep.indexOf(inputs[i].name) === -1) {
            inputs[i].value = '';
        }
    }

    var textareas = form.getElementsByTagName('textarea');
    for(var i=0; i<textareas.length; i++) {
        if (fieldsToKeep.indexOf(textareas[i].name) === -1) {
            textareas[i].value = '';
        }
    }

    toggleCards();

    formSelect.addEventListener('change', toggleCards);

});
