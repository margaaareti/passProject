var textarea = document.getElementById('guests');

textarea.addEventListener('focus', function() {
    this.style.transform = 'scale(1.01)';
});

textarea.addEventListener('input', function() {
    var maxHeight = 400; // Максимальная высота textarea (в пикселях)
    this.style.height = 'auto';
    this.style.height = (Math.min(this.scrollHeight, maxHeight) + 2) + 'px'; // +2 пикселя для учета паддинга
});

textarea.addEventListener('blur', function() {
    this.style.transform = 'scale(1)';
});


