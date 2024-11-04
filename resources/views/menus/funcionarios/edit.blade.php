<!-- resources/views/menus/funcionarios/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editando Funcionário') }}
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

    <div class="bg-gray-300 mt-10 p-6 rounded-lg">
        <!-- Mensagem de Sucesso ou Erro -->
        @if (session('success'))
            <div id="modalSuccess" class="hidden fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-4 shadow-lg">
                    <p class="text-green-600">{{ session('success') }}</p>
                    <button class="mt-2 text-blue-500"
                        onclick="document.getElementById('modalSuccess').classList.add('hidden')">Fechar</button>
                </div>
            </div>
        @elseif(session('error'))
            <div id="modalError" class="hidden fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-4 shadow-lg">
                    <p class="text-red-600">{{ session('error') }}</p>
                    <button class="mt-2 text-blue-500"
                        onclick="document.getElementById('modalError').classList.add('hidden')">Fechar</button>
                </div>
            </div>
        @endif

        <!-- Formulário para edição do funcionário -->
        <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Adiciona o método PUT para atualização -->

            <!-- Nome -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 mb-1">Nome</label>
                <input type="text" id="name" name="name" value="{{ old('name', $funcionario->name) }}"
                    class="w-full rounded-lg border py-2 px-3 " required>
            </div>

            <!-- Contato -->
            <div class="mb-4">
                <label for="contact" class="block text-gray-700 mb-1">Contato</label>
                <input type="text" id="contact" name="contact" value="{{ old('contact', $funcionario->contact) }}"
                    class="w-full rounded-lg border py-2 px-3 ">
            </div>

            <!-- Departamento -->
            <div class="mb-4">
                <label for="department_id" class="block text-gray-700 mb-1">Departamento</label>
                <select id="department_id" name="department_id" class="w-full rounded-lg border py-2 px-3 " required>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ $funcionario->department_id == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Posição -->
            <div class="mb-4">
                <label for="position_id" class="block text-gray-700 mb-1">Cargo</label>
                <select id="position_id" name="position_id" class="w-full rounded-lg border py-2 px-3 " required>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}"
                            {{ $funcionario->position_id == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botão de Envio -->
            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-teal-700 ">
                    Atualizar Funcionário
                </button>
            </div>
        </form>
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
