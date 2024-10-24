<x-action-section>
    <x-slot name="title">
        {{ __('Excluir Conta') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Excluir sua conta permanentemente.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Uma vez que sua conta é excluída, todos os seus recursos e dados serão permanentemente deletados. Antes de excluir sua conta, faça o download de quaisquer dados ou informações que você deseja reter.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Excluir Conta') }}
            </x-danger-button>
        </div>

        <!-- Modal de Confirmação de Exclusão de Usuário -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Excluir Conta') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Você tem certeza de que deseja excluir sua conta? Uma vez que sua conta é excluída, todos os seus recursos e dados serão permanentemente deletados. Por favor, insira sua senha para confirmar que você gostaria de excluir sua conta permanentemente.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('Senha') }}"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Excluir Conta') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
