    <!-- resources/views/menus/turnos/edit.blade.php -->
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editando Turno') }}
            </h2>
        </x-slot>

        <div class="mx-auto sm:px-6 lg:px-8 mt-5 rounded-lg">
            <!-- Botão de criar -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('turnos') }}"
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

            <!-- Formulário para edição do turnos -->
            <form action="{{ route('turnos.update', $turnos->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Adiciona o método PUT para atualização -->

                <!-- Nome -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 mb-1">Nome</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $turnos->name) }}"
                        class="w-full rounded-lg border py-2 px-3 " required>
                </div>

                <!-- Hora Entrada -->
                <div class="mb-4">
                    <label for="start_time" class="block text-gray-700 mb-1">Hora Entrada</label>
                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $turnos->start_time) }}"
                        class="w-full rounded-lg border py-2 px-3 " required>
                </div>

                <!-- Hora Saida -->
                <div class="mb-4">
                    <label for="end_time" class="block text-gray-700 mb-1">Hora Saida</label>
                    <input type="time" id="end_time" name="end_time" value="{{ old('end_time', $turnos->end_time) }}"
                        class="w-full rounded-lg border py-2 px-3 " required>
                </div>

                <!-- Botão de Envio -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-teal-700 ">
                        Atualizar Turno
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
