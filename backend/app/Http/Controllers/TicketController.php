<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Validator;
use App\Services\TicketService;

class TicketController extends Controller
{
    protected TicketService $ticketService;
    protected Validator $validator;

    function __construct(TicketService $ticketService, Validator $validator)
    {
        $this->ticketService = $ticketService;
        $this->validator = $validator;
    }

    public function generate(Request $request) 
    {
        $this->validator->validate($request, [
            'input' => ['required', 'mimes:csv']
        ]);

        $csv = array_map('str_getcsv', file($request->input));
        
        $this->ticketService->generate($csv);
    }
}
