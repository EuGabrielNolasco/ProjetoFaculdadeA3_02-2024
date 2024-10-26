<?php

namespace App\Services;

use Elibyy\TCPDF\Facades\TCPDF;

class MYPDF extends TCPDF
{

    var $grid = false;
    var $html;

    public function Dados_Header($html)
    {
        $this->html = is_array($html) ? implode('', $html) : $html; // Handle array case
    }



    public function DrawGrid()
    {
        if ($this->grid === true) {
            $spacing = 5;
        } else {
            $spacing = $this->grid;
        }
        $this::SetDrawColor(204, 255, 255);
        $this::SetLineWidth(0.35);
        for ($i = 0; $i < $this->w; $i += $spacing) {
            $this::Line($i, 0, $i, $this->h);
        }
        for ($i = 0; $i < $this->h; $i += $spacing) {
            $this::Line(0, $i, $this->w, $i);
        }
        $this::SetDrawColor(0, 0, 0);

        $x = $this::GetX();
        $y = $this::GetY();
        $this::SetTextColor(204, 204, 204);
        for ($i = 20; $i < $this->h; $i += 20) {
            $this::SetXY(1, $i - 3);
            $this::Write(4, $i);
        }
        for ($i = 20; $i < (($this->w) - ($this->rMargin) - 10); $i += 20) {
            $this::SetXY($i - 1, 1);
            $this::Write(4, $i);
        }
        $this::SetXY($x, $y);
    }

    public function Header()
    {
        // Desenha a grade, caso habilitada
        if ($this->grid) $this->DrawGrid();

        // Verifica se o html existe e imprime no cabeçalho
        if (!empty($this->html)) {
            $this::SetY(10); // Define a posição Y para o cabeçalho
            $this::SetFont('helvetica', '', 12); // Define a fonte do cabeçalho
            $this::writeHTML($this->html, true, false, true, false, ''); // Renderiza o HTML
        }
    }


    //Rodape
    public function Footer()
    {
        // Posicionado a 15mm do final da pagina
        $this::SetY(-15);
        // Tipo de fonte
        $this::SetFont('courier', 'I', 8);
        $this::Cell(0, 10, 'ScaleUp (84) 9090-9090', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // Numero da Pagina
        $this::Cell(0, 10, 'Página ' . $this::getAliasNumPage() . '/' . $this::getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}