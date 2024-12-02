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
                <div
                    class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105 flex flex-col space-y-3">
                    <div class="flex justify-between items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-600">Departamentos</h2>
                    <p class="text-4xl font-bold text-blue-600">{{ $departamentos ?? 0 }}</p>
                </div>
                <div
                    class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105 flex flex-col space-y-3">
                    <div class="flex justify-between items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-600">Turnos Ativos</h2>
                    <p class="text-4xl font-bold text-blue-600">{{ $turnos ?? 0 }}</p>
                </div>
                <div
                    class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105 flex flex-col space-y-3">
                    <div class="flex justify-between items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-600">Funcionários</h2>
                    <p class="text-4xl font-bold text-blue-600">{{ $funcionarios ?? 0 }}</p>
                </div>
                <div
                    class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105 flex flex-col space-y-3">
                    <div class="flex justify-between items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-600">Cargos</h2>
                    <p class="text-4xl font-bold text-blue-600">{{ $cargos ?? 0 }}</p>
                </div>
            </div>
            <!-- Tabela de Escalas -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Tabela de Escalas</h2>
                    <div class="flex items-center space-x-4">
                        <select id="periodType" class="border border-gray-300 rounded-lg px-4 py-2">
                            <option value="weekly">Semanal</option>
                            <option value="biweekly">Quinzenal</option>
                            <option value="monthly">Mensal</option>
                            <option value="quarterly">Trimestral</option>
                        </select>
                        <button type="button" onclick="gerarEscalas()"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-300">
                            Gerar Escalas
                        </button>
                        <button type="button" onclick="apagarEscalas()"
                            class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition duration-300">
                            Apagar Escalas
                        </button>
                    </div>
                </div>
                <div class="overflow-hidden">
                    <table class="{{ $table }} table-css tableEscalas" style="width: 100%">
                        <thead class="table-head-css"></thead>
                        <tfoot>
                            <tr></tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Modal -->
                <div id="modalEscala" class="fixed z-50 inset-0 overflow-y-auto hidden">
                    <div
                        class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <!-- Background overlay -->
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
                        </div>

                        <!-- Modal container -->
                        <div
                            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full relative">
                            <!-- Modal Header -->
                            <div
                                class="bg-blue-50 px-6 py-4 border-b border-blue-100 flex items-center justify-between">
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
                                    <p class="text-gray-500 text-center" id="semDadosMsg">Nenhum detalhe disponível
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
            </div>
        </main>

        <!-- Rodapé estilizado -->
        <footer class="bg-gray-200 text-center p-4 rounded-t-lg">
            <p class="text-sm text-gray-600">© 2024 Dashboard de Escalas. Todos os direitos reservados.</p>
        </footer>
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

    <script>
        function gerarEscalas() {
            // Show confirmation modal
            Swal.fire({
                title: 'Gerar Escalas',
                text: "Você está prestes a gerar novas escalas. Deseja continuar?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, gerar escalas',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                // Adiciona log de depuração para confirmação
                console.log('Resultado da confirmação de geração:', result);

                if (result.isConfirmed) {
                    const periodType = document.getElementById('periodType').value;
                    const button = event.target;
                    button.disabled = true;
                    button.textContent = 'Gerando...';

                    // Log para verificar dados sendo enviados
                    console.log('Enviando requisição para gerar escalas', {
                        periodType
                    });

                    // Enviar requisição para o backend
                    axios.post('/escalas/generate', {
                            period_type: periodType
                        })
                        .then(response => {
                            console.log('Escalas geradas com sucesso:', response.data);

                            // Tenta recarregar a DataTable
                            try {
                                $('.tableEscalas').DataTable().ajax.reload();
                            } catch (e) {
                                console.error('Erro ao recarregar DataTable:', e);
                            }

                            // Show success notification
                            Swal.fire(
                                'Escalas Geradas!',
                                'As escalas foram geradas com sucesso.',
                                'success'
                            );
                        })
                        .catch(error => {
                            // Log detalhado do erro
                            console.error('Erro ao gerar escalas:', {
                                error: error,
                                response: error.response
                            });

                            // Show error notification
                            Swal.fire(
                                'Erro!',
                                'Não foi possível gerar as escalas. ' +
                                (error.response?.data?.error || error.message || 'Erro desconhecido.'),
                                'error'
                            );
                        })
                        .finally(() => {
                            button.disabled = false;
                            button.textContent = 'Gerar Escalas';
                        });
                }
            });
        }

        function apagarEscalas() {
            // Adiciona log de depuração
            console.log('Função apagarEscalas() chamada');

            // Show confirmation modal
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você está prestes a apagar todas as escalas geradas. Esta ação não pode ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, apagar escalas',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                // Adiciona log de depuração para confirmação
                console.log('Resultado da confirmação:', result);

                if (result.isConfirmed) {
                    // Log para verificar dados sendo enviados
                    console.log('Enviando requisição para apagar escalas');

                    // AJAX call to delete scales
                    $.ajax({
                        url: '{{ route('escalas.apagar') }}', // Verifique se esta rota está correta
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log('Sucesso ao apagar escalas:', response);

                            // Tenta recarregar a DataTable
                            try {
                                $('.tableEscalas').DataTable().ajax.reload();
                            } catch (e) {
                                console.error('Erro ao recarregar DataTable:', e);
                            }

                            // Show success notification
                            Swal.fire(
                                'Escalas Apagadas!',
                                'Todas as escalas foram removidas com sucesso.',
                                'success'
                            );
                        },
                        error: function(xhr, status, error) {
                            // Log detalhado do erro
                            console.error('Erro na requisição:', {
                                status: xhr.status,
                                responseText: xhr.responseText,
                                error: error
                            });

                            // Show error notification
                            Swal.fire(
                                'Erro!',
                                'Não foi possível apagar as escalas. ' +
                                (xhr.responseJSON?.message || xhr.responseText ||
                                    'Erro desconhecido.'),
                                'error'
                            );
                        }
                    });
                }
            });
        }
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
                        "title": "Detalhes",
                        "className": "text-center",
                        "orderable": false,
                        "render": function(data, type, row) {
                            return `<button class="btnDetalhes group flex items-center justify-center text-white hover:text-gray-300 focus:outline-none transition-colors bg-blue-600 px-2 py-1 rounded" data-detalhes='${JSON.stringify(row['data-detalhes'])}'>
                                        <span class="mr-1 text-sm">Detalhes</span>
                                        <svg class="w-4 h-4 text-white group-hover:text-gray-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>`;
                        }
                    },
                    {
                        "data": null,
                        "title": "Gerar Escala",
                        "className": "text-center",
                        "orderable": false,
                        "render": function(data, type, row) {
                            // Assuming the row has an 'id_funcionario' property
                            return `<button onclick="gerarEscalaFuncionario(${row.id_funcionario})" class="btnGerarEscala group flex items-center justify-center text-white hover:text-gray-300 focus:outline-none transition-colors bg-green-600 px-2 py-1 rounded">
                                        <span class="mr-1 text-sm">Gerar</span>
                                        <svg class="w-4 h-4 text-white group-hover:text-gray-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                    </button>`;
                        }
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
        });

        // Add this function to handle generating schedule for a specific employee
        function gerarEscalaFuncionario(idFuncionario) {
            // Prompt to choose period type
            Swal.fire({
                title: 'Escolha o Tipo de Período',
                input: 'select',
                inputOptions: {
                    'weekly': 'Semanal',
                    'biweekly': 'Quinzenal',
                    'monthly': 'Mensal',
                    'quarterly': 'Trimestral'
                },
                inputPlaceholder: 'Selecione o período',
                showCancelButton: true,
                confirmButtonText: 'Gerar Escala',
                cancelButtonText: 'Cancelar',
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value) {
                            resolve();
                        } else {
                            resolve('Você precisa selecionar um tipo de período');
                        }
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Confirm generation
                    Swal.fire({
                        title: 'Confirmar Geração de Escala',
                        text: `Deseja gerar escala ${getPeriodTypeText(result.value)} para este funcionário?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sim, gerar',
                        cancelButtonText: 'Cancelar'
                    }).then((confirmResult) => {
                        if (confirmResult.isConfirmed) {
                            // Send AJAX request to generate schedule
                            axios.post('{{ route('gerar-escala') }}', {
                                    employee_id: idFuncionario,
                                    period_type: result.value
                                })
                                .then(response => {
                                    Swal.fire('Sucesso!', response.data.message, 'success');
                                    // Optionally reload the table or update specific row
                                })
                                .catch(error => {
                                    Swal.fire('Erro!', 'Não foi possível gerar a escala.', 'error');
                                });
                        }
                    });
                }
            });
        }

        // Helper function to get readable period type text
        function getPeriodTypeText(periodType) {
            switch (periodType) {
                case 'weekly':
                    return 'semanal';
                case 'biweekly':
                    return 'quinzenal';
                case 'monthly':
                    return 'mensal';
                case 'quarterly':
                    return 'trimestral';
                default:
                    return 'do período';
            }
        }

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
    </script>

</x-app-layout>
