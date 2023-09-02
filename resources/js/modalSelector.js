import 'bootstrap';

// document.addEventListener('DOMContentLoaded',()=>{
//     var modal = new bootstrap.Modal(document.getElementById('exampleModal'))
//     modal.show();
// })


document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('exampleModal');
    var formSelect = document.getElementById('exampleSelect');
    var guestForm = document.getElementById('guest_form');
    var carForm = document.getElementById('car_form');

    if (formSelect.value === 'Guests') {
        guestForm.style.display = 'block';
        carForm.style.display = 'none';
    } else if (formSelect.value === 'Car') {
        guestForm.style.display = 'none';
        carForm.style.display = 'block';
    }


    formSelect.addEventListener('change', function() {
        if (formSelect.value === 'Guests') {
            guestForm.style.display = 'block';
            carForm.style.display = 'none';
        } else if (formSelect.value === 'Car') {
            guestForm.style.display = 'none';
            carForm.style.display = 'block';
        }

    });

    var modalSubmit = document.getElementById('modalSubmit');
    modalSubmit.addEventListener('click', function() {
        modal.style.display = 'none';
    });
});
