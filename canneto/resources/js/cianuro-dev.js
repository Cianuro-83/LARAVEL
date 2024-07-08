document.addEventListener("DOMContentLoaded", function () {
    setTimeout(showChatBox, 5000); // Mostra la chat box dopo 5 secondi

    document
        .getElementById("submit-btn")
        .addEventListener("click", function () {
            const userResponse = document
                .getElementById("user-input")
                .value.trim()
                .toLowerCase();

            if (userResponse === "sarà perchè non si paga") {
                window.location.href = "/dashboard";
            } else {
                alert("Risposta errata.");
            }
        });
});

function showChatBox() {
    console.log("Showing chat box");
    document.getElementById("chat-box").classList.remove("hidden");
}
