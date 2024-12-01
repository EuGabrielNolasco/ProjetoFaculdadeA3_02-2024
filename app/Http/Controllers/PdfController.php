<?php

namespace App\Http\Controllers;

use App\Models\Model_shifits;
use App\Services\MYPDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class PdfController extends Controller
{
    public function departamento(): void
    {
        $pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Define que deve acontecer a quebra automática de página
        $pdf::SetAutoPageBreak(TRUE, 12);

        // Define as fontes do cabeçalho e rodapé
        $pdf::setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf::setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf::SetFont('Helvetica', '', 10);

        // Insere os dados no cabeçalho e rodapé
        $pdf->Dados_Header(self::$cabecalho_content);
        $pdf::setHeaderCallback([$pdf, 'Header']);
        $pdf::setFooterCallback([$pdf, 'Footer']);

        DB::beginTransaction();
        try {
            // Define as margens do documento
            $pdf::SetMargins(10, 35, 10);
            $pdf::SetHeaderMargin(12);
            $pdf::SetFooterMargin(PDF_MARGIN_FOOTER);

            $pdf::AddPage();

            // Cabeçalho da tabela
            $html = '
            <h1 style="text-align:center;">Relatório de Departamentos</h1>
            <table border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#f2f2f2;">
                        <th style="text-align:center;">ID</th>
                        <th style="text-align:center;">Nome</th>
                        <th style="text-align:center;">Descrição</th>
                        <th style="text-align:center;">Criado em</th>
                        <th style="text-align:center;">Atualizado em</th>
                    </tr>
                </thead>
                <tbody>';

            // Obtém os dados dos departamentos
            $departments = DB::table('departments')->get();

            foreach ($departments as $department) {
                $html .= '
                <tr>
                    <td style="text-align:center;">' . $department->id . '</td>
                    <td>' . $department->name . '</td>
                    <td>' . ($department->description ?? 'N/A') . '</td>
                    <td style="text-align:center;">' . $department->created_at . '</td>
                    <td style="text-align:center;">' . $department->updated_at . '</td>
                </tr>';
            }

            $html .= '
                </tbody>
            </table>';

            // Escreve o HTML no PDF
            $pdf::writeHTML($html, true, false, true, false);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error("Error na geração de PDF: " . $e->getMessage());
        } finally {
            DB::disconnect('tenancy');
        }

        $pdf::Output('relatorio_departamentos.pdf', 'I');
    }

    public function cargo(): void
    {
        $pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Define que deve acontecer a quebra automática de página
        $pdf::SetAutoPageBreak(TRUE, 12);

        // Define as fontes do cabeçalho e rodapé
        $pdf::setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf::setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf::SetFont('Helvetica', '', 10);

        // Insere os dados no cabeçalho e rodapé
        $pdf->Dados_Header(self::$cabecalho_content);
        $pdf::setHeaderCallback([$pdf, 'Header']);
        $pdf::setFooterCallback([$pdf, 'Footer']);

        DB::beginTransaction();
        try {
            // Define as margens do documento
            $pdf::SetMargins(10, 35, 10);
            $pdf::SetHeaderMargin(12);
            $pdf::SetFooterMargin(PDF_MARGIN_FOOTER);

            $pdf::AddPage();

            // Cabeçalho da tabela
            $html = '
            <h1 style="text-align:center;">Relatório de Cargos</h1>
            <table border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#f2f2f2;">
                        <th style="text-align:center;">ID</th>
                        <th style="text-align:center;">Nome</th>
                        <th style="text-align:center;">Responsabilidade</th>
                        <th style="text-align:center;">Criado em</th>
                        <th style="text-align:center;">Atualizado em</th>
                    </tr>
                </thead>
                <tbody>';

            // Obtém os dados dos Cargos
            $cargos = DB::table('positions')->get();

            foreach ($cargos as $cargo) {
                $html .= '
                <tr>
                    <td style="text-align:center;">' . $cargo->id . '</td>
                    <td>' . $cargo->name . '</td>
                    <td>' . ($cargo->responsibilities ?? 'N/A') . '</td>
                    <td style="text-align:center;">' . $cargo->created_at . '</td>
                    <td style="text-align:center;">' . $cargo->updated_at . '</td>
                </tr>';
            }

            $html .= '
                </tbody>
            </table>';

            // Escreve o HTML no PDF
            $pdf::writeHTML($html, true, false, true, false);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error("Error na geração de PDF: " . $e->getMessage());
        } finally {
            DB::disconnect('tenancy');
        }

        $pdf::Output('relatorio_departamentos.pdf', 'I');
    }

    public function turno(?string $search = null): void
    {
        $pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Define que deve acontecer a quebra automática de página
        $pdf::SetAutoPageBreak(TRUE, 12);

        // Define as fontes do cabeçalho e rodapé
        $pdf::setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf::setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf::SetFont('Helvetica', '', 10);

        // Insere os dados no cabeçalho e rodapé
        $pdf->Dados_Header(self::$cabecalho_content);
        $pdf::setHeaderCallback([$pdf, 'Header']);
        $pdf::setFooterCallback([$pdf, 'Footer']);

        DB::beginTransaction();
        try {
            // Define as margens do documento
            $pdf::SetMargins(10, 35, 10);
            $pdf::SetHeaderMargin(12);
            $pdf::SetFooterMargin(PDF_MARGIN_FOOTER);

            $pdf::AddPage();

            // Cabeçalho da tabela
            $html = '
            <h1 style="text-align:center;">Relatório de Turnos</h1>
            <table border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#f2f2f2;">
                        <th style="text-align:center;">ID</th>
                        <th style="text-align:center;">Nome</th>
                        <th style="text-align:center;">Hora de Início</th>
                        <th style="text-align:center;">Hora de Término</th>
                    </tr>
                </thead>
                <tbody>';

            // Obtém os dados dos turnos, considerando a pesquisa se fornecida
            $shifts = Model_shifits::get();

            foreach ($shifts as $shift) {
                $html .= '
                <tr>
                    <td style="text-align:center;">' . $shift->id . '</td>
                    <td>' . $shift->name . '</td>
                    <td style="text-align:center;">' . $shift->start_time . '</td>
                    <td style="text-align:center;">' . $shift->end_time . '</td>
                </tr>';
            }

            $html .= '
                </tbody>
            </table>';

            // Escreve o HTML no PDF
            $pdf::writeHTML($html, true, false, true, false);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error("Error na geração de PDF: " . $e->getMessage());
        } finally {
            DB::disconnect('tenancy');
        }

        $pdf::Output('relatorio_turnos.pdf', 'I');
    }

    public function gerarPdf($id_funcionario)
    {
        // Obter informações do funcionário e suas escalas
        $funcionario = DB::table('employees as b')
            ->select([
                'b.name as funcionario',
                'b.contact as contato',
                'd.name as departamento',
                'e.name as cargo',
                'a.start_date as primeiro_dia',
                'a.end_date as ultimo_dia',
                'a.days as dias'
            ])
            ->leftJoin('schedules as a', 'b.id', '=', 'a.employee_id')
            ->leftJoin('departments as d', 'd.id', '=', 'b.department_id')
            ->leftJoin('positions as e', 'e.id', '=', 'b.position_id')
            ->where('b.id', $id_funcionario)
            ->first();

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado.'], 404);
        }

        // Formatar as datas
        $primeiro_dia = Carbon::parse($funcionario->primeiro_dia)->format('d/m/Y');
        $ultimo_dia = Carbon::parse($funcionario->ultimo_dia)->format('d/m/Y');

        // Decodificar as escalas do JSON
        $escalas = json_decode($funcionario->dias, true);

        // Criar uma nova instância do TCPDF
        $pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Configurações do PDF
        $pdf::SetAutoPageBreak(TRUE, 12);
        $pdf::SetMargins(10, 35, 10);
        $pdf::SetHeaderMargin(12);
        $pdf::SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf::SetFont('Helvetica', '', 10);

        // Define as fontes do cabeçalho e rodapé
        $pdf::setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf::setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->Dados_Header(self::$cabecalho_content);
        $pdf::setHeaderCallback([$pdf, 'Header']);
        $pdf::setFooterCallback([$pdf, 'Footer']);

        // Adiciona uma nova página
        $pdf::AddPage();

        // Cabeçalho do documento
        $html = '
        <h1 style="text-align:center;">Relatório de Escalas</h1>
        <h2>Funcionário: ' . $funcionario->funcionario . '</h2>
        <h3>Departamento: ' . $funcionario->departamento . '</h3>
        <h3>Cargo: ' . $funcionario->cargo . '</h3>
        <h3>Contato: ' . $funcionario->contato . '</h3>
        <h3>Período: ' . $primeiro_dia . ' a ' . $ultimo_dia . '</h3>
        <table border="1" cellpadding="5">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th style="text-align:center;">Dia</th>
                    <th style="text-align:center;">Escala</th>
                </tr>
            </thead>
            <tbody>';

        // Preencher a tabela com os dados de escalas
        // Decodificar as escalas do JSON
        $escalas = json_decode($funcionario->dias, true);

        // Verificar se $escalas é um array válido antes de usar no foreach
        if (is_array($escalas)) {
            foreach ($escalas as $dia => $escala) {
                $html .= '
        <tr>
            <td style="text-align:center;">' . $dia . '</td>
            <td>' . implode(', ', $escala) . '</td>
        </tr>';
            }
        } else {
            // Se $escalas não for um array válido, exibe uma mensagem de erro ou outro conteúdo
            $html .= '<tr><td colspan="2" style="text-align:center;">Não há escalas disponíveis.</td></tr>';
        }


        $html .= '
            </tbody>
        </table>';

        // Escreve o HTML no PDF
        $pdf::writeHTML($html, true, false, true, false);

        // Saída do PDF
        $pdf::Output('relatorio_escala.pdf', 'I');
    }
}
