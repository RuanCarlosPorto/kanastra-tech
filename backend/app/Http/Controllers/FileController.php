<?php

namespace App\Http\Controllers;

use App\Lib\Validator;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FileController extends Controller
{
    protected File $file;
    protected Validator $validator;

    function __construct(File $file, Validator $validator)
    {
        $this->file = $file;
        $this->validator = $validator;
    }

    public function index() 
    {
        $files = $this->file->index();
        
        if(!$files) {
            return response()->json(
                'We were unable to find any file',
                Response::HTTP_NO_CONTENT
            );
        }

        return $files;
    }

    public function store(Request $request)
    {
        $this->validator->validate($request, [
            'input' => ['required', 'mimes:csv'],
        ]);

        $file = file($request->input);

        $fileName = $request->input->getClientOriginalName();
        $request['name'] = explode('.', $fileName)[0];
        $request['extension'] = explode('.', $fileName)[1];
        $request['size'] = $request->input->getSize();
        $request['content'] = json_encode($file);

        $instance = $this->file->store($request->all());

        if(!$instance) {
            return response()->json(
                'Something went wrong while processing the file.',
                Response::HTTP_NO_CONTENT
            );
        }

        return $instance;
    }
}
