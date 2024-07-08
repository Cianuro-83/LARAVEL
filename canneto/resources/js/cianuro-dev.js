document.addEventListener("DOMContentLoaded", function () {
    setTimeout(showChatBox, 5000); // Mostra la chat box dopo 5 secondi

    document
        .getElementById("submit-btn")
        .addEventListener("click", function () {
            const userResponse = document
                .getElementById("user-input")
                .value.trim()
                .toLowerCase();

            // Invia la risposta fornita dall'utente al server per la verifica
            fetch("/check-answer", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ user_response: userResponse }),
            })
                .then((response) => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error("Errore nella verifica della risposta");
                    }
                })
                .then((data) => {
                    if (data.success) {
                        window.location.href = "/dashboard";
                    } else {
                        const errorMessage =
                            document.getElementById("error-message");
                        if (!errorMessage) {
                            const errorElement = document.createElement("div");
                            errorElement.id = "error-message";
                            errorElement.classList.add("error-message");
                            errorElement.textContent = "Richiesta inapproprita";
                            document
                                .getElementById("chat-box")
                                .appendChild(errorElement);
                        } else {
                            errorMessage.textContent = "Richiesta inapproprita";
                        }

                        // Ripulisci il campo di input della risposta
                        document.getElementById("user-input").value = "";
                    }
                })
                .catch((error) => {
                    console.error("Si è verificato un errore:", error);
                });
        });
});

function showChatBox() {
    console.log("Showing chat box");
    document.getElementById("chat-box").classList.remove("hidden");
}
