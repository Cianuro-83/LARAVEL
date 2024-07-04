@auth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Pagina Non Trovata') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="text-center p-6">
            <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-gray-200">404 - Pagina Non Trovata</h1>
            <p class="text-lg mb-6 text-gray-600 dark:text-gray-400">La pagina che stai cercando non esiste o è stata rimossa.</p>
            <a class="btn btn-primary" href="{{ url('/') }}">Torna alla Homepage</a>
        </div>
    </div>
</x-app-layout>
@else
<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Pagina Non Trovata') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="text-center p-6">
            <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-gray-200">404 - Pagina Non Trovata</h1>
            <p class="text-lg mb-6 text-gray-600 dark:text-gray-400">La pagina che stai cercando non esiste o è stata rimossa.</p>
            <a class="btn btn-primary" href="{{ url('/') }}">Torna indietro</a>
        </div>
    </div>
</x-guest-layout>
@endauth
