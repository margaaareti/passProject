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

    toggleCards();

    formSelect.addEventListener('change', toggleCards);

});
