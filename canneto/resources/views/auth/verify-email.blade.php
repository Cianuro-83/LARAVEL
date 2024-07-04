<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina di Verifica</title>

    <!-- Stili per nascondere i bottoni -->
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <x-guest-layout>
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <!-- Checkboxes per privacy e termini -->
            <div class="mt-4" id="checkbox-container">
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-indigo-600 dark:text-indigo-500" name="privacy_policy" id="privacy_policy" required>
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Accetto la') }}
                            <a href="{{ route('privacy-policy') }}" class="underline hover:text-gray-900 dark:hover:text-gray-100">
                                {{ __('Privacy Policy') }}
                            </a>
                        </span>
                    </label>
                </div>
                <div class="mt-5">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-indigo-600 dark:text-indigo-500" name="terms_conditions" id="terms_conditions" required>
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Accetto i') }}
                            <a href="{{ route('termini&condizioni') }}" class="underline hover:text-gray-900 dark:hover:text-gray-100">
                                {{ __('Termini e Condizioni') }}
                            </a>
                        </span>
                    </label>
                </div>
            </div>

            <div id="verification-instructions" class="mt-5 mb-4 text-sm text-gray-600 dark:text-gray-400 text-justify">
                {{ __('Prima di poter accedere all\'area riservata, devi verificare la tua email. Clicca sul bottone sottostante per procedere. Se non hai ricevuto l\'email, te ne invieremo volentieri un\'altra.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div id="verification-message" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 text-justify">
                    {{ __('Abbiamo appena inviato all\'indirizzo email che hai fornito un link di verifica. Per completare la registrazione e poter accedere alla tua area riservata, ti chiediamo di aprire la tua casella di posta elettronica e fare clic sul link ricevuto. Se non hai ricevuto l\'email, clicca sul bottone sottostante per richiederne un nuovo invio.') }}
                </div>
            @endif

            <div id="buttons-container" class="mt-4 flex items-center justify-center space-x-4">
                <form method="POST" action="{{ route('verification.send') }}" id="verification-form" class="hidden">
                    @csrf
                    <x-button type="submit" id="send-email-button" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ session('status') == 'verification-link-sent' ? __('Invia una nuova email') : __('Invia Email di Verifica') }}
                    </x-button>
                </form>

                <div id="sending-email" class="hidden text-center">
                    <div role="status">
                        <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Caricamento...</span>
                    </div>
                </div>

                <a href="{{ route('profile.show') }}" class="profile-button px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Modifica Profilo') }}
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="logout-button px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Esci') }}
                    </button>
                </form>
            </div>
        </x-authentication-card>
    </x-guest-layout>

    <!-- Script per gestire la visibilità dei bottoni e il messaggio di invio email -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const privacyPolicyCheckbox = document.getElementById('privacy_policy');
            const termsConditionsCheckbox = document.getElementById('terms_conditions');
            const verificationInstructions = document.getElementById('verification-instructions');
            const verificationForm = document.getElementById('verification-form');
            const profileButton = document.querySelector('.profile-button');
            const logoutButton = document.querySelector('.logout-button');
            const checkboxContainer = document.getElementById('checkbox-container');
            const verificationMessage = document.getElementById('verification-message');
            const sendEmailButton = document.getElementById('send-email-button');
            const loadingSpinner = document.getElementById('sending-email'); // Riferimento aggiornato al spinner di caricamento

            function updateVisibility() {
                if (verificationMessage) {
                    // Se il messaggio di verifica è visibile, mostra lo spinner di caricamento e nascondi gli altri elementi
                    checkboxContainer.classList.add('hidden');
                    verificationInstructions.classList.add('hidden');
                    profileButton.classList.add('hidden');
                    logoutButton.classList.add('hidden');
                    verificationForm.classList.remove('hidden');
                    sendEmailButton.textContent = __('Invia una nuova email'); // Cambia il testo del pulsante
                    sendEmailButton.classList.remove('hidden');
                    loadingSpinner.classList.add('hidden');
                } else {
                    // Altrimenti, gestisci la visibilità in base agli stati dei checkbox come prima
                    if (privacyPolicyCheckbox.checked && termsConditionsCheckbox.checked) {
                        verificationInstructions.style.display = 'block';
                        verificationForm.classList.remove('hidden');
                        profileButton.classList.add('hidden');
                        logoutButton.classList.add('hidden');
                        sendEmailButton.classList.remove('hidden');
                        sendEmailButton.textContent = __('Invia Email di Verifica'); // Reimposta il testo del pulsante
                    } else {
                        verificationInstructions.style.display = 'none';
                        verificationForm.classList.add('hidden');
                        profileButton.classList.remove('hidden');
                        logoutButton.classList.remove('hidden');
                        sendEmailButton.classList.add('hidden');
                    }
                    loadingSpinner.classList.add('hidden');
                }
            }

            privacyPolicyCheckbox.addEventListener('change', updateVisibility);
            termsConditionsCheckbox.addEventListener('change', updateVisibility);

            verificationForm.addEventListener('submit', function () {
                loadingSpinner.classList.remove('hidden');
                verificationForm.classList.add('hidden');
            });

            sendEmailButton.addEventListener('click', function () {
                loadingSpinner.classList.add('hidden');
                verificationForm.classList.remove('hidden');
            });

            // Inizializzazione dello stato iniziale
            updateVisibility();
        });
    </script>
</body>
</html>
