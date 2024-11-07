<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Editando Funcionário') }}
            </h2>
            <a href="{{ route('funcionarios') }}"
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
        <div id="modalSuccess" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
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
        <div id="modalError" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
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
                <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- Nome -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $funcionario->name) }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200"
                                required>
                        </div>

                        <!-- Contato -->
                        <div class="space-y-2">
                            <label for="contact" class="block text-sm font-medium text-gray-700">Contato</label>
                            <input type="text" id="contact" name="contact" value="{{ old('contact', $funcionario->contact) }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200">
                        </div>

                        <!-- Grid para Departamento e Cargo -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Departamento -->
                            <div class="space-y-2">
                                <label for="department_id" class="block text-sm font-medium text-gray-700">Departamento</label>
                                <div class="relative">
                                    <select id="department_id" name="department_id" 
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200 appearance-none"
                                        required>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ $funcionario->department_id == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Posição -->
                            <div class="space-y-2">
                                <label for="position_id" class="block text-sm font-medium text-gray-700">Cargo</label>
                                <div class="relative">
                                    <select id="position_id" name="position_id" 
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200 appearance-none"
                                        required>
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}"
                                                {{ $funcionario->position_id == $position->id ? 'selected' : '' }}>
                                                {{ $position->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex justify-end space-x-3">
                                <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Atualizar Funcionário
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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