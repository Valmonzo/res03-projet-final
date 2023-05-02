function LogoTranslate() {
    const triggerBottom = window.innerHeight / 5 * 4;
    let logo = document.getElementById('move-logo');
    let btn = document.getElementById('move-btn');
    const logoTop = logo.getBoundingClientRect().top;
    const btnTop = btn.getBoundingClientRect().top;
    if (logoTop < triggerBottom) {
        logo.classList.add('show');
    }
    else {
        logo.classList.remove('show');
    }
    if (btnTop < triggerBottom) {
        btn.classList.add('show');
    }
    else {
        btn.classList.remove('show');
    }
}

window.addEventListener('scroll', LogoTranslate);
LogoTranslate();
