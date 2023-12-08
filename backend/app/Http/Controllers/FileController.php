<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected File $file;

    function __construct(File $file)
    {
        $this->file = $file;
    }

    public function index() 
    {
        return $this->file->index();
    }
}
