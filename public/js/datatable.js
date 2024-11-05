function initializeDataTable(descricaoNotFound, idDatatable, url, columns, buttons) {
    var tableSelector = '.' + idDatatable;

    if ($.fn.DataTable.isDataTable(tableSelector)) {
        $(tableSelector).DataTable().clear().destroy();
    }

    $(document).ready(function () {
        $('.' + idDatatable).DataTable(
            {
                retrieve: true,
                "serverSide": true,
                "ajax": {
                    "url": url,
                    "type": "GET",
                    "beforeSend": function () {
                        $('#loading-message').show();
                        $('#loading-message-modal').show();
                    },
                    "complete": function () {
                        $('#loading-message').hide();
                        $('#loading-message-modal').hide();
                    }
                },
                "columns": columns,
                "language": {
                    "emptyTable": descricaoNotFound,
                    "info": "Mostrando _START_ até _END_ de _TOTAL_ entradas",
                    "infoEmpty": "Mostrando 0 até 0 de 0 entradas",
                    "infoFiltered": "(Filtrado de _MAX_ entradas totais)",
                    "lengthMenu": "_MENU_ Entradas por página",
                    "search": "Pesquisar:",
                    "zeroRecords": descricaoNotFound,
                    "paginate": {
                        "first": "Primeiro",
                        "last": "Último",
                        "next": "Próximo",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": Ordenar colunas de forma ascendente",
                        "sortDescending": ": Ordenar colunas de forma descendente"
                    }
                },
                "lengthMenu": [
                    [20, 100, 500, 1000],
                    ['20', '100', '500', '1000']
                ],
                "dom": 'Blfrtip',
                "buttons": buttons,
                "scrollCollapse": true,
                "scrollY": '500px',
                "scrollX": true,
                "responsive": true,
                "initComplete": function () {
                    applyTableStyles(idDatatable);
                },
                "drawCallback": function () {
                    applyTableStyles(idDatatable);
                }

            });
    });
}

function applyTableStyles(idDatatable) {
    $('.' + idDatatable + ' td').css({
        'font-size': '1rem', // Define o tamanho da fonte em 'rem' para escalabilidade
        'background-color': '#ffffff',
        'color': '#1f2937' // Define o texto como cinza escuro
    }).addClass('text-lg bg-white text-gray-900');

    $('.' + idDatatable + ' th').css({
        'font-size': '1rem',
            'color': '#ffff',
    }).addClass('text-lg bg-gray-700 text-gray-100');

    $('.' + idDatatable + ' tfoot').css({
        'font-size': '1rem',
        'background-color': '#d1d5db',
        'color': '#1f2937'
    }).addClass('text-lg bg-gray-700 text-gray-800');

    $('.' + idDatatable + ' thead').css({
        'font-size': '1rem',
        'background-color': '#1f2937',
        'color': '#ffffff',
        'margin-top': '1rem'
    }).addClass(' text-lg bg-gray-700 text-gray-100');
}
