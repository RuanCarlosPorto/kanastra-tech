<?php

namespace App\Services;

use DateTime;
use OpenBoleto\Banco\BancoDoBrasil;
use OpenBoleto\Agente;

class TicketService
{
    public function generate($csv)
    {
        $csvHeader = array_shift($csv);

        foreach ($csv as $customer) {
            $drawer = new Agente($customer[0], '000.000.000-00', 'Teste', '00000-000', 'Teste', 'TS');
            $assignor = new Agente('Fake Bank', '00.000.000/0000-00', 'Teste', '00000-000', 'Teste', 'TS');

            $boleto = new BancoDoBrasil(array(
                'dataVencimento' => new DateTime($customer[4]),
                'valor' => $customer[3],
                'sequencial' => $customer[1],
                'sacado' => $drawer,
                'cedente' => $assignor,
                'agencia' => 0000,
                'carteira' => 18,
                'conta' => 00000000,
                'convenio' => 1234,
            ));

            dd($boleto->getOutput());

            // dd($drawer, $assignor);
            // // $name = $customer[0];
            // // $governmentId = $customer[1];
            // // $email = $customer[2];
            // // $debtAmount = $customer[3];
            // // $debtDueDate = $customer[4];
            // // $debtId = $customer[5];
        }
    }
}
