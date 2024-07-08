let inputFocused = false;
let timer;

document.addEventListener("DOMContentLoaded", function () {
    setTimeout(showChatBox, 5000);

    document
        .getElementById("user-input")
        .addEventListener("focus", function () {
            inputFocused = true;
            clearTimeout(timer);
        });

    document.getElementById("user-input").addEventListener("blur", function () {
        inputFocused = false;
        startTimerToHideChatBox();
    });

    document
        .getElementById("submit-btn")
        .addEventListener("click", function () {
            const userResponse = document
                .getElementById("user-input")
                .value.trim()
                .toLowerCase();

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
                        displayErrorMessage();
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
    startTimerToHideChatBox();
}

function startTimerToHideChatBox() {
    timer = setTimeout(() => {
        if (!inputFocused) {
            console.log("Hiding chat box");
            document.getElementById("chat-box").classList.add("hidden");
        }
    }, 3000);
}

function displayErrorMessage() {
    const errorMessage = document.getElementById("error-message");
    if (!errorMessage) {
        const errorElement = document.createElement("div");
        errorElement.id = "error-message";
        errorElement.classList.add("error-message");
        errorElement.textContent = "Richiesta inappropriata";
        document.getElementById("chat-box").appendChild(errorElement);
    } else {
        errorMessage.textContent = "Richiesta inappropriata";
    }

    document.getElementById("user-input").value = "";
}
