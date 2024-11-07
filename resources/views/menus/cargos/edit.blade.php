<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Editando Cargo') }}
            </h2>
            <a href="{{ route('cargos') }}"
                class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Voltar
            </a>
        </div>
    </x-slot>

    <!-- Modais de Feedback -->
    @if (session('success'))
        <div id="modalSuccess" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 shadow-lg max-w-sm w-full mx-4">
                <div class="flex items-center text-green-600 mb-4">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="text-lg font-medium">{{ session('success') }}</p>
                </div>
                <button class="w-full bg-green-500 text-white rounded-lg py-2 hover:bg-green-600 transition-colors duration-200"
                    onclick="document.getElementById('modalSuccess').classList.add('hidden')">
                    Fechar
                </button>
            </div>
        </div>
    @elseif(session('error'))
        <div id="modalError" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 shadow-lg max-w-sm w-full mx-4">
                <div class="flex items-center text-red-600 mb-4">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <p class="text-lg font-medium">{{ session('error') }}</p>
                </div>
                <button class="w-full bg-red-500 text-white rounded-lg py-2 hover:bg-red-600 transition-colors duration-200"
                    onclick="document.getElementById('modalError').classList.add('hidden')">
                    Fechar
                </button>
            </div>
        </div>
    @endif

    <div class="py-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 sm:p-8">
                <form action="{{ route('cargos.update', $cargos->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- Nome -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $cargos->name) }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200"
                                required>
                        </div>

                        <!-- Responsabilidade -->
                        <div class="space-y-2">
                            <label for="responsibilities" class="block text-sm font-medium text-gray-700">Responsabilidade</label>
                            <input type="text" id="responsibilities" name="responsibilities" value="{{ old('responsibilities', $cargos->responsibilities) }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200">
                        </div>

                        <!-- Botão de Envio -->
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex justify-end space-x-3">
                                <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Atualizar Cargo
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Exibe o modal se houver mensagem de sucesso ou erro
        window.onload = function() {
            if ('{{ session('success') }}' || '{{ session('error') }}') {
                if ('{{ session('success') }}') {
                    document.getElementById('modalSuccess').classList.remove('hidden');
                } else if ('{{ session('error') }}') {
                    document.getElementById('modalError').classList.remove('hidden');
                }
            }
        };
    </script>
</x-app-layout>
