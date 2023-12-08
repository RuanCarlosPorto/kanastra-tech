<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'extension',
        'size'
    ];

    public function index() {
        return $this->get();
    }

    public function store($data) {
        $instance = $this->newInstance($data);
        $instance->save();

        return $instance;
    }
}
