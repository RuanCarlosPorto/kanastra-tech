<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FileController extends Controller
{
    protected File $file;

    function __construct(File $file)
    {
        $this->file = $file;
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
}
