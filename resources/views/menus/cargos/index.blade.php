@php
    $table = config('app.datatable.table');
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cargos') }}
        </h2>
    </x-slot>


    <div class=" mx-auto sm:px-6 lg:px-8 mt-5 rounded-lg">
        <div class=" overflow-hidden">
            <table class="{{ $table }} table-css tableCargos" style="width: 100%">
                <thead class="table-head-css">
                </thead>
                <tfoot>
                    <tr>

                    </tr>
                </tfoot>
            </table>
            </table>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/datatable.js') }}" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeDataTable(
            "Não foram encontrados registros de cargos.",
            "tableCargos",
            "{{ route('getdata-cargos') }}",
            [{
                    "data": "id",
                    "title": "Id",
                    "className": "text-center"

                },
                {
                    "data": "name",
                    "title": "Nome",
                    "className": "text-left"
                },
                {
                    "data": "responsibilities",
                    "title": "Responsabilidade",
                    "className": "text-left"
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
