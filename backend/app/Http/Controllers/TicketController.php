<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Validator;
use App\Models\File;
use App\Services\TicketService;

class TicketController extends Controller
{
    protected File $file;
    protected TicketService $ticketService;
    protected Validator $validator;

    function __construct(File $file, TicketService $ticketService, Validator $validator)
    {
        $this->file = $file;
        $this->ticketService = $ticketService;
        $this->validator = $validator;
    }

    public function generate(Request $request) 
    {
        $this->validator->validate($request, [
            'input' => ['required', 'mimes:csv'],
        ]);
        
        $file = file($request->input);
        $fileName = $request->input->getClientOriginalName();
        $request['name'] = explode('.', $fileName)[0];
        $request['extension'] = explode('.', $fileName)[1];
        $request['size'] = $request->input->getSize();

        $this->file->store($request->all());

        array_shift($file);
        
        $this->ticketService->generate($file);
    }
}
