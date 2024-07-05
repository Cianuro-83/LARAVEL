<x-action-section>
    <x-slot name="title">
        {{ __('Elimina Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Cancella definitivamente il tuo account. ') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('Una volta cancellato l\'account, tutte le risorse e i dati saranno eliminati in modo permanente. Prima di eliminare l\'account, scaricare tutti i dati e le informazioni che si desidera conservare.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Elimina Account') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Elimina Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Siete sicuri di voler eliminare il vostro account? Una volta cancellato l\'account, tutte le sue risorse e i suoi dati saranno eliminati in modo permanente. Inserire la password per confermare la volontà di eliminare definitivamente il proprio account.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancella') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Elimina Account') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
