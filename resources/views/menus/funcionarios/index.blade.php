@php
    $table = config('app.datatable.table');
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Funcionários') }}
        </h2>
    </x-slot>

    <div class="mx-auto sm:px-6 lg:px-8 mt-5 rounded-lg">
        <!-- Botão de criar -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('funcionarios.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                Criar Novo Funcionário
            </a>
        </div>

        <div class="overflow-hidden">
            <table class="{{ $table }} table-css tableFuncionarios" style="width: 100%">
                <thead class="table-head-css">
                </thead>
                <tfoot>
                    <tr>

                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/datatable.js') }}" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeDataTable(
            "Não foram encontrados registros de funcionários.",
            "tableFuncionarios",
            "{{ route('getdata-funcionarios') }}",
            [
                {
                    "data": "nome",
                    "title": "Nome",
                    "className": "text-left"
                },
                {
                    "data": "contato",
                    "title": "Contato",
                    "className": "text-left"
                },
                {
                    "data": "departamento",
                    "title": "Departamento",
                    "className": "text-left"
                },
                {
                    "data": "descricao",
                    "title": "Descrição",
                    "className": "text-left"
                },
                {
                    "data": "cargo",
                    "title": "Cargo",
                    "className": "text-left"
                },
                {
                    "data": "responsabilidade",
                    "title": "Responsabilidade",
                    "className": "text-left"
                },
                {
                    "data": "acoes",
                    "title": "Ações",
                    "className": "text-center", 
                    orderable: false, 
                    searchable: false
                },

            ],
            [
                {
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
