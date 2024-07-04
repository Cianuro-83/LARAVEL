document.addEventListener("DOMContentLoaded", function () {
    // Seleziona tutti gli elementi di input all'interno di elementi con classe 'input'
    const inputs = document.querySelectorAll(".input input");

    // Itera su ogni input trovato
    inputs.forEach((input) => {
        // Controlla al caricamento della pagina
        if (input.value !== "") {
            // Se l'input non è vuoto, sposta l'etichetta (label) verso l'alto
            input.nextElementSibling.style.transform = "translateY(-34px)";
        }

        // Aggiungi un listener per l'evento di focus sull'input
        input.addEventListener("focus", () => {
            // Quando l'input ottiene il focus, sposta l'etichetta verso l'alto
            input.nextElementSibling.style.transform = "translateY(-34px)";
        });

        // Aggiungi un listener per l'evento di blur sull'input
        input.addEventListener("blur", () => {
            // Quando l'input perde il focus, controlla se è vuoto
            if (input.value === "") {
                // Se l'input è vuoto, riporta l'etichetta alla sua posizione originale
                input.nextElementSibling.style.transform = "translateY(0)";
            }
        });

        // Aggiungi un listener per l'evento di input sull'input
        input.addEventListener("input", () => {
            // Quando l'utente digita nell'input, verifica nuovamente se è vuoto
            if (input.value !== "") {
                // Se l'input non è vuoto, sposta l'etichetta verso l'alto
                input.nextElementSibling.style.transform = "translateY(-34px)";
            } else {
                // Se l'input è vuoto, riporta l'etichetta alla sua posizione originale
                input.nextElementSibling.style.transform = "translateY(0)";
            }
        });
    });

    // Aggiungi il toggle per la visibilità della password
    const togglePassword = document.querySelector(".close");
    const passwordInput = document.getElementById("password");

    togglePassword.addEventListener("click", () => {
        // Cambia solo il tipo di input, non lo stile
        passwordInput.type =
            passwordInput.type === "password" ? "text" : "password";
    });
});
