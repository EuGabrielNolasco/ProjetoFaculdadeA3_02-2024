@php
    $table = config('app.datatable.table');
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Escala') }}
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
                    <p class="text-4xl font-bold text-blue-600">{{$departamentos ?? 0}}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                    <h2 class="font-semibold text-gray-600">Turnos Ativos</h2>
                    <p class="text-4xl font-bold text-blue-600">{{$turnos ?? 0}}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                    <h2 class="font-semibold text-gray-600">Funcionários</h2>
                    <p class="text-4xl font-bold text-blue-600">{{$funcionarios ?? 0}}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                    <h2 class="font-semibold text-gray-600">Cargos</h2>
                    <p class="text-4xl font-bold text-blue-600">{{$cargos ?? 0}}</p>
                </div>
            </div>
            
            <!-- Seletor de Período e Botão de Gerar Escalas -->
            <div class="flex justify-end items-center space-x-4 mt-4">
                <select id="periodType" class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="weekly">Semanal</option>
                    <option value="biweekly">Quinzenal</option>
                    <option value="monthly">Mensal</option>
                    <option value="quarterly">Trimestral</option>
                </select>
                <button 
                    type="button" 
                    onclick="gerarEscalas()" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-300"
                >
                    Gerar Escalas
                </button>
            </div>

            <!-- Tabela de Escalas -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Tabela de Escalas</h2>
                <div class="overflow-hidden border border-gray-300 rounded-lg shadow-lg mt-4">
                    <table class="{{ $table }} table-css tableTurnos" style="width: 100%">
                        <thead class="table-head-css">
                        </thead>
                        <tfoot>
                            <tr>
        
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </main>

        <!-- Rodapé estilizado -->
        <footer class="bg-gray-200 text-center p-4 rounded-t-lg">
            <p class="text-sm text-gray-600">© 2024 Dashboard de Escalas. Todos os direitos reservados.</p>
        </footer>
    </div>

    <script>
        function gerarEscalas() {
            const periodType = document.getElementById('periodType').value;
            const button = event.target;
            button.disabled = true;
            button.textContent = 'Gerando...';

            // Enviar requisição para o backend
            axios.post('/escalas/generate', { period_type: periodType })
                .then(response => {
                    alert('Escalas geradas com sucesso!');
                    console.log(response.data);
                })
                .catch(error => {
                    console.error('Erro ao gerar escalas:', error);
                    alert('Erro ao gerar escalas: ' + (error.response?.data?.error || error.message));
                })
                .finally(() => {
                    button.disabled = false;
                    button.textContent = 'Gerar Escalas';
                });
        }
    </script>
    <script src="{{ asset('js/datatable.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeDataTable(
                "Não foram encontrados registros de turnos.",
                "tableTurnos",
                "{{ route('getdata-turnos') }}",
                [{
                        "data": "id",
                        "title": "ID",
                        "className": "text-center"
    
                    },
                    {
                        "data": "name",
                        "title": "Nome",
                        "className": "text-left"
                    },
                    {
                        "data": "start_time",
                        "title": "Inicio",
                        "className": "text-left"
                    },
                    {
                        "data": "end_time",
                        "title": "Termino",
                        "className": "text-left"
                    },
                    {
                        "data": "acoes",
                        "title": "Ações",
                        "className": "text-center",
                        orderable: false
                    }
    
                ],
                [{
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Imprimir'
                    },
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-copy"></i>',
                        titleAttr: 'Copiar'
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns" aria-hidden="true"></i>',
                        titleAttr: 'Colunas'
                    }
                ]
            );
        });
    </script>
    
</x-app-layout>
