<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    // Menambahkan kolom yang boleh diisi
    protected $fillable = [
        'name',
        'category',
        'stock',
        'unit',
    ];
}

