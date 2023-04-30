function checkContactForm() {
    let contactForm = document.querySelector('#contact-form');

    contactForm.addEventListener('submit', function(e) {

        let contactName = document.querySelector('#contactName').value.trim();
        let contactEmail = document.querySelector('#contactEmail').value.trim();
        let contactMessage = document.querySelector('#contactMessage').value.trim();

        if (contactName.length < 2) {
            alert('Votre prénom doit faire au moins 2 caractères.');
            e.preventDefault();
            return;
        }

        if (contactEmail === '') {
            alert('Veuillez renseigner votre email.');
            e.preventDefault();
            return;
        }

        if (contactMessage.length < 15) {
            alert('Votre message doit faire au moins 15 caractères.');
            e.preventDefault();
            return;
        }

        // Si toutes les vérifications sont passées, on peut soumettre le formulaire
        alert('Votre message a bien été envoyé, nous reviendrons vers vous dans les plus brefs délais');
        contactForm.submit();
    });

}

window.addEventListener('DOMContentLoaded', function() {

    checkContactForm();

});
