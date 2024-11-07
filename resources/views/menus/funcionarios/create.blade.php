<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Criando Funcionário') }}
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

    <div class="py-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 sm:p-8">
                <form action="{{ route('funcionarios.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <!-- Nome -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200"
                                required>
                        </div>

                        <!-- Contato -->
                        <div class="space-y-2">
                            <label for="contact" class="block text-sm font-medium text-gray-700">Contato</label>
                            <input type="text" id="contact" name="contact" value="{{ old('contact') }}"
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
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
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
                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                    </select>           
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex justify-end space-x-3">
                                <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Criar Funcionário
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>