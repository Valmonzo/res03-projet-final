function validateLoginForm(event) {
    // Empêcher l'envoi du formulaire par défaut
    event.preventDefault();

    // Récupérer les valeurs des champs de formulaire
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let form = document.getElementById("login-form");

    // Définir un message d'erreur par défaut
    let errorMessage = "";

    // Vérifier que l'e-mail est valide
    if (!isValidEmail(email)) {
        errorMessage += "Adresse e-mail invalide.";
        // Ajouter la classe "error" à l'élément de champ correspondant
        document.getElementById("email").classList.add("error");
    }
    else {
        // Retirer la classe "error" de l'élément de champ s'il existe
        document.getElementById("email").classList.remove("error");
    }

    // Vérifier que le mot de passe est valide
    if (!isValidPassword(password)) {
        errorMessage += "Mot de passe invalide.";
        // Ajouter la classe "error" à l'élément de champ correspondant
        document.getElementById("password").classList.add("error");
    }
    else {
        // Retirer la classe "error" de l'élément de champ s'il existe
        document.getElementById("password").classList.remove("error");
    }

    // Afficher le message d'erreur s'il y en a un
    if (errorMessage === "Mot de passe invalide.") {
        let errorDiv = document.createElement("div");
        errorDiv.classList.add("error-message");
        errorDiv.innerText = errorMessage;
        document.getElementById("password-field").appendChild(errorDiv);
    }
    else if (errorMessage === "Adresse e-mail invalide.") {
        let errorDiv = document.createElement("div");
        errorDiv.classList.add("error-message");
        errorDiv.innerText = errorMessage;
        document.getElementById("email-field").appendChild(errorDiv);
    }
    else {
        // Si tout est valide, soumettre le formulaire
        form.submit();
    }
}

// Fonction utilitaire pour vérifier si une adresse e-mail est valide
function isValidEmail(email) {
    let emailRegex = /^\S+@\S+\.\S+$/;
    return emailRegex.test(email);
}

// Fonction utilitaire pour vérifier si un mot de passe est valide
function isValidPassword(password) {
    return password.length >= 4;
}


document.getElementById("login").addEventListener("submit", validateLoginForm);
