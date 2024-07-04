document.addEventListener("DOMContentLoaded", function () {
    const privacyPolicyCheckbox = document.getElementById("privacy_policy");
    const termsConditionsCheckbox = document.getElementById("terms_conditions");
    const verificationInstructions = document.getElementById(
        "verification-instructions"
    );
    const verificationForm = document.getElementById("verification-form");
    const profileButton = document.querySelector(".profile-button");
    const logoutButton = document.querySelector(".logout-button");
    const checkboxContainer = document.getElementById("checkbox-container");
    const verificationMessage = document.getElementById("verification-message");
    const sendEmailButton = document.getElementById("send-email-button");
    const loadingSpinner = document.getElementById("sending-email"); // Riferimento aggiornato al spinner di caricamento

    function updateVisibility() {
        if (verificationMessage) {
            // Se il messaggio di verifica è visibile, mostra lo spinner di caricamento e nascondi gli altri elementi
            checkboxContainer.classList.add("hidden");
            verificationInstructions.classList.add("hidden");
            profileButton.classList.add("hidden");
            logoutButton.classList.add("hidden");
            verificationForm.classList.remove("hidden");
            sendEmailButton.textContent = __("Invia una nuova email"); // Cambia il testo del pulsante
            sendEmailButton.classList.remove("hidden");
            loadingSpinner.classList.add("hidden");
        } else {
            // Altrimenti, gestisci la visibilità in base agli stati dei checkbox come prima
            if (
                privacyPolicyCheckbox.checked &&
                termsConditionsCheckbox.checked
            ) {
                verificationInstructions.style.display = "block";
                verificationForm.classList.remove("hidden");
                profileButton.classList.add("hidden");
                logoutButton.classList.add("hidden");
                sendEmailButton.classList.remove("hidden");
                sendEmailButton.textContent = __("Invia Email di Verifica"); // Reimposta il testo del pulsante
            } else {
                verificationInstructions.style.display = "none";
                verificationForm.classList.add("hidden");
                profileButton.classList.remove("hidden");
                logoutButton.classList.remove("hidden");
                sendEmailButton.classList.add("hidden");
            }
            loadingSpinner.classList.add("hidden");
        }
    }

    privacyPolicyCheckbox.addEventListener("change", updateVisibility);
    termsConditionsCheckbox.addEventListener("change", updateVisibility);

    verificationForm.addEventListener("submit", function () {
        loadingSpinner.classList.remove("hidden");
        verificationForm.classList.add("hidden");
    });

    sendEmailButton.addEventListener("click", function () {
        loadingSpinner.classList.add("hidden");
        verificationForm.classList.remove("hidden");
    });

    // Inizializzazione dello stato iniziale
    updateVisibility();
});
