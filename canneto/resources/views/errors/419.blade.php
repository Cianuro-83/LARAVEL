@auth
    @if(!auth()->user()->email_verified_at || !auth()->user()->privacy || !auth()->user()->terms)
        @include('verify-email')
    @else
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                    {{ __('Token Scaduto') }}
                </h2>
            </x-slot>

            <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
                <div class="text-center p-6">
                    <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-gray-200">419 - Token Scaduto</h1>
                    <p class="text-lg mb-6 text-gray-600 dark:text-gray-400">Il token di sicurezza è scaduto. Per favore, ricarica la pagina e riprova.</p>
                    <a class="btn btn-primary" href="{{ url()->previous() }}">Torna alla Pagina Precedente</a>
                </div>
            </div>
        </x-app-layout>
    @endif
@else
    <x-guest-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Token Scaduto') }}
            </h2>
        </x-slot>

        <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="text-center p-6">
                <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-gray-200">419 - Token Scaduto</h1>
                <p class="text-lg mb-6 text-gray-600 dark:text-gray-400">Il token di sicurezza è scaduto. Per favore, ricarica la pagina e riprova.</p>
                <a class="btn btn-primary" href="{{ url()->previous() }}">Torna alla Pagina Precedente</a>
            </div>
        </div>
    </x-guest-layout>
@endauth
