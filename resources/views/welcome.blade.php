@php
    $table = config('app.datatable.table');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ScaleUp - Sistema de Gestão de Escalas</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('img/icon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('components.datatables')
    <link rel="stylesheet" href="{{ asset('css/datatable.css') }}" />

</head>

<body class="bg-gray-100 text-gray-900 min-h-screen font-sans antialiased">
    <!-- Navbar Superior -->
    <nav class="bg-white shadow-sm border-b border-gray-200 dark:border-gray-700 fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
                    <x-application-logo class="h-8 w-8 text-indigo-600 scale-50" />
                    <h1 class="text-xl font-bold text-indigo-700 tracking-tight">ScaleUp</h1>
                </div>
                <div>
                    <a href="{{ route('login') }}"
                        class="px-4 py-3 bg-indigo-600 hover:bg-indigo-700 dark:hover:bg-indigo-600 text-white rounded-lg text-x transition duration-300 ease-in-out transform hover:scale-105 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Acesso Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="pt-20 pb-10 mt-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Cabeçalho da Página -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Dashboard</h2>
                <p class="text-gray-600-300 text-lg">Visão geral do sistema de gestão de escalas</p>
            </div>

            <!-- Cards de Estatísticas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card de Funcionários -->
                <div
                    class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 p-6 space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="p-3.5 rounded-full bg-blue-200">
                            <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm uppercase tracking-wide">Total de Funcionários</p>
                            <p class="text-3xl font-bold text-blue-900">{{ $funcionarios ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card de Turnos Ativos -->
                <div
                    class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 p-6 space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="p-3.5 rounded-full bg-green-200">
                            <svg class="w-7 h-7 text-green-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm uppercase tracking-wide">Turnos Ativos</p>
                            <p class="text-3xl font-bold text-green-900">{{ $turnos ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card de Departamentos -->
                <div
                    class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 p-6 space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="p-3.5 rounded-full bg-purple-200">
                            <svg class="w-7 h-7 text-purple-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm uppercase tracking-wide">Departamentos</p>
                            <p class="text-3xl font-bold text-purple-900">{{ $departamentos ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card de Última Atualização -->
                <div
                    class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 p-6 space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="p-3.5 rounded-full bg-yellow-200">
                            <svg class="w-7 h-7 text-yellow-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm uppercase tracking-wide">Última Atualização</p>
                            <p class="text-3xl font-bold text-yellow-900">Hoje</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Seção de Relatórios e Tabela -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Área de Relatórios -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md p-6 space-y-4">
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-3 border-gray-200 dark:border-gray-700">
                            Relatórios Rápidos</h3>
                        <div class="space-y-3">
                            <a href="{{ route('pdf-departamento') }}" target="_blank">
                                <button
                                    class="w-full flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300 group">
                                    <span
                                        class="text-gray-700-300 group-hover:text-gray-900 dark:group-hover:text-white">Análise
                                        de Departamento</span>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-white"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </a>
                            <a href="{{ route('pdf-cargo') }}" target="_blank">

                                <button
                                    class="w-full flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300 group">
                                    <span
                                        class="text-gray-700-300 group-hover:text-gray-900 dark:group-hover:text-white">Análise
                                        de Cargos</span>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-white"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </a>

                            <a href="{{ route('pdf-turno') }}" target="_blank">

                                <button
                                    class="w-full flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300 group">
                                    <span
                                        class="text-gray-700-300 group-hover:text-gray-900 dark:group-hover:text-white">Análise
                                        de Turnos</span>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-white"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </a>

                        </div>
                    </div>
                </div>

                <!-- Tabela de Escalas -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden p-7">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-gray-900">Escalas Recentes</h3>
                        </div>
                        <div class="overflow-hidden">
                            <table class="{{ $table }} table-css tableEscalas" style="width: 100%">
                                <thead class="table-head-css"></thead>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div id="modalEscala" class="fixed z-50 inset-0 overflow-y-auto hidden mt-20">
        <div class="flex items-center justify-center min-h-screen pt-14 pb-14 px-4 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div id="modalOverlay" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                aria-hidden="true">
            </div>

            <!-- Modal container -->
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full relative">
                <!-- Modal Header -->
                <div class="bg-blue-50 px-6 py-4 border-b border-blue-100 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                        <svg class="h-6 w-6 text-blue-600 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Detalhes da Escala
                    </h3>
                    <button id="fecharModal" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="px-6 py-6">
                    <div id="detalhesEscala" class="max-h-[500px] overflow-y-auto space-y-4">
                        <!-- Os detalhes do JSON serão inseridos aqui -->
                        <p class="text-gray-500 text-center" id="semDadosMsg">Nenhum detalhe
                            disponível
                        </p>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
                    <button id="fecharModalRodape" type="button"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modalEscala');
            const modalOverlay = document.getElementById('modalOverlay');
            const closeModalButtons = [
                document.getElementById('fecharModal'),
                document.getElementById('fecharModalRodape')
            ];

            // Function to close modal
            function closeModal() {
                modal.classList.add('hidden');
                // Re-enable scrolling on body
                document.body.style.overflow = 'auto';
            }

            // Close modal when close buttons are clicked
            closeModalButtons.forEach(button => {
                button.addEventListener('click', closeModal);
            });

            // Close modal when clicking outside of the modal content
            modalOverlay.addEventListener('click', function(event) {
                if (event.target === modalOverlay) {
                    closeModal();
                }
            });

            // Prevent scroll propagation when scrolling inside the modal
            const detalhesEscala = document.getElementById('detalhesEscala');
            detalhesEscala.addEventListener('wheel', function(event) {
                const isAtTop = this.scrollTop === 0;
                const isAtBottom = this.scrollHeight - this.scrollTop === this.clientHeight;

                if ((isAtTop && event.deltaY < 0) || (isAtBottom && event.deltaY > 0)) {
                    event.preventDefault();
                }
            });

            // Modify existing showModal function to prevent body scroll
            window.showModal = function() {
                modal.classList.remove('hidden');
                // Disable scrolling on body
                document.body.style.overflow = 'hidden';
            }
        });
    </script>
    <script src="{{ asset('js/datatable.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeDataTable(
                "Não foram encontrados registros escalas.",
                "tableEscalas",
                "{{ route('get-data-escalas') }}",
                [{
                        "data": "funcionario",
                        "title": "Funcionario",
                        "className": "text-left"
                    },
                    {
                        "data": "turno",
                        "title": "Turno",
                        "className": "text-left"
                    },
                    {
                        "data": "primeiro_dia",
                        "title": "Primeiro Dia",
                        "className": "text-center"
                    },
                    {
                        "data": "ultimo_dia",
                        "title": "Ultimo Dia",
                        "className": "text-center"
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
                        "data": "cargo",
                        "title": "Cargo",
                        "className": "text-left"
                    },
                    {
                        "data": null,
                        "title": "Relatório",
                        "className": "text-center",
                        "orderable": false,
                        "render": function(data, type, row) {
                            // Assuming the row has an 'id_funcionario' property
                            return `<button onclick="pdfEscala(${row.id_funcionario})" class="btnGerarEscala group flex items-center justify-center text-blue-600 hover:text-blue-800 focus:outline-none transition-colors bg-blue-100 px-2 py-1 rounded">
                                        <span class="mr-1 text-sm">Relatório</span>
                                        <svg class="w-4 h-4 text-blue-600 group-hover:text-blue-800 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                    </button>`;
                        }
                    },
                    {
                        "data": null,
                        "title": "Ações",
                        "className": "text-center",
                        "orderable": false,
                        "render": function(data, type, row) {
                            return `<button class="btnDetalhes group flex items-center justify-center text-white hover:text-gray-300 focus:outline-none transition-colors bg-blue-600 px-2 py-1 rounded" data-detalhes='${JSON.stringify(row['data-detalhes'])}'>
                                <span class="mr-1 text-sm">Detalhes</span>
                                <svg class="w-4 h-4 text-white group-hover:text-gray-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>`;
                        },

                    }
                ], [{
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

            // Evento para abrir modal
            document.querySelector('.tableEscalas').addEventListener('click', function(e) {
                const btnDetalhes = e.target.closest('.btnDetalhes');
                if (btnDetalhes) {
                    // Parse dos detalhes
                    const detalhes = JSON.parse(btnDetalhes.getAttribute('data-detalhes'));
                    const container = document.getElementById('detalhesEscala');
                    container.innerHTML = '';

                    // Verifica se detalhes é um array
                    if (Array.isArray(detalhes)) {
                        // Popula a modal com os dados do JSON
                        detalhes.forEach(item => {
                            const div = document.createElement('div');
                            div.classList.add('mb-2', 'p-3', 'bg-gray-100', 'rounded-lg');

                            // Função para formatar data no padrão brasileiro (DD/MM/AAAA)
                            const formatarData = (dateString) => {
                                if (!dateString) return 'Não informado';
                                const data = new Date(dateString);
                                return data instanceof Date && !isNaN(data) ?
                                    data.toLocaleDateString('pt-BR') :
                                    'Data inválida';
                            };

                            // Função para formatar hora no padrão brasileiro (HH:mm)
                            const formatarHora = (hoursString) => {
                                if (!hoursString) return 'Não informado';

                                // Se já estiver no formato HH:mm, retorna como está
                                if (/^\d{2}:\d{2}$/.test(hoursString)) return hoursString;

                                // Se for um número de horas decimal (ex: 1.5)
                                const horasDecimal = parseFloat(hoursString);
                                if (!isNaN(horasDecimal)) {
                                    const horas = Math.floor(horasDecimal);
                                    const minutos = Math.round((horasDecimal - horas) * 60);
                                    return `${String(horas).padStart(2, '0')}:${String(minutos).padStart(2, '0')}`;
                                }

                                return 'Hora inválida';
                            };

                            div.innerHTML = `
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-800">
                            <svg class="w-4 h-4 inline-block mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Data:
                        </span>
                        <span class="text-gray-600">${formatarData(item.date)}</span>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="font-medium text-gray-800">
                            <svg class="w-4 h-4 inline-block mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Turno:
                        </span>
                        <span class="text-gray-600">${item.shift_name || 'Não informado'}</span>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="font-medium text-gray-800">
                            <svg class="w-4 h-4 inline-block mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Hora Entrada:
                        </span>
                        <span class="text-gray-600">${formatarHora(item.start_time)}</span>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="font-medium text-gray-800">
                            <svg class="w-4 h-4 inline-block mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Hora Saida:
                        </span>
                        <span class="text-gray-600">${formatarHora(item.end_time)}</span>
                    </div>
                `;
                            container.appendChild(div);
                        });
                    } else {
                        container.innerHTML =
                            '<p class="text-gray-500 text-center">Nenhum detalhe disponível</p>';
                    }

                    // Exibe a modal
                    document.getElementById('modalEscala').classList.remove('hidden');
                }
            });
            // Adiciona event listeners para fechar a modal
            document.getElementById('fecharModal').addEventListener('click', () => {
                document.getElementById('modalEscala').classList.add('hidden');
            });

            document.getElementById('fecharModalRodape').addEventListener('click', () => {
                document.getElementById('modalEscala').classList.add('hidden');
            });
        });


        function pdfEscala(idFuncionario) {
            // Define a URL da rota que irá gerar o PDF
            const url = `/gerar-pdf-escalas/${idFuncionario}`; // Altere para a rota que você deseja
            window.location.href = url; // Redireciona para a URL
        }
    </script>


</body>

</html>
