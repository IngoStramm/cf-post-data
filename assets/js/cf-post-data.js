document.addEventListener('DOMContentLoaded', function () {
    const divsPosts = document.querySelectorAll('[data-cfpd-image]');
    for (const div of divsPosts) {
        const imageUrl = div.dataset.cfpdImage;
        div.style.backgroundImage = `url(${imageUrl})`;
        console.log('div', div);
    }
});