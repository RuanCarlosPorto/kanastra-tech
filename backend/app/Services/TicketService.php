<?php

namespace App\Services;

use App\Mail\TicketMail;
use DateTime;
use OpenBoleto\Banco\BancoDoBrasil;
use OpenBoleto\Agente;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;

class TicketService
{
    public function convertHtmlToPdf($html)
    {
        $pdf = Pdf::loadHTML($html);
        return $pdf->download()->getOriginalContent();
    }

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

            $data = [
                'subject' => "$customer[0], o boleto de sua cobrança já está pronto!",
                'body' => 'Realize o download do boleto anexado neste e-mail e faça o pagamento.',
                'file' => $this->convertHtmlToPdf($boleto->getOutput())
            ];

            $this->sendMail($data, $customer[2]);
        }
    }

    public function sendMail($data, $receiverEmail)
    {
        Mail::to($receiverEmail)->send(new TicketMail($data));

        return 'Email sent successfully';
    }
}
