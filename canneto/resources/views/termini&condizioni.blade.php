<x-guest-layout>
    <div class="pt-4 bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg prose dark:prose-invert">
                <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-gray-200 text-center">Termini e condizioni d'uso</h1>

                {{-- bottone torna indietro --}}
                <a class="btn btn-primary" href="{{ url()->previous() }}">Torna indietro</a>
            </div>
        </div>
    </div>
</x-guest-layout>
