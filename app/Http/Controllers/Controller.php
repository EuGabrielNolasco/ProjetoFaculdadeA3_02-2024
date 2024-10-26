<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public static $cabecalho_content = '
        <table cellspacing="0" cellpadding="1">
            <tr>
                <td align="left">Endereço: Rua Exemplo, 123, Mossoró - RN</td>
                <td align="right">Telefone: (84) 9090-9090</td>
            </tr>
            <tr>
                <td align="left">E-mail: ScaleUp@email.com.br</td>
                <td align="right">Website: www.ScaleUp.com.br</td>
            </tr>
        </table>';
}
