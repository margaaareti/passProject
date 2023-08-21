import 'bootstrap';

document.addEventListener('DOMContentLoaded',()=>{
    var modal = new bootstrap.Modal(document.getElementById('exampleModal'))
    modal.show();
})


document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('exampleModal');
    var formSelect = document.getElementById('exampleSelect');
    var form1 = document.getElementById('form1');
    var form2 = document.getElementById('form2');

    formSelect.addEventListener('change', function() {
        if (formSelect.value === 'Guests') {
            form1.style.display = 'block';
            form2.style.display = 'none';
        } else if (formSelect.value === 'Car') {
            form1.style.display = 'none';
            form2.style.display = 'block';
        }
    });

    var modalSubmit = document.getElementById('modalSubmit');
    modalSubmit.addEventListener('click', function() {
        modal.style.display = 'none';
    });
});
