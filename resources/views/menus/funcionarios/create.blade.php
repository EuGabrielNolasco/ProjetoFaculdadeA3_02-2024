<!-- resources/views/menus/funcionarios/create.blade.php -->

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criando Funcionário') }}
        </h2>
    </x-slot>

    <div class="mx-auto sm:px-6 lg:px-8 mt-5 rounded-lg">
        <!-- Botão de criar -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('funcionarios') }}"
                class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                Voltar
            </a>
        </div>
    </div>
    
    <div class="bg-gray-200 mt-10 p-6 rounded-lg">
        <!-- Formulário para criação do funcionário -->
        <form action="{{ route('funcionarios.store') }}" method="POST">
            @csrf

            <!-- Nome -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 mb-1">Nome</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="w-full rounded-lg border py-2 px-3" required>
            </div>

            <!-- Contato -->
            <div class="mb-4">
                <label for="contact" class="block text-gray-700 mb-1">Contato</label>
                <input type="text" id="contact" name="contact" value="{{ old('contact') }}"
                    class="w-full rounded-lg border py-2 px-3">
            </div>

            <!-- Departamento -->
            <div class="mb-4">
                <label for="department_id" class="block text-gray-700 mb-1">Departamento</label>
                <select id="department_id" name="department_id" class="w-full rounded-lg border py-2 px-3" required>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Posição -->
            <div class="mb-4">
                <label for="position_id" class="block text-gray-700 mb-1">Cargo</label>
                <select id="position_id" name="position_id" class="w-full rounded-lg border py-2 px-3" required>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botão de Envio -->
            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-teal-700">
                    Criar Funcionário
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
