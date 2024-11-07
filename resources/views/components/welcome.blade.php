<div class="max-w-7xl mx-auto">
    <!-- Seção Principal -->
    <div class="p-8 bg-white border border-gray-100 rounded-lg shadow-sm">
        <x-application-logo class="block h-14 w-auto hover:opacity-80 transition-opacity" />

        <h1 class="mt-10 text-3xl font-bold text-gray-900 leading-tight">
            Bem-vindo ao sistema de gestão de <span class="text-indigo-600">escalas e turnos!</span>
        </h1>

        <div class="mt-8 space-y-6 text-gray-600 leading-relaxed">
            <p class="text-lg">
                Este projeto foi desenvolvido para atender a necessidade de um estabelecimento em organizar e distribuir os horários de trabalho de seus funcionários de maneira prática e acessível. Através deste sistema, o usuário poderá visualizar sua escala semanal ou mensal, além de ter acesso à escala de todos os demais colaboradores sem precisar recorrer a sistemas externos ou ao uso excessivo de papel.
            </p>

            <p class="text-lg">
                A plataforma oferece uma área dedicada para o administrador, onde é possível gerenciar escalas, cadastrar turnos, cargos, departamentos e horários, além de gerar relatórios e registrar novos usuários. Todo o gerenciamento de informações foi pensado para reduzir o uso de papéis, oferecendo uma experiência dinâmica e intuitiva para o administrador e funcionários.
            </p>

            <p class="text-lg">
                Com este sistema, a tradicional prática de pendurar papéis nas paredes pode ser eliminada, oferecendo uma alternativa digital onde cada funcionário consegue acessar facilmente sua escala. Nas tabelas, os usuários podem pesquisar por nome, cargo e outras informações relevantes, tornando o acesso rápido e eficiente.
            </p>
        </div>

        <a href="https://github.com/eugabrielnolasco/ProjetoFaculdadeA3_02-2024" target="_blank" 
           class="mt-8 inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition-colors duration-200">
            <span class="font-semibold">Acesse o repositório no GitHub</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-2 w-5 h-5 fill-indigo-600">
                <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>

    <!-- Grade de Recursos -->
    <div class="mt-8 bg-gradient-to-b from-gray-50 to-white rounded-lg shadow-sm border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <!-- Organização de Escalas -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-50 hover:border-indigo-100 transition-colors duration-200">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-indigo-50 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Organização de Escalas</h2>
                </div>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    O sistema permite que o administrador crie e distribua escalas de forma eficiente, visualizando e ajustando turnos e horários conforme necessário para garantir a organização do estabelecimento.
                </p>
            </div>

            <!-- Cargos e Departamentos -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-50 hover:border-indigo-100 transition-colors duration-200">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-indigo-50 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Cargos e Departamentos</h2>
                </div>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    Além das escalas, é possível gerenciar os cargos e departamentos dos funcionários, permitindo um controle detalhado sobre a estrutura organizacional da empresa.
                </p>
            </div>

            <!-- Relatórios e Análises -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-50 hover:border-indigo-100 transition-colors duration-200">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-indigo-50 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Relatórios e Análises</h2>
                </div>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    O sistema facilita a geração de relatórios, permitindo ao administrador visualizar dados sobre as escalas, turnos e outros registros importantes para uma análise detalhada do desempenho e da organização.
                </p>
            </div>

            <!-- Redução de Papel -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-50 hover:border-indigo-100 transition-colors duration-200">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-indigo-50 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Redução de Papel</h2>
                </div>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    Este projeto visa reduzir o uso de papéis, tornando o processo de visualização de escalas mais sustentável e eficiente, eliminando a necessidade de quadros de avisos físicos para cada funcionário.
                </p>
            </div>
        </div>
    </div>
</div>