<?php

namespace App\Http\Controllers;

use App\Services\MYPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class PdfController extends Controller
{
    public function index(): void
    {
        //$params = request()->route('params');
        $pdf = new MYPDF('PDF_PAGE_ORIENTATION', 'PDF_UNIT', 'PDF_PAGE_FORMAT', true, 'UTF-8', false);

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

            $pdf::writeHTML('teste', true, false, true, false);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error("Error na geração de PDF: " . $e->getMessage());
        } finally {
            DB::disconnect('tenancy');
        }

        $pdf::Output('licitacao_report.pdf');
    }
}
