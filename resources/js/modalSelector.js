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

    if (formSelect.value === 'Guests') {
        guestCard.style.display = 'block';
        carCard.style.display = 'none';
    } else if (formSelect.value === 'Car') {
        guestCard.style.display = 'none';
        carCard.style.display = 'block';
    }


    formSelect.addEventListener('change', function() {
        if (formSelect.value === 'Guests') {
            guestCard.style.display = 'block';
            carCard.style.display = 'none';
        } else if (formSelect.value === 'Car') {
            guestCard.style.display = 'none';
            carCard.style.display = 'block';
        }

    });

});
