<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Relatórios de Escalas') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Título e Descrição -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Gerador de Relatórios de Escalas</h1>
                <p class="text-gray-600">Aqui você pode personalizar e gerar relatórios detalhados sobre as escalas de trabalho.</p>
            </div>

            <!-- Formulário de Filtros -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Filtros do Relatório</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Departamento -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Departamento</label>
                        <select class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option>Todos os Departamentos</option>
                            <!-- Adicionar opções dinamicamente -->
                        </select>
                    </div>

                    <!-- Período -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Período</label>
                        <select class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option>Últimos 30 dias</option>
                            <option>Último mês</option>
                            <option>Último trimestre</option>
                            <option>Ano atual</option>
                        </select>
                    </div>

                    <!-- Tipo de Relatório -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Tipo de Relatório</label>
                        <select class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option>Resumo Geral</option>
                            <option>Detalhado por Funcionário</option>
                            <option>Horas Extras</option>
                            <option>Cobertura de Turnos</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Opções Avançadas -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Opções Avançadas</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Data Inicial -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Data Inicial</label>
                        <input type="date" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Data Final -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Data Final</label>
                        <input type="date" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Formato de Exportação -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Formato de Exportação</label>
                        <select class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option>PDF</option>
                            <option>Excel</option>
                            <option>CSV</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="flex justify-end space-x-4">
                <button class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-300">
                    Limpar Filtros
                </button>
                <button class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                    Gerar Relatório
                </button>
            </div>
        </div>
    </div>
</x-app-layout>