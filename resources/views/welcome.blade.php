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
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 p-6 space-y-4">
        <div class="flex items-center space-x-4">
            <div class="p-3.5 rounded-full bg-blue-200">
                <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm uppercase tracking-wide">Total de Funcionários</p>
                <p class="text-3xl font-bold text-blue-900">120</p>
            </div>
        </div>
    </div>

    <!-- Card de Turnos Ativos -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 p-6 space-y-4">
        <div class="flex items-center space-x-4">
            <div class="p-3.5 rounded-full bg-green-200">
                <svg class="w-7 h-7 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm uppercase tracking-wide">Turnos Ativos</p>
                <p class="text-3xl font-bold text-green-900">15</p>
            </div>
        </div>
    </div>

    <!-- Card de Departamentos -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 p-6 space-y-4">
        <div class="flex items-center space-x-4">
            <div class="p-3.5 rounded-full bg-purple-200">
                <svg class="w-7 h-7 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm uppercase tracking-wide">Departamentos</p>
                <p class="text-3xl font-bold text-purple-900">8</p>
            </div>
        </div>
    </div>

    <!-- Card de Última Atualização -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 p-6 space-y-4">
        <div class="flex items-center space-x-4">
            <div class="p-3.5 rounded-full bg-yellow-200">
                <svg class="w-7 h-7 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <button
                                class="w-full flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300 group">
                                <span
                                    class="text-gray-700-300 group-hover:text-gray-900 dark:group-hover:text-white">Relatório
                                    de Presença</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-white"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
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
                            <button
                                class="w-full flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300 group">
                                <span
                                    class="text-gray-700-300 group-hover:text-gray-900 dark:group-hover:text-white">Métricas
                                    de Departamento</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-white"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tabela de Escalas -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-gray-900">Escalas Recentes</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <!-- Keep the existing table structure, just with improved styles -->
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <!-- Table head and body remain the same as in the original, with minor style tweaks -->
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600-300 uppercase tracking-wider">
                                            Funcionário
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600-300 uppercase tracking-wider">
                                            Cargo
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600-300 uppercase tracking-wider">
                                            Data
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600-300 uppercase tracking-wider">
                                            Horário
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600-300 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <!-- Rest of the table remains the same as previous design -->
                            </table>
                        </div>

                        <!-- Pagination with improved design -->
                        <div class="bg-gray-50/50 px-4 py-4 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-600-300">
                                    Mostrando <span class="font-medium">1</span> até <span
                                        class="font-medium">3</span> de <span class="font-medium">12</span> resultados
                                </div>
                                <div class="flex space-x-2">
                                    <button
                                        class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300">
                                        Anterior
                                    </button>
                                    <button
                                        class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300">
                                        Próximo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
