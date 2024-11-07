@php
    $table = config('app.datatable.table');
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Escalas') }}
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-gray-100">
        <!-- Cabeçalho estilizado -->
        <header class="bg-blue-700 text-white p-6 rounded-b-lg shadow-md">
            <h1 class="text-3xl font-extrabold text-center tracking-wide">Dashboard de Escalas</h1>
        </header>
        
        <main class="p-8 max-w-7xl mx-auto space-y-8">
            <!-- Painéis Resumo -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                    <h2 class="font-semibold text-gray-600">Departamentos</h2>
                    <p class="text-4xl font-bold text-blue-600">10</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                    <h2 class="font-semibold text-gray-600">Turnos Ativos</h2>
                    <p class="text-4xl font-bold text-blue-600">5</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                    <h2 class="font-semibold text-gray-600">Funcionários</h2>
                    <p class="text-4xl font-bold text-blue-600">50</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                    <h2 class="font-semibold text-gray-600">Horários</h2>
                    <p class="text-4xl font-bold text-blue-600">8</p>
                </div>
            </div>
            
            <!-- Tabela de Escalas -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Tabela de Escalas</h2>
                <div class="overflow-hidden border border-gray-300 rounded-lg shadow-lg mt-4">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-700">Funcionário</th>
                                <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-700">Turno</th>
                                <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-700">Departamento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 border-b text-gray-800">João</td>
                                <td class="px-6 py-4 border-b text-gray-800">Manhã</td>
                                <td class="px-6 py-4 border-b text-gray-800">Vendas</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 border-b text-gray-800">Maria</td>
                                <td class="px-6 py-4 border-b text-gray-800">Tarde</td>
                                <td class="px-6 py-4 border-b text-gray-800">Marketing</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- Rodapé estilizado -->
        <footer class="bg-gray-200 text-center p-4 rounded-t-lg">
            <p class="text-sm text-gray-600">© 2024 Dashboard de Escalas. Todos os direitos reservados.</p>
        </footer>
    </div>
</x-app-layout>
