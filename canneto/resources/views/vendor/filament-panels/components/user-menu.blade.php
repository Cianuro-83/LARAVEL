@php
    $user = filament()->auth()->user();
    $items = filament()->getUserMenuItems();

    $profileItem = $items['profile'] ?? ($items['account'] ?? null);
    $profileItemUrl = $profileItem?->getUrl();
    $profilePage = filament()->getProfilePage();
    $hasProfileItem = filament()->hasProfile() || filled($profileItemUrl);

    $logoutItem = $items['logout'] ?? null;

    $items = \Illuminate\Support\Arr::except($items, ['account', 'logout', 'profile']);
@endphp

{{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_BEFORE) }}

<x-filament::dropdown placement="bottom-end" teleport :attributes="\Filament\Support\prepare_inherited_attributes($attributes)->class(['fi-user-menu'])">
    <x-slot name="trigger">
        <button aria-label="{{ __('filament-panels::layout.actions.open_user_menu.label') }}" type="button"
            class="shrink-0">
            <x-filament-panels::avatar.user :user="$user" />
        </button>
    </x-slot>

    @if ($profileItem?->isVisible() ?? true)
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_BEFORE) }}

        {{-- AGGIUNTA AVATAR E NOME UTENTE --}}

        @if ($hasProfileItem)
    <x-filament::dropdown.list>
        <x-filament::dropdown.list.item 
            :color="$profileItem?->getColor()" 
            :href="$profileItemUrl ?? filament()->getProfileUrl()" 
            :target="$profileItem?->shouldOpenUrlInNewTab() ?? false ? '_blank' : null"
            tag="a"
        >
            <img 
                src="{{ $user->getFilamentAvatarUrl() }}" 
                alt="{{ filament()->getUserName($user) }}" 
                class="inline-block w-6 h-6 rounded-full mr-2"
            />
            {{ $profileItem?->getLabel() ?? (($profilePage ? $profilePage::getLabel() : null) ?? filament()->getUserName($user)) }}
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
@else
    <x-filament::dropdown.header :color="$profileItem?->getColor()">
        <img 
            src="{{ $user->getFilamentAvatarUrl() }}" 
            alt="{{ filament()->getUserName($user) }}" 
            class="inline-block w-6 h-6 rounded-full mr-2"
        />
        {{ $profileItem?->getLabel() ?? filament()->getUserName($user) }}
    </x-filament::dropdown.header>
@endif

        
        {{-- AGGIUNTA PROFILO UTENTE JETSTREAM A FILAMENT PHP --}}
        <hr >
        <a href="{{ route('profile.show') }}">
            <x-filament::dropdown.list.item icon="heroicon-o-wrench-screwdriver">
                <span>Personalizza Profilo</span>
            </x-filament::dropdown.list.item>
        </a>
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_AFTER) }}
    @endif

    @if (filament()->hasDarkMode() && !filament()->hasDarkModeForced())
        <x-filament::dropdown.list>
            <x-filament-panels::theme-switcher />
        </x-filament::dropdown.list>
    @endif

    <x-filament::dropdown.list>
        @foreach ($items as $key => $item)
            @php
                $itemPostAction = $item->getPostAction();
            @endphp

            <x-filament::dropdown.list.item :action="$itemPostAction" :color="$item->getColor()" :href="$item->getUrl()" :icon="$item->getIcon()"
                :method="filled($itemPostAction) ? 'post' : null" :tag="filled($itemPostAction) ? 'form' : 'a'" :target="$item->shouldOpenUrlInNewTab() ? '_blank' : null">
                {{ $item->getLabel() }}
            </x-filament::dropdown.list.item>
        @endforeach

        <x-filament::dropdown.list.item :action="$logoutItem?->getUrl() ?? filament()->getLogoutUrl()" :color="$logoutItem?->getColor()" :icon="$logoutItem?->getIcon() ??
            (\Filament\Support\Facades\FilamentIcon::resolve('panels::user-menu.logout-button') ??
                'heroicon-m-arrow-left-on-rectangle')" method="post"
            tag="form">
            {{ $logoutItem?->getLabel() ?? __('Esci') }}
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
</x-filament::dropdown>

{{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_AFTER) }}
