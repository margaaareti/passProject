import '@fortawesome/fontawesome-free/css/all.css';



const tooltipIcons = document.querySelectorAll('.tooltip-icon');

tooltipIcons.forEach(icon => {
    icon.addEventListener('mouseover', () => {
        const tooltipText = icon.querySelector('.tooltip-text');
        if (tooltipText) {
            tooltipText.style.left = `${icon.offsetWidth}px`;
        }
    });
});
